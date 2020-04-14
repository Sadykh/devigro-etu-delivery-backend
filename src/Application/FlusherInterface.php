<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Common\Model\AggregateRoot;

interface FlusherInterface
{
    public function flush(AggregateRoot ...$roots): void;
}
