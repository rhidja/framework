<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\EventListener\StringResponseListener;
use App\Framework;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller;
use App\EventListener\ContentLengthListener;
use App\EventListener\GoogleListener;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__ . '/../config/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new Controller\ControllerResolver();
$argumentResolver = new Controller\ArgumentResolver();

$eventDispatcher = new EventDispatcher();
$eventDispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener(
    'App\Controller\ErrorController::exception'
));
$eventDispatcher->addSubscriber(new ContentLengthListener());
$eventDispatcher->addSubscriber(new GoogleListener());
$eventDispatcher->addSubscriber(new StringResponseListener());
$eventDispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
$eventDispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));

$framework = new Framework($eventDispatcher, $controllerResolver, $requestStack, $argumentResolver);
$response = $framework->handle($request);

$response->send();
