<?php

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;



uses(RefreshDatabase::class);  

it('can create a task', function () {
    $user = User::factory()->create();  
    $taskData = [
        'title' => 'Test Task',
        'description' => 'Test description',
        'status' => 'pending',
        'due_date' => '2025-12-31',
    ];

    
    $response = $this->actingAs($user)->post('/create-task', $taskData);  

    $response->assertRedirect('/');  
    $this->assertDatabaseHas('tasks', $taskData);  
});

it('can update a task', function () {
    $user = User::factory()->create(); 
    $task = Task::factory()->create(['user_id' => $user->id]);  
    $updatedData = [
        'title' => 'Updated Task',
        'description' => 'Updated description',
        'status' => 'in_progress',
        'due_date' => '2025-12-31',
    ];

    
    $response = $this->actingAs($user)->put("/update/{$task->id}", $updatedData);  

   
    $response->assertRedirect('/');  
    $this->assertDatabaseHas('tasks', $updatedData);  
});

it('can delete a task', function () {
    $user = User::factory()->create(); 
    $task = Task::factory()->create(['user_id' => $user->id]);  

   
    $response = $this->actingAs($user)->delete("/delete/{$task->id}");  

    
    $response->assertRedirect('/');  
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);  
});

it('can fetch tasks', function () {
    $user = User::factory()->create();  
    Task::factory()->count(3)->create(['user_id' => $user->id]);  

   
    $response = $this->actingAs($user)->get('/');  

    
    $response->assertOk();  
    $response->assertSee('Test Task');  // Replace with actual task title if needed
});
