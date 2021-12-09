<?php
// app/routes.php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => 'App\Controller\HelloController::helloAction',
)));

return $routes;
