<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject\User;

use App\Domain\Common\ValueObject\AbstractEnum;

class Role extends AbstractEnum
{
    public const ADMIN = 100;

    public const COURIER = 200;

    public function isAdmin(): bool
    {
        return $this->getValue() === self::ADMIN;
    }

    public function isCourier(): bool
    {
        return $this->getValue() === self::COURIER;
    }
}
