<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HelloController
{
    public function helloAction(Request $request)
    {
        return new Response('This is My first controller');
    }
}
