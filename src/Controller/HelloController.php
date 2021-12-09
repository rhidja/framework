<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function helloAction(Request $request, $name)
    {
        return new Response('Hello, this is my first test, '.$name);
    }
}
