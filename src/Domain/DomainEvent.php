<?php

namespace Todo\Domain;

use DateTimeImmutable;
use DateTimeZone;

abstract class DomainEvent
{
    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }
}
