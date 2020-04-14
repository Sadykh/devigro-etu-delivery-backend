<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\UI\Http\Api\Action as ApiAction;
use App\UI\Http\Api\Middleware;

return function (App $app) {
//    $container = $app->getContainer();

    $app->add(Middleware\JsonBodyParserMiddleware::class);
    $app->add(Middleware\InvalidArgumentExceptionMiddleware::class);
    $app->add(Middleware\AuthMiddleware::class);
    $app->add(Middleware\DomainExceptionMiddleware::class);
    $app->add(Middleware\RuntimeExceptionMiddleware::class);
    $app->add(Middleware\CorsMiddleware::class);
    $app->add(Middleware\NotFoundExceptionMiddleware::class);


};
