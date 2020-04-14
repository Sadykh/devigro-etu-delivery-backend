<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\AuthTokenManagerInterface;
use App\Domain\User\Service\PasswordHasherInterface;
use App\Domain\User\Service\UserServiceInterface;
use App\Domain\User\Specification\UniqueUserEmailSpecification;
use App\Domain\User\ValueObject\User\AuthToken;
use App\Domain\User\ValueObject\User\Email;
use App\Domain\User\ValueObject\User\Name;
use App\Domain\User\ValueObject\User\Password;
use App\Domain\User\ValueObject\User\Role;
use App\Domain\User\ValueObject\UserId;
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;

    private PasswordHasherInterface $passwordHasher;

    private UniqueUserEmailSpecification $uniqueUserEmailSpecification;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface      $userRepository
     * @param PasswordHasherInterface      $passwordHasher
     * @param UniqueUserEmailSpecification $uniqueUserEmailSpecification
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordHasherInterface $passwordHasher,
        UniqueUserEmailSpecification $uniqueUserEmailSpecification
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->uniqueUserEmailSpecification = $uniqueUserEmailSpecification;
    }

    public function generateAdmin(): void
    {
        try {
            $this->userRepository->getByEmail(new Email('admin@devigro.ru'));
        } catch (UserNotFoundException $exception) {
            $password = 'eltech';
            $user = new User(
                UserId::next(),
                new Role(Role::ADMIN),
                new Email('admin@devigro.ru'),
                new Password($this->passwordHasher->hash($password)),
                new Name('admin'),
                new AuthToken(Uuid::uuid4()->toString()),
                $this->uniqueUserEmailSpecification
            );
            $this->userRepository->add($user);
        }
    }

    public function generateCourier(): void
    {
        try {
            $this->userRepository->getByEmail(new Email('courier@devigro.ru'));
        } catch (UserNotFoundException $exception) {
            $password = 'eltech';
            $user = new User(
                UserId::next(),
                new Role(Role::COURIER),
                new Email('courier@devigro.ru'),
                new Password($this->passwordHasher->hash($password)),
                new Name('courier'),
                new AuthToken(Uuid::uuid4()->toString()),
                $this->uniqueUserEmailSpecification
            );
            $this->userRepository->add($user);
        }
    }

}
