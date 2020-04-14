<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\ResponseEmitter;


$container = require_once __DIR__. '/../config/bootstrap.php';

AppFactory::setContainer($container);
$app = AppFactory::create();

$routes = require_once __DIR__ . '/../config/routes.php';
$routes($app);

//$request = ServerRequestFactory::createFromGlobals();
//
//echo '<pre>'; var_dump($request->getParsedBody()); echo '</pre>'; exit;

//$response = $app->handle($request);
//(new ResponseEmitter())->emit($response);

$app->run();
