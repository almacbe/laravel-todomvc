<?php

declare(strict_types=1);

namespace Todo\Application;

use Todo\Domain\Todo;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;

class RemoveTodoHandler
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

    public function __invoke(RemoveTodo $command): void
    {
        $id = $command->id();
        /** @var Todo $todo */
        $todo = $this->todoRepository->get(TodoId::fromString($id));
        $todo->remove();
        $this->todoRepository->remove($todo);
    }
}
