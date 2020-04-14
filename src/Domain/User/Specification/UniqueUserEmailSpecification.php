<?php

declare(strict_types=1);

namespace App\Domain\User\Specification;

use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;

class UniqueUserEmailSpecification
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function isSatisfiedBy(User $user): bool
    {
        return !$this->userRepository->existsByEmail($user->getEmail(), $user->getId());
    }
}
