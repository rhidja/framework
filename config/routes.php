<?php
// app/routes.php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => 'App\Controller\HelloController::helloAction',
)));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => 'App\Controller\LeapYearController::index',
]));

$routes->add('string_response', new Routing\Route('/string_response', [
    'year' => null,
    '_controller' => 'App\Controller\StringResponseController::index',
]));

return $routes;
