<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Common;

use App\Domain\Common\Model\AggregateRoot;
use App\Domain\Common\Repository\RepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * AbstractRepository.
 */
abstract class AbstractRepository extends EntityRepository implements RepositoryInterface
{
    public function create(AggregateRoot $model)
    {
        $this->getEntityManager()->persist($model);
    }

    public function add(AggregateRoot $model)
    {
        $this->getEntityManager()->persist($model);
    }
}
