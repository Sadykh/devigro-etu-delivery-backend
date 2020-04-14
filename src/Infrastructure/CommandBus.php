<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\CommandBusInterface;
use App\Application\CommandInterface;
use Psr\Container\ContainerInterface;

/**
 * CommandBus.
 */
class CommandBus implements CommandBusInterface
{
    private $container;

    private $map;

    public function __construct(ContainerInterface $container, array $map)
    {
        $this->container = $container;
        $this->map = $map;
    }

    public function handle(CommandInterface $command)
    {
        $handlerClassName = $this->map[get_class($command)] ?? null;

        if ($handlerClassName === null) {
            throw new \RuntimeException('Command handler not found');
        }

        return $this->container->get($handlerClassName)->handle($command);
    }
}
