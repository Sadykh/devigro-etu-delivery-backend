<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\User;

use App\Domain\User\Service\AuthTokenManagerInterface;
use Firebase\JWT\JWT;

/**
 * AuthTokenManager.
 */
class AuthTokenManager implements AuthTokenManagerInterface
{
    public function encode(array $data): string
    {
        $key = file_get_contents(getenv('APP_JWT_PRIVATE_KEY'));
        return JWT::encode($data, $key, 'RS256');
    }

    public function decode(string $token): array
    {
        $key = file_get_contents(getenv('APP_JWT_PUBLIC_KEY'));
        return (array)JWT::decode($token, $key, ['RS256']);
    }
}
