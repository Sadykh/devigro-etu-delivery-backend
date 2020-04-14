<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\User;

use App\Domain\User\ValueObject\User\Role;
use App\Infrastructure\Doctrine\Type\AbstractIntegerType;

/**
 * UserRoleType.
 */
class UserRoleType extends AbstractIntegerType
{
    const NAME = 'user_role';

    protected function valueObject(): string
    {
        return Role::class;
    }
}
