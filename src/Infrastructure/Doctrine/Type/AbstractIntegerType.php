<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

/**
 * AbstractIntegerType.
 */
abstract class AbstractIntegerType extends IntegerType
{
    abstract protected function valueObject(): string;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $className = $this->valueObject();
        return $value instanceof $className ? $value->toNative() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->valueObject();
        return $value !== null ? new $className((int)$value) : null;
    }
}
