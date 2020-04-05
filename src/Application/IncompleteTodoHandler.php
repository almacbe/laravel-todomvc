<?php

declare(strict_types=1);

namespace Todo\Application;

use Todo\Domain\Todo;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;

class IncompleteTodoHandler
{
    /**
     * @var TodoRepository
     */
    private $todoRepository;

    /**
     * CreateTodoHandler constructor.
     *
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(IncompleteTodo $command): void
    {
        $id = $command->id();
        /** @var Todo $todo */
        $todo = $this->todoRepository->get(TodoId::fromString($id));
        $todo->incomplete();
        $this->todoRepository->save($todo);
    }
}
