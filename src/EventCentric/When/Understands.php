<?php

namespace EventCentric\When;

use EventCentric\DomainEvents\DomainEvent;
use EventCentric\DomainEvents\DomainEvents;

trait Understands
{
    abstract protected function understoodDomainEvents();

    protected function understands(DomainEvent $domainEvent)
    {
        return $this->understandsAnyOf($domainEvent, $this->understoodDomainEvents());
    }

    protected function understandsAnyOf(DomainEvent $domainEvent, $types)
    {
        foreach ($types as $type) {
            if ($domainEvent instanceof $type) {
                return true;
            }
        }

        return false;
    }
}
