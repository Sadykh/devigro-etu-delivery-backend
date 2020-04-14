<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\User;

use App\Domain\User\ValueObject\User\Email;
use App\Infrastructure\Doctrine\Type\AbstractStringType;

/**
 * UserEmailType.
 */
class UserEmailType extends AbstractStringType
{
    const NAME = 'user_email';

    protected function valueObject(): string
    {
        return Email::class;
    }
}
