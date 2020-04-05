<?php

namespace Todo\Infrastructure\Persistence\Eloquent;

use App\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Todo\Domain\Todo;
use Todo\Domain\TodoDescription;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;
use Todo\Infrastructure\Persistence\LaminasHydratorFactory;

class TaskRepository implements TodoRepository
{
    public function save(Todo $todo): void
    {
        try {
            $task = $this->find($todo->id());
        } catch (ModelNotFoundException $exception) {
            $task = Task::make();
        }
        $data = $todo->toArray();
        $task->fill($data);
        $task->save();
    }

    public function get(TodoId $id): Todo
    {
        $taskModel = $this->find($id);
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

    private function find(TodoId $id): Task
    {
        return Task::where('uuid', $id->toString())->firstOrFail();
    }
}
