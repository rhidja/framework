<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

class HelloController
{
    public function helloAction(Request $request, $name)
    {
        $filesystemLoader = new FilesystemLoader(__DIR__.'/../../templates/views/%name%');

        $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
        $templating->set(new SlotsHelper());

        return new Response($templating->render('hello.html.twig', ['firstname' => 'Fabien']));
        //return new Response('Hello, this is my first test, '.$name);
    }
}
