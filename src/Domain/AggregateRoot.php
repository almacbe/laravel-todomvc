<?php

namespace Todo\Domain;

abstract class AggregateRoot
{
    /**
     * @var DomainEvent[]
     */
    private $eventStore = [];

    public function events()
    {
        return $this->eventStore;
    }

    abstract protected function apply(DomainEvent $event);

    protected function recordThat(DomainEvent $event)
    {
        $this->apply($event);
        $this->eventStore[] = $event;
        event($event);
    }
}
