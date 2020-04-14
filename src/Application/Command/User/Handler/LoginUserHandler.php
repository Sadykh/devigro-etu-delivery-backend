<?php

declare(strict_types=1);

namespace App\Application\Command\User\Handler;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\User\Command\LoginUserCommand;
use App\Application\FlusherInterface;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\AuthTokenManagerInterface;
use App\Domain\User\Service\PasswordHasherInterface;
use App\Domain\User\ValueObject\User\AuthToken;
use Ramsey\Uuid\Uuid;

/**
 * LoginUserHandler.
 */
class LoginUserHandler implements CommandHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    private PasswordHasherInterface $passwordHasher;

    private AuthTokenManagerInterface $authTokenManager;

    private FlusherInterface $flusher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordHasherInterface $passwordHasher,
        AuthTokenManagerInterface $authTokenManager,
        FlusherInterface $flusher
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->authTokenManager = $authTokenManager;
        $this->flusher = $flusher;
    }

    public function handle(LoginUserCommand $command): User
    {
        try {
            $user = $this->userRepository->getByEmail($command->getEmail());
        } catch (UserNotFoundException $e) {
            throw new \InvalidArgumentException('Неверный пользователь или пароль');
        }

        $user->login($command->getPassword(), $this->passwordHasher);

        $user->setAuthToken(new AuthToken(Uuid::uuid4()->toString()));
        $this->flusher->flush($user);

        return $user;
    }
}
