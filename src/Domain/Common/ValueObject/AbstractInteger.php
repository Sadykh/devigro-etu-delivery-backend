<?php

declare(strict_types=1);

namespace App\Domain\Common\ValueObject;

use App\Domain\Common\ValueObject\AbstractValueObject;
use Assert\Assertion;

/**
 * AbstractInteger.
 */
abstract class AbstractInteger extends AbstractValueObject
{
    public function __construct($value)
    {
        parent::__construct($value);
        Assertion::integer($value);
    }
}
