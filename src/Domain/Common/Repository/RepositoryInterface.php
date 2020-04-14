<?php

declare(strict_types=1);

namespace App\Domain\Common\Repository;

use App\Domain\Common\Model\AggregateRoot;

/**
 * RepositoryInterface.
 */
interface RepositoryInterface
{
    public function add(AggregateRoot $model);
}
