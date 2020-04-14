<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Action;

use App\Application\CommandBusInterface;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * AbstractAction.
 */
abstract class AbstractAction// implements RequestHandlerInterface
{
    protected $args;

    protected $bus;

    /**
     * @var User|null
     */
    protected $user;

    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        foreach ($args as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }
        return $this->handle($request);
    }

    protected function auth(ServerRequestInterface $request, bool $isOptional = false): void
    {
        $this->user = $request->getAttribute('user');
        if ($this->user === null && $isOptional === false) {
            throw new UserNotFoundException('401');
        }
    }

    protected function asJson(array $data, int $status = 200): ResponseInterface
    {
        return new JsonResponse($data, $status);
    }
}
