<?php

namespace Todo\Application;

final class CreateTodo
{
    private $description;

    private function __construct(string $description)
    {
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }

    public static function withDescription(string $description): self
    {
        return new self($description);
    }
}
