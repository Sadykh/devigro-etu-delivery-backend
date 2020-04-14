<?php

declare(strict_types=1);

use DI\Container;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain;
use App\Infrastructure\Repository;

return function (Container $container) {
    $repositories = [
        Domain\User\Repository\UserRepositoryInterface::class => [
            Repository\User\UserRepository::class,
            Domain\User\Model\User::class,
        ],
    ];

    /** @var EntityManagerInterface $entityManager */
    $entityManager = $container->get(EntityManagerInterface::class);

    foreach ($repositories as $name => list($repositoryClassName, $entityClassName)) {
        $container->set(
            $name,
            function () use ($entityManager, $repositoryClassName, $entityClassName) {
                return new $repositoryClassName($entityManager, $entityManager->getClassMetadata($entityClassName));
            }
        );
    }
};
