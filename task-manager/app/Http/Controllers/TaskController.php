<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask(Request $request){

        $incomingFields = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'], 
            'description' => ['nullable', 'string'], 
            'status' => ['required', 'in:pending,in_progress,completed'], 
            'due_date' => ['nullable', 'date', 'after:today']
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id']= auth()->id();
        Task::create($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Task $task){

        if (auth()->user()->id !== $task['user_id']) {

            return redirect('/');

        }

        return view('edit-task', ['task'=>$task]);
    }

    public function update(Task $task, Request $request){
        if (auth()->user()->id !== $task['user_id']) {

            return redirect('/');

        }

        $incomingFields =$request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'], 
            'description' => ['nullable', 'string'], 
            'status' => ['required', 'in:pending,in_progress,completed'], 
            'due_date' => ['nullable', 'date', 'after:today']
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $task->update($incomingFields);
        return redirect('/');
    }

    public function delete(Task $task){

        if (auth()->user()->id === $task['user_id']) {
            $task->delete();

        }
        return redirect('/');

    }
} 

