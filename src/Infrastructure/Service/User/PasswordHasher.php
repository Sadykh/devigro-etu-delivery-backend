<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\User;

use App\Domain\User\Service\PasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{
    public function generate(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = [];
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, mb_strlen($alphabet) - 1);
            $password[] = $alphabet[$n];
        }
        return implode($password);
    }

    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    }

    public function validate(string $passwordHash, string $password): bool
    {
        return password_verify($password, $passwordHash);
    }
}
