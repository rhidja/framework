<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HelloController
{
    public function helloAction(Request $request, $name)
    {
        return new Response('Hello, this is my first test, '.$name);
    }
}
