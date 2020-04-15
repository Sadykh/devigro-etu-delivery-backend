<?php

declare(strict_types=1);

namespace App\Application\Query\User\Handler;

use App\Application\Query\User\Query\GetUserQuery;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;

class GetUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserQuery $query): User
    {
        return $this->userRepository->get($query->getId());
    }
}
