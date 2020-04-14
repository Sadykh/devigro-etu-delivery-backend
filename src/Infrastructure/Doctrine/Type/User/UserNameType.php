<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\User;

use App\Domain\User\ValueObject\User\Name;
use App\Infrastructure\Doctrine\Type\AbstractStringType;

class UserNameType extends AbstractStringType
{
    const NAME = 'user_name';

    protected function valueObject(): string
    {
        return Name::class;
    }
}
