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

    $app->options('/api/v1/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->get('/', ApiAction\IndexAction::class);
    $app->get('/api/v1', ApiAction\IndexAction::class);

    $app->group('/api/v1/auth', function (Group $group) {
        $group->post('/login', ApiAction\Auth\LoginAction::class);
    });

    $app->group('/api/v1/courier', function (Group $group) {
        $group->get('/self', ApiAction\Courier\SelfAction::class);
    });
};
