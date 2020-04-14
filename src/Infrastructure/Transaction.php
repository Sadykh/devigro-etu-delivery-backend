<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\TransactionInterface;
use Doctrine\ORM\EntityManagerInterface;

class Transaction implements TransactionInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function commit(): void
    {
        $this->entityManager->commit();
    }

    public function rollBack(): void
    {
        $this->entityManager->rollback();
    }
}
