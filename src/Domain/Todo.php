<?php

declare(strict_types=1);

namespace Todo\Domain;

final class Todo extends AggregateRoot
{
    /** @var TodoId */
    private $id;

    /** @var TodoDescription */
    private $description;

    /** @var boolean */
    private $removed;

    /** @var boolean */
    private $completed;

    public static function create(TodoId $todoId, TodoDescription $description): self
    {
        $self = new self();
        $self->recordThat(new TodoCreated($todoId, $description));

        return $self;
    }

    public function remove(): void
    {
        $this->recordThat(new TodoRemoved($this->id));
    }

    public function complete()
    {
        $this->recordThat(new TodoCompleted($this->id));
    }

    public function incomplete()
    {
        $this->recordThat(new TodoIncompleted($this->id));
    }

    public function toArray()
    {
        return [
            'uuid' => $this->id->toString(),
            'description' => $this->description->toString(),
            'done' => $this->completed,
        ];
    }

    public function id(): TodoId
    {
        return $this->id;
    }

    protected function apply(DomainEvent $event): void
    {
        switch (get_class($event)) {
            case TodoCreated::class:
                /* @var TodoCreated $event */
                $this->id = $event->todoId();
                $this->description = $event->description();
                $this->removed = false;
                $this->completed = false;
                break;
            case TodoRemoved::class:
                $this->removed = true;
                break;
            case TodoCompleted::class:
                $this->completed = true;
                break;
            case TodoIncompleted::class:
                $this->completed = false;
                break;
        }
    }
}
