<?php
declare(strict_types=1);

namespace Todo\Domain;

final class TodoIncompleted extends DomainEvent
{
    /**
     * @var TodoId
     */
    private $id;

    public function __construct(TodoId $id)
    {
        parent::__construct();
        $this->id = $id;
    }
}
