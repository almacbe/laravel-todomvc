<?php

namespace Todo\Application;

final class CompleteTodo
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }

    public static function withId(string $id): self
    {
        return new self($id);
    }
}
