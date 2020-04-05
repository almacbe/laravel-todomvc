<?php

declare(strict_types=1);

namespace Todo\Application;

use Todo\Domain\Todo;
use Todo\Domain\TodoDescription;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;

class CreateTodoHandler
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

    public function __invoke(CreateTodo $command): void
    {
        $todo = Todo::create(TodoId::fromString(uniqid()), TodoDescription::fromString($command->description()));

        $this->todoRepository->save($todo);
    }
}
