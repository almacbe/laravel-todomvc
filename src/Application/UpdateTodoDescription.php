<?php

namespace Todo\Application;

final class UpdateTodoDescription
{
    private $id;

    private $description;

    private function __construct(string $id, string $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function id(): string
    {
        return $this->id;
    }

    public static function withIdAndDescription(string $id, string $description): self
    {
        return new self($id, $description);
    }


}
