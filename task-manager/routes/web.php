<?php


use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function(){
   //$tasks = Task::where('user_id', auth()->id())->get();
    //0r

    $tasks =[];
    if (auth()->check()){
        $tasks= auth()->user()->usersTasks()->latest()->get();
    }
    
    return view('home', ['tasks' =>$tasks]);
});

Route::post('/register',[UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

//task routes

Route::post('/create-task', [TaskController::class, 'createTask']);

Route::get('/edit-task/{task}', [TaskController::class, 'showEditScreen']);
Route::put('/edit-task/{task}', [TaskController::class, 'update']);
Route::delete('/delete-task/{task}', [TaskController::class, 'delete']);
Route::get('/task-detail/{task}', [TaskController::class, 'showTaskScreen']);
