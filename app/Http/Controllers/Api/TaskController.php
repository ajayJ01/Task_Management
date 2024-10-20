<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Notifications\TaskCompleted;
use App\Jobs\SendTaskCompletedEmail;
use App\Events\TaskCreated;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        if ($tasks->isEmpty()) {
            return response()->json([
                'message' => 'No tasks found.',
                'data' => []
            ], 200);
        }

        return response()->json([
            'message' => 'Tasks fetched successfully!',
            'data' => $tasks
        ], 200);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Task retrieved successfully!',
            'data' => $task
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $filePath = null;
            if ($request->hasFile('attachment')) {
                $filePath = $request->file('attachment')->store('attachments', 'public');
            }

            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status ?? 'pending',
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
                'attachment' => $filePath
            ]);

            event(new TaskCreated($task));

            return response()->json(['message' => 'Task created successfully!', 'task' => $task]);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['error' => 'Task creation failed: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:pending,in progress,completed',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found.'], 404);
        }

        $task->update($request->only(['title', 'description', 'status', 'category_id']));

        if ($task->wasChanged('status') && $task->status == 'completed') {
            SendTaskCompletedEmail::dispatch($task);
        }

        return response()->json(['message' => 'Task updated successfully!', 'task' => $task], 200);
    }


    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found.'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully!'], 200);
    }

    public function getUserTasks(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $tasks = Task::with('category')
            ->where('user_id', $request->user_id)
            ->get();

        if ($tasks->isEmpty()) {
            return response()->json(['error' => 'No tasks found for this user.'], 404);
        }

        return response()->json([
            'message' => 'Tasks retrieved successfully!',
            'data' => $tasks,
        ], 200);
    }
}
