<?php
// app/routes.php
use Symfony\Component\Routing;
use AppBundle\Controller\HelloController;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => array(new HelloController(), 'indexAction'),
)));

return $routes;
