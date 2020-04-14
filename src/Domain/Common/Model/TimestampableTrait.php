<?php

declare(strict_types=1);

namespace App\Domain\Common\Model;

use DateTimeImmutable;
use Exception;

/**
 * TimestampableTrait.
 */
trait TimestampableTrait
{
    /**
     * @var DateTimeImmutable
     */
    protected $createdAt;

    /**
     * @var DateTimeImmutable|null
     */
    protected $updatedAt;

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function triggerCreatedAt(): void
    {
        try {
            $this->createdAt = new DateTimeImmutable();
        } catch (Exception $e) {
        }
    }

    public function triggerUpdatedAt(): void
    {
        try {
            $this->updatedAt = new DateTimeImmutable();
        } catch (Exception $e) {
        }
    }
}
