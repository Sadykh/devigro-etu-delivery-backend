<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\User;

use App\Domain\User\ValueObject\User\AuthToken;
use App\Infrastructure\Doctrine\Type\AbstractStringType;

class UserAuthTokenType extends AbstractStringType
{
    const NAME = 'user_auth_token';

    protected function valueObject(): string
    {
        return AuthToken::class;
    }
}
