<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('a user can create a task', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/create-task', [ // Fixed route
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'pending',
            'due_date' => now()->addDay()->toDateString(),
        ])
        ->assertRedirect('/');

    $this->assertDatabaseHas('tasks', [
        'title' => 'Test Task',
        'user_id' => $user->id,
    ]);
});

test('a user can edit their task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(); // Ensuring factory usage

    $this->actingAs($user)
        ->put("/edit-task/{$task->id}", [ // Fixed route
            'title' => 'Updated Task',
            'description' => 'Updated Description',
            'status' => 'in_progress',
            'due_date' => now()->addDays(2)->toDateString(),
        ])
        ->assertRedirect('/');

    $this->assertDatabaseHas('tasks', [
        'title' => 'Updated Task',
    ]);
});

test('a user can delete their task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(); // Ensuring factory usage

    $this->actingAs($user)
        ->delete("/delete-task/{$task->id}") // Fixed route
        ->assertRedirect('/');

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});

test('database connection is working', function () {
    $result = DB::select('SELECT 1');
    expect($result)->toBeArray();
});
