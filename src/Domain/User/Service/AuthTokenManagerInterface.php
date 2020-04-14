<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

interface AuthTokenManagerInterface
{
    public function encode(array $data): string;

    public function decode(string $token): array;
}
