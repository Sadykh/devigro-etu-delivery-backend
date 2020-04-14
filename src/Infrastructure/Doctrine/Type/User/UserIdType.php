<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\User;

use App\Domain\User\ValueObject\UserId;
use App\Infrastructure\Doctrine\Type\AbstractIdType;

/**
 * UserIdType.
 */
class UserIdType extends AbstractIdType
{
    const NAME = 'user_id';

    protected function valueObject(): string
    {
        return UserId::class;
    }
}
