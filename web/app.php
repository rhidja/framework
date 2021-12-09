<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__ . '/../config/routes.php';

$framework = new Framework($routes);
$response = $framework->handle($request);

$response->send();
