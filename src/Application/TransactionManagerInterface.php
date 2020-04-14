<?php

declare(strict_types=1);

namespace App\Application;

interface TransactionManagerInterface
{
    public function beginTransaction(): TransactionInterface;
}
