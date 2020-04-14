<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Middleware;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\AuthTokenManagerInterface;
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
    private AuthTokenManagerInterface $authTokenManager;

    private UserRepositoryInterface $userRepository;

    public function __construct(AuthTokenManagerInterface $authTokenManager, UserRepositoryInterface $userRepository)
    {
        $this->authTokenManager = $authTokenManager;
        $this->userRepository = $userRepository;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('Authorization');
        $token = str_replace(['Bearer', ' '],'', $token);
        if ($token) {
            $data = null;
            try {
                $data = $this->authTokenManager->decode($token);
            } catch (\Exception $e) {
            }
            if (is_array($data)) {
                try {
                    $user = $this->userRepository->get(new UserId($data['id']));
                    if ($user->getStatus()->isActive()) {
                        $request = $request->withAttribute('user', $user);
                    }
                } catch (UserNotFoundException $e) {
                }
            }
        }

        return $handler->handle($request);
    }
}
