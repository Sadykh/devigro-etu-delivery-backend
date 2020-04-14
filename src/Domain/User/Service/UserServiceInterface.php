<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

interface UserServiceInterface
{
    public function generateAdmin(): void;
    public function generateCourier(): void;
}
