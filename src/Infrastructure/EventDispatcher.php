<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * EventDispatcher.
 */
class EventDispatcher implements EventDispatcherInterface
{
    private $container;

    private $listeners;

    public function __construct(ContainerInterface $container, array $listeners)
    {
        $this->container = $container;
        $this->listeners = $listeners;
    }

    public function dispatch(object $event)
    {
        $eventName = get_class($event);
        if (array_key_exists($eventName, $this->listeners)) {
            foreach ($this->listeners[$eventName] as $listenerClassName) {
                $listener = $this->container->get($listenerClassName);
                $listener($event);
            }
        }
    }
}
