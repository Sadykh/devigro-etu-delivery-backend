<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Middleware;

use App\Domain\User\Exception\UserNotFoundException;
use Assert\InvalidArgumentException;
use Assert\LazyAssertionException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * InvalidArgumentExceptionMiddleware.
 */
class InvalidArgumentExceptionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (LazyAssertionException $exception) {
            $errors = [];
            foreach ($exception->getErrorExceptions() as $errorException) {
                $errors[$errorException->getPropertyPath()] = $errorException->getMessage();
            }
            return new JsonResponse(['errors' => $errors], 400);
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(['errors' => [$exception->getPropertyPath() => $exception->getMessage()]], 400);
        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse(['errors' => [$exception->getMessage()]], 400);
        }
    }
}
