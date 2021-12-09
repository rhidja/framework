<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use App\Controller\HelloController;

class HelloControllerTest extends TestCase
{
    public function testControllerResponse()
    {
        $matcher = $this->createMock(UrlMatcherInterface::class);
        // use getMock() on PHPUnit 5.3 or below
        // $matcher = $this->getMock(Routing\Matcher\UrlMatcherInterface::class);

        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->returnValue([
                '_route' => 'hello/{name}',
                'name' => 'Ramtane',
                '_controller' => [new HelloController(), 'helloAction'],
            ]))
        ;
        $matcher
            ->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->createMock(RequestContext::class)))
        ;
        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $framework = new App\Framework($matcher, $controllerResolver, $argumentResolver);
        $response = $framework->handle(new Request());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Hello, this is my first test, Ramtane', $response->getContent());
    }
}
