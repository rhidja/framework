<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use App\Container;

$routes = include __DIR__.'/../config/routes.php';

$request = Request::createFromGlobals();

$container = Container::register($routes);
$container->setParameter('debug', true);
$container->setParameter('charset', 'UTF-8');

$response = $container->get('framework')->handle($request);

$response->send();
