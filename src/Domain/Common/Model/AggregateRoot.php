<?php

declare(strict_types=1);

namespace App\Domain\Common\Model;

/**
 * AggregateRoot.
 */
interface AggregateRoot
{
    public function releaseEvents(): array;
}
