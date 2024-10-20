<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Category;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $Task = Task::with('category', 'user')->get();

        return view('tasks.index', compact('Task'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('task.create')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            \Log::error('Task creation failed: ' . $e->getMessage());
            return redirect()->route('task.create')->with('error', 'Task not created due to an error. Please try again.');
        }
    }


}
