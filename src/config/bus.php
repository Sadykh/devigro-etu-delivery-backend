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
                Command\User\Command\LoginUserCommand::class => Command\User\Handler\LoginUserHandler::class,
                Query\User\Query\GetUserQuery::class => Query\User\Handler\GetUserHandler::class,
            ];

            return new Infrastructure\CommandBus($container, $config);
        }
    );
};
