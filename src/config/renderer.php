<?php

declare(strict_types=1);

use Slim\Views\Twig;
use DI\Container;

return function (Container $container) {
    $container->set(
        Twig::class,
        function () use ($container) {
            return new Twig(__DIR__ . '/../templates/', [
                'debug' => (bool)getenv('APP_DEBUG'),
                'cache' => __DIR__ . '/../var/cache/twig'
            ]);
        }
    );
};
