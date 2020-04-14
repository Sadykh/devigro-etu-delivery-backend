<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\TransactionInterface;
use App\Application\TransactionManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

class TransactionManager implements TransactionManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function beginTransaction(): TransactionInterface
    {
        $this->entityManager->beginTransaction();
        return new Transaction($this->entityManager);
    }
}
