<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAll()
    {
        factory(Task::class, 2)->create();

        $response = $this->json('GET', '/api/tasks');

        $data = $response
            ->assertStatus(200)
            ->decodeResponseJson();

        $this->assertCount(2, $data['data']);
    }

    public function testCreateTask()
    {
        $response = $this->json(
            'POST',
            '/api/tasks',
            ['description' => 'task description']
        );

        $response->assertStatus(201);

        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas(
            'tasks',
            [
                'description' => 'task description',
                'done' => false,
            ]
        );
    }

    public function testDeleteTask()
    {
        $task = factory(Task::class)->create();

        $url = sprintf('/api/tasks/%s', $task['uuid']);
        $response = $this->json('DELETE', $url);

        $response->assertStatus(204);

        $this->assertCount(0, Task::all());
    }

    public function testUpdateTask()
    {
        $task = factory(Task::class)->create();

        $url = sprintf('/api/tasks/%d', $task->id);
        $response = $this->json('PUT', $url, ['description' => 'updated description']);

        $response->isSuccessful();
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas(
            'tasks',
            [
                'description' => 'updated description',
                'id' => $task->id,
                'done' => $task->done,
            ]
        );
    }

    public function testUndoneTask()
    {
        $task = factory(Task::class)->state('done')->create();

        $url = sprintf('/api/tasks/%s/undone', $task->uuid);
        $response = $this->json('PUT', $url);

        $response->isSuccessful();
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas(
            'tasks',
            [
                'description' => $task->description,
                'uuid' => $task->uuid,
                'done' => false,
            ]
        );
    }

    public function testDoneTask()
    {
        $task = factory(Task::class)->state('undone')->create();

        $url = sprintf('/api/tasks/%s/done', $task->uuid);
        $response = $this->json('PUT', $url);

        $response->isSuccessful();
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas(
            'tasks',
            [
                'description' => $task->description,
                'uuid' => $task->uuid,
                'done' => true,
            ]
        );
    }
}
