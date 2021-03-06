<?php

namespace EventCentric\When\ConventionBased;

use EventCentric\DomainEvents\DomainEvent;
use EventCentric\DomainEvents\DomainEvents;
use EventCentric\When\When;
use Verraes\ClassFunctions\ClassFunctions;

trait ConventionBasedWhen
{
    use When;

    /**
     * @param DomainEvent $event
     * @return void
     */
    protected function when(DomainEvent $event)
    {
        $method = 'when' . ClassFunctions::short($event);
        if(is_callable([$this, $method])) {
            $this->{$method}($event);
        }
    }

    /**
     * @param DomainEvents $events
     * @return void
     */
    protected function whenAll(DomainEvents $events)
    {
        foreach($events as $event) {
            $this->when($event);
        }
    }

}