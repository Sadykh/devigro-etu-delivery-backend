<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject\User;

use App\Domain\Common\ValueObject\AbstractString;
use Assert\Assertion;

/**
 * Email.
 */
class Email extends AbstractString
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        Assertion::maxLength($value, 64, 'Максимальная длина 64 символа', 'email');
        Assertion::email($value, 'Неверный e-mail', 'email');
    }
}
