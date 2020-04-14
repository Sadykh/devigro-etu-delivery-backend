<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject\User;

use App\Domain\Common\ValueObject\AbstractString;
use Assert\Assertion;

class Name extends AbstractString
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        Assertion::maxLength($value, 64, 'Максимальная длина 64 символа', 'name');
    }
}
