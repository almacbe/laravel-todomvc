<?php

namespace Todo\Infrastructure\Persistence\Eloquent;

use App\Task;
use Todo\Domain\Todo;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;

class TaskRepository implements TodoRepository
{
    public function save(Todo $todo): void
    {
        $data = $todo->toArray();
        $task = Task::create($data);
        $task->save();
    }

    public function get(TodoId $id): Todo
    {
        // TODO: Implement get() method.
    }
}
