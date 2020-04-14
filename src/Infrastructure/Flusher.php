<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\FlusherInterface;
use App\Domain\Common\Model\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Flusher.
 */
class Flusher implements FlusherInterface
{
    private $entityManager;

    private $eventDispatcher;

    public function __construct(EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function flush(AggregateRoot ...$roots): void
    {
        $this->entityManager->flush();

        foreach ($roots as $root) {
            foreach ($root->releaseEvents() as $event) {
                $this->eventDispatcher->dispatch($event);
            }
        }
//        $events = array_reduce($roots, function (array $events, AggregateRoot $root) {
//            return array_merge($events, $root->releaseEvents());
//        }, []);
//
//        foreach ($events as $event) {
//            $this->eventDispatcher->dispatch($event);
//        }
    }
}
