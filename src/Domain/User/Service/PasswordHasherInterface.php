<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

interface PasswordHasherInterface
{
    public function generate(): string;

    public function hash(string $password): string;

    public function validate(string $passwordHash, string $password): bool;
}
