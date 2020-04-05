<?php


namespace Todo\Domain;


class DescriptionUpdated extends DomainEvent
{
    /**
     * @var TodoId
     */
    private $id;

    /**
     * @var TodoDescription
     */
    private $description;

    public function __construct(TodoId $id, TodoDescription $description)
    {
        $this->id = $id;
        $this->description = $description;
        parent::__construct();
    }

    public function id(): TodoId
    {
        return $this->id;
    }

    public function description(): TodoDescription
    {
        return $this->description;
    }
}
