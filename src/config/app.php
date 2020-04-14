<?php

declare(strict_types=1);

use DI\Container;
use App\Application;
use App\Domain;
use App\Infrastructure;

return function (Container $container) {
    $container->set(Application\FlusherInterface::class, function () use ($container) {
        return $container->get(Infrastructure\Flusher::class);
    });

    $container->set(Domain\User\Service\UserServiceInterface::class, function () use ($container) {
        return $container->get(Infrastructure\Service\User\UserService::class);
    });

    $container->set(Domain\User\Service\AuthTokenManagerInterface::class, function () use ($container) {
        return $container->get(Infrastructure\Service\User\AuthTokenManager::class);
    });
    $container->set(Domain\User\Service\PasswordHasherInterface::class, function () use ($container) {
        return $container->get(Infrastructure\Service\User\PasswordHasher::class);
    });
};
