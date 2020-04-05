<?php

declare(strict_types=1);

namespace Todo\Application;

use Todo\Domain\Todo;
use Todo\Domain\TodoDescription;
use Todo\Domain\TodoId;
use Todo\Domain\TodoRepository;

class UpdateTodoDescriptionHandler
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

    public function __invoke(UpdateTodoDescription $command): void
    {
        $todo = $this->todoRepository->get(TodoId::fromString($command->id()));
        $todo->updateDescription(TodoDescription::fromString($command->description()));

        $this->todoRepository->save($todo);
    }
}
