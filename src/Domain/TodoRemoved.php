<?php
declare(strict_types=1);

namespace Todo\Domain;

final class TodoRemoved extends DomainEvent
{
    /**
     * @var TodoId
     */
    private $id;

    public function __construct(TodoId $id)
    {
        $this->id = $id;
        parent::__construct();
    }
}
