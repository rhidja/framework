<?php
// web/front.php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller;
use Symfony\Component\Routing;
use App\Framework;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../config/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new Controller\ControllerResolver();
$argumentResolver = new Controller\ArgumentResolver();

$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
