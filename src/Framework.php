<?php
declare(strict_types=1);

namespace App;

use App\EventListener\ContentLengthListener;
use App\EventListener\GoogleListener;
use App\EventListener\StringResponseListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;

class Framework extends HttpKernel\HttpKernel
{
    public function __construct($routes)
    {
        $context = new Routing\RequestContext();
        $matcher = new Routing\Matcher\UrlMatcher($routes, $context);
        $requestStack = new RequestStack();

        $controllerResolver = new HttpKernel\Controller\ControllerResolver();
        $argumentResolver = new HttpKernel\Controller\ArgumentResolver();

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener(
            'App\Controller\ErrorController::exception'
        ));
        $eventDispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
        $eventDispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
        $eventDispatcher->addSubscriber(new StringResponseListener());
        $eventDispatcher->addSubscriber(new ContentLengthListener());
        $eventDispatcher->addSubscriber(new GoogleListener());
        $eventDispatcher->addSubscriber(new StringResponseListener());

        parent::__construct($eventDispatcher, $controllerResolver, $requestStack, $argumentResolver);
    }
}
