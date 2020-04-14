<?php

declare(strict_types=1);

use Psr\EventDispatcher\EventDispatcherInterface;
use DI\Container;
use App\Infrastructure\EventDispatcher;
use App\Domain;

return function (Container $container) {
    $container->set(
        EventDispatcherInterface::class,
        function () use ($container) {
            return new EventDispatcher(
                $container,
                [
                ]
            );
        }
    );
};
