<?php

namespace EventCentric\When\Tests\ConventionBased;

use EventCentric\DomainEvents\DomainEvent;
use EventCentric\DomainEvents\Implementations\DomainEventsArray;
use EventCentric\When\ConventionBased\ConventionBasedWhenUnderstands;

final class MyReactorUnderstands
{
    use ConventionBasedWhenUnderstands;

    private $reacted = false;
    private $overreacted = false;

    protected function whenSomethingWeUnderstandHappened(SomethingWeUnderstandHappened $event)
    {
        $this->reacted = true;
    }

    protected function whenSomethingElseWeDoNotUnderstandHappened(SomethingElseWeDoNotUnderstandHappened $event)
    {
        $this->overreacted = true;
    }

    public function test()
    {
        $domainEvents = new DomainEventsArray([
            new SomethingElseWeDoNotUnderstandHappened(),
            new SomethingWeUnderstandHappened(),
        ]);

        foreach ($domainEvents as $domainEvent) {
            $this->whenUnderstands($domainEvent);
        }

        if(!$this->reacted) {
            throw new \Exception("The method 'whenSomethingWeUnderstandHappened' was not called");
        }
        if($this->overreacted) {
            throw new \Exception("The method 'whenSomethingElseWeDoNotUnderstandHappened' was called and should not have been");
        }
    }

    protected function understoodDomainEvents()
    {
        return [
            'EventCentric\When\Tests\ConventionBased\SomethingWeUnderstandButDoNotTouchHappened',
            'EventCentric\When\Tests\ConventionBased\SomethingWeUnderstandHappened',
        ];
    }
}

final class SomethingWeUnderstandHappened implements DomainEvent
{}

final class SomethingElseWeDoNotUnderstandHappened implements DomainEvent
{}

$reactor = new MyReactorUnderstands();
$reactor->test();
