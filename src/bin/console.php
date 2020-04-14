<?php

declare(strict_types=1);

use Doctrine\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\Migrations\Tools\Console\Command as DoctrineMigrationCommands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Application;
use App\UI\Console;

$container = require_once __DIR__. '/../config/bootstrap.php';

$cli = new Application('Application Console');

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

$connection = $entityManager->getConnection();
$configuration = new Configuration($connection);
$configuration->setMigrationsDirectory(__DIR__ . '/../src/Infrastructure/Migrations');
$configuration->setMigrationsNamespace('App\Infrastructure\Migrations');

$helperSet = $cli->getHelperSet();
$helperSet->set(new QuestionHelper(), 'question');
$helperSet->set(new ConnectionHelper($connection), 'db');
$helperSet->set(new EntityManagerHelper($entityManager), 'em');
$helperSet->set(new ConfigurationHelper($connection, $configuration));

$cli->addCommands(array(
    new DoctrineMigrationCommands\DumpSchemaCommand(),
    new DoctrineMigrationCommands\ExecuteCommand(),
    new DoctrineMigrationCommands\GenerateCommand(),
    new DoctrineMigrationCommands\LatestCommand(),
    new DoctrineMigrationCommands\MigrateCommand(),
    new DoctrineMigrationCommands\RollupCommand(),
    new DoctrineMigrationCommands\StatusCommand(),
    new DoctrineMigrationCommands\VersionCommand(),
    new DoctrineMigrationCommands\DiffCommand(),
));

$commands = [
    Console\InitCommand::class,
];
foreach ($commands as $command) {
    $cli->add($container->get($command));
}

$exitCode = $cli->run();

exit($exitCode);

