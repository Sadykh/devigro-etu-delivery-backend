<?php

declare(strict_types=1);

use App\Application\TransactionManagerInterface;
use App\Infrastructure\TransactionManager;
use DI\Container;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use App\Infrastructure\Doctrine\Type;

return function (Container $container) {
    $container->set(
        EntityManagerInterface::class,
        function () {
            $mappingDir = __DIR__.'/mapping';
            $cacheDir = __DIR__.'/../var/cache/doctrine';

            $config = Setup::createXMLMetadataConfiguration(
                [$mappingDir],
                getenv('APP_ENV') === 'test' || getenv('APP_ENV') === 'dev',
                $cacheDir,
                new FilesystemCache($cacheDir)
            );

            $types = [
                Type\User\UserEmailType::NAME => Type\User\UserEmailType::class,
                Type\User\UserIdType::NAME => Type\User\UserIdType::class,
                Type\User\UserPasswordType::NAME => Type\User\UserPasswordType::class,
                Type\User\UserRoleType::NAME => Type\User\UserRoleType::class,
                Type\User\UserNameType::NAME => Type\User\UserNameType::class,
                Type\User\UserAuthTokenType::NAME => Type\User\UserAuthTokenType::class,
            ];

            foreach ($types as $type => $class) {
                if (!DBAL\Types\Type::hasType($type)) {
                    DBAL\Types\Type::addType($type, $class);
                }
            }

//            $connection = ['url' => getenv('APP_DB_URL')];
            $connection = ['url' => 'mysql://user:password@mysql/app?charset=utf8'];

            return EntityManager::create($connection, $config);
        }
    );

    $container->set(
        TransactionManagerInterface::class,
        function (ContainerInterface $container) {
            return new TransactionManager($container->get(EntityManagerInterface::class));
        }
    );
};
