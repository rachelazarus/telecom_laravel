<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

// Home Page - Display all tasks
Route::get('/', function () {
    $tasks = Task::all(); // Use plural for better readability
    return view('home', ['tasks' => $tasks]);
});

// Create a Task
Route::post('/create', [TaskController::class, 'create']);

// Edit an Existing Task
Route::put('/edit/{id}', [TaskController::class, 'edit']); // Added {id} parameter
Route::put('/edit/{id}', [TaskController::class, 'update']); // Handle the update request