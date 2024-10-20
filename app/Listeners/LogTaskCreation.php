<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;


class LogTaskCreation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event)
    {
        $task = $event->task;

        Log::info('New Task Created', [
            'title' => $task->title,
            'user' => $task->user_id,
            'category' => $task->category_id,
        ]);
    }
}
