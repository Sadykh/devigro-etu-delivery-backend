<?php

declare(strict_types=1);

namespace App\Domain\Common\ValueObject;

use Assert\Assertion;

/**
 * AbstractString.
 */
abstract class AbstractString extends AbstractValueObject
{
    public function __construct($value)
    {
        parent::__construct($value);
        Assertion::string($value);
    }

    public function __toString()
    {
        return (string)$this->toNative();
    }
}
