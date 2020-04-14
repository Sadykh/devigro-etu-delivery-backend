<?php

declare(strict_types=1);

namespace App\Domain\Common\ValueObject;

use Ramsey\Uuid\Uuid;

/**
 * AbstractId.
 */
abstract class AbstractId extends AbstractValueObject
{
    /**
     * @return static
     */
    public static function next(): self
    {
        return new static(Uuid::uuid4()->toString());
    }

    public function __toString()
    {
        return (string)$this->toNative();
    }
}
