<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * DomainExceptionMiddleware.
 */
class DomainExceptionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (\DomainException $exception) {
            return new JsonResponse(['errors' => [$exception->getMessage()]], 400);
        }
    }
}
