<?php

declare(strict_types=1);

namespace Todo\Domain;

interface TodoRepository
{
    public function save(Todo $todo): void;

    public function get(TodoId $id): Todo;

    public function remove(Todo $todo): void;
}
