<?php

declare(strict_types=1);

namespace App\Domain\Common\ValueObject;

/**
 * AbstractValueObject.
 */
abstract class AbstractValueObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     * @return static
     */
    public static function fromNative($value): self
    {
        $className = static::class;
        $vo = new $className($value);

        return $vo;
    }

    /**
     * Constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function toNative()
    {
        return $this->value;
    }
}
