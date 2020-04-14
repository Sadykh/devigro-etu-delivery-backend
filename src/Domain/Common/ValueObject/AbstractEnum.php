<?php

declare(strict_types=1);

namespace App\Domain\Common\ValueObject;

use Assert\Assertion;

/**
 * AbstractEnum.
 */
abstract class AbstractEnum extends AbstractValueObject
{
    private static $values;

    public function __construct($value)
    {
        parent::__construct($value);
        Assertion::inArray($value, self::getValues(), 'Incorrect value ' . get_class($this));
    }

    public static function getNames(): array
    {
        if (!isset(self::$values[static::class])) {
            $constants = (new \ReflectionClass(static::class))->getConstants();
            self::$values[static::class] = array_combine($constants, array_keys($constants));
        }

        return self::$values[static::class];
    }

    public static function getValues(): array
    {
        return array_keys(self::getNames());
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::getNames()[$this->value];
    }
}
