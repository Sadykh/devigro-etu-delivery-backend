<?php

declare(strict_types=1);

namespace App\Domain\Common\Model;

use DateTimeImmutable;

/**
 * SoftRemovable.
 */
trait SoftRemovableTrait
{
    /**
     * @var bool
     */
    private $isRemoved = false;

    /**
     * @var DateTimeImmutable|null
     */
    private $removedAt;

    /**
     * @return bool
     */
    public function isRemoved(): bool
    {
        return $this->isRemoved;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getRemovedAt(): ?DateTimeImmutable
    {
        return $this->removedAt;
    }

    public function remove(): void
    {
        $this->isRemoved = true;
        $this->removedAt = new DateTimeImmutable();
    }
}
