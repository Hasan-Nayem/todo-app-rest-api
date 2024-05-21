<?php

namespace Tests;

use App\Models\Task;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function testGetTasksEndpoint()
    {
        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
    }

    public function testCreateEndpoint()
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
        ]);
        $response->assertStatus(201)->assertJsonStructure(['acknowledge', 'insertedId']);

        $response = $this->postJson('/api/tasks', [
            'title' => '', // Empty title
            'description' => 'Test Description',
        ]);
        $response->assertStatus(403)->assertJson(['message' => 'Title should not be empty']);
    }

    public function testShowEndpoint()
    {
        $task = Task::factory()->create();
        $response = $this->getJson("/api/tasks/{$task->id}");
        $response->assertStatus(200)
                 ->assertJsonStructure(['task']);

        $response = $this->getJson('/api/tasks/999999'); // Non-existing task ID
        $response->assertStatus(404)
                 ->assertJson(['error' => 'Invalid Id, No data found!']);
    }
    public function testUpdateEndpoint()
    {
        $task = Task::factory()->create();

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'is_completed' => true,
        ]);
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Task updated successfully']);

        $response = $this->putJson('/api/tasks/999999', [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'is_completed' => true,
        ]);
        $response->assertStatus(404)
                 ->assertJson(['error' => 'Invalid Id, No data found!']);
    }
    public function testDestroyEndpoint()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Task deleted successfully']);

        $response = $this->deleteJson('/api/tasks/999999');
        $response->assertStatus(404)
                 ->assertJson(['error' => 'Invalid Id, No data found!']);
    }
}
