<?php
// web/front.php

require_once __DIR__.'/../vendor/autoload.php';

use App\Framework;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller;
use App\EventListener\ContentLengthListener;
use App\EventListener\GoogleListener;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../config/routes.php';

$eventDispatcher = new EventDispatcher();
$eventDispatcher->addSubscriber(new ContentLengthListener());
$eventDispatcher->addSubscriber(new GoogleListener());

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new Controller\ControllerResolver();
$argumentResolver = new Controller\ArgumentResolver();

$framework = new Framework($eventDispatcher, $matcher, $controllerResolver, $argumentResolver);
$framework = new HttpKernel\HttpCache\HttpCache(
    $framework,
    new HttpKernel\HttpCache\Store(__DIR__.'/../cache'),
    new HttpKernel\HttpCache\Esi(),
    ['debug' => true]
);

$response = $framework->handle($request);

$response->send();
