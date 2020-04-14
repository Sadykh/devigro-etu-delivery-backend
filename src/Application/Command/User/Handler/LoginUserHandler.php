<?php

declare(strict_types=1);

namespace App\Application\Command\User\Handler;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\User\Command\LoginUserCommand;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\AuthTokenManagerInterface;
use App\Domain\User\Service\PasswordHasherInterface;

/**
 * LoginUserHandler.
 */
class LoginUserHandler implements CommandHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    private PasswordHasherInterface $passwordHasher;

    private AuthTokenManagerInterface $authTokenManager;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordHasherInterface $passwordHasher,
        AuthTokenManagerInterface $authTokenManager
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->authTokenManager = $authTokenManager;
    }

    public function handle(LoginUserCommand $command): string
    {
//        try {
//            $user = $this->userRepository->getByEmail($command->getEmail());
//        } catch (UserNotFoundException $e) {
//            throw new \InvalidArgumentException('Неверный пользователь или пароль');
//        }
//
//        $user->login($command->getPassword(), $this->passwordHasher);

        $token = 'hello';

        return $token;
    }
}
