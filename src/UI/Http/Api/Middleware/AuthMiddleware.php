<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Middleware;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\AuthTokenManagerInterface;
use App\Domain\User\ValueObject\User\AuthToken;
use App\Domain\User\ValueObject\UserId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * AuthMiddleware.
 */
class AuthMiddleware implements MiddlewareInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('Authorization');
        $token = str_replace(['Bearer', ' '], '', $token);

        try {
            $user = $this->userRepository->getByAuthToken(new AuthToken($token));
            $request = $request->withAttribute('user', $user);
        } catch (UserNotFoundException $e) {

        }

        return $handler->handle($request);
    }
}
