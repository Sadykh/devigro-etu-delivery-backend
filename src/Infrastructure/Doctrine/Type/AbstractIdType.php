<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

/**
 * AbstractIdType.
 */
abstract class AbstractIdType extends GuidType
{
    abstract protected function valueObject(): string;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $className = $this->valueObject();
        return $value instanceof $className ? (string)$value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->valueObject();
        return $value !== null ? new $className($value) : null;
    }
}
