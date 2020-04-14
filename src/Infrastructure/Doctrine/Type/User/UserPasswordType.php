<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\User;

use App\Domain\User\ValueObject\User\Password;
use App\Infrastructure\Doctrine\Type\AbstractStringType;

/**
 * UserPasswordType.
 */
class UserPasswordType extends AbstractStringType
{
    const NAME = 'user_password';

    protected function valueObject(): string
    {
        return Password::class;
    }
}
