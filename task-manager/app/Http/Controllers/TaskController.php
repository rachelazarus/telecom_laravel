<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TaskController extends Controller
{
    public function createTask(Request $request):RedirectResponse
    {

        $incomingFields = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'due_date' => ['nullable', 'date', 'after:today'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = auth()->id();
        Task::create($incomingFields);

        return redirect('/');
    }

    public function showEditScreen(Task $task): View | RedirectResponse
    {

        if (auth()->user()->id !== $task['user_id']) {

            return redirect('/');

        }

        return view('edit-task', ['task' => $task]);
    }

    public function update(Task $task, Request $request): RedirectResponse
    {
        if (auth()->user()->id !== $task['user_id']) {

            return redirect('/');

        }

        $incomingFields = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'due_date' => ['nullable', 'date', 'after:today'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $task->update($incomingFields);

        return redirect('/');
    }

    public function delete(Task $task): RedirectResponse
    {

        if (auth()->user()->id === $task['user_id']) {
            $task->delete();

        }

        return redirect('/');

    }

    public function showTaskScreen(Task $task): View| RedirectResponse
       {
        if (auth()->user()->id !== $task['user_id']) {

            return redirect('/');

        }

        return view('task-detail', ['task' => $task]);
    }
}
