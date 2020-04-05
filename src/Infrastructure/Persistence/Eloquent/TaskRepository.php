<?php

namespace Todo\Infrastructure\Persistence\Eloquent;

use App\Task;
use Todo\Domain\Todo;
use Todo\Domain\TodoDescription;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;
use Todo\Infrastructure\Persistence\LaminasHydratorFactory;

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
        $taskModel = Task::findOrFail($id->toString());
        $taskArray = [
            'id' => TodoId::fromString($taskModel->uuid),
            'description' => TodoDescription::fromString($taskModel->description),
            'completed' => (bool)$taskModel->done,
        ];
        $hydrator = (new LaminasHydratorFactory())();
        $object = (new \ReflectionClass(Todo::class))->newInstanceWithoutConstructor();
        $todo = $hydrator->hydrate($taskArray, $object);

        return $todo;
    }

    public function remove(Todo $todo): void
    {
        Task::where('uuid', $todo->id()->toString())->delete();
    }
}
