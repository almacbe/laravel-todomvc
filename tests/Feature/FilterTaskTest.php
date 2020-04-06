<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testGetActiveTasks()
    {
        factory(Task::class)->state('done')->create();
        $undoneTask = factory(Task::class)->state('undone')->create()->toArray();

        $response = $this->json('GET', '/api/tasks/active');

        $data = $response
            ->assertStatus(200)
            ->decodeResponseJson();

        $this->assertCount(1, $data['data']);
        $this->assertEquals($undoneTask['uuid'], $data['data'][0]['id']);
    }
}
