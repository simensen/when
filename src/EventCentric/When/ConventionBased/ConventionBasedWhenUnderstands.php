<?php

namespace EventCentric\When\ConventionBased;

use EventCentric\DomainEvents\DomainEvent;
use EventCentric\DomainEvents\DomainEvents;
use EventCentric\When\Understands;
use EventCentric\When\When;
use Verraes\ClassFunctions\ClassFunctions;

trait ConventionBasedWhenUnderstands
{
    use Understands;
    use ConventionBasedWhen;

    public function whenUnderstands(DomainEvent $domainEvent)
    {
        if ($this->understands($domainEvent)) {
            $this->when($domainEvent);
        }
    }
}
