<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject\User;

use App\Domain\Common\ValueObject\AbstractEnum;

/**
 * Role.
 */
class Role extends AbstractEnum
{
    const ADMINISTRATOR = 100;
    const CLIENT = 200;
    const EMPLOYEE = 300;
}
