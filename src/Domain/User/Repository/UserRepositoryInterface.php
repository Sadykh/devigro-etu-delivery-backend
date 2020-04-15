<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\Common\Repository\RepositoryInterface;
use App\Domain\User\Model\User;
use App\Domain\User\ValueObject\User\AuthToken;
use App\Domain\User\ValueObject\User\Email;
use App\Domain\User\ValueObject\UserId;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function existsByEmail(Email $email, ?UserId $excludeId = null): bool;

    public function fetchAll(): array;

    public function get(UserId $id): User;

    public function getByAuthToken(AuthToken $authToken): User;

    public function getByEmail(Email $email): User;
}
