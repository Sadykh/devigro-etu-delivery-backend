<?php

declare(strict_types=1);

namespace App\Application;

interface TransactionInterface
{
    public function commit(): void;

    public function rollBack(): void;
}
