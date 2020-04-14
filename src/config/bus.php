<?php

declare(strict_types=1);

use App\Application;
use App\Application\Command;
use App\Domain;
use App\Infrastructure;
use App\Application\Query;
use DI\Container;

return function (Container $container) {
    $container->set(
        Application\CommandBusInterface::class,
        function () use ($container) {

            $config = [



            ];

            return new Infrastructure\CommandBus($container, $config);
        }
    );
};
