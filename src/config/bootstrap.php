<?php

declare(strict_types=1);

use DI\Container;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    (new Dotenv())->load(__DIR__ . '/../.env');
}

$container = new Container();

$app = require_once __DIR__ . '/../config/app.php';
$app($container);

$database = require_once __DIR__ . '/../config/database.php';
$database($container);

$repository = require_once __DIR__ . '/../config/repository.php';
$repository($container);

$event = require_once __DIR__ . '/../config/event.php';
$event($container);

$bus = require_once __DIR__ . '/../config/bus.php';
$bus($container);

$renderer = require_once __DIR__ . '/../config/renderer.php';
$renderer($container);

return $container;

