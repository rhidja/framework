<?php
declare(strict_types=1);

namespace App;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Routing;
use Symfony\Component\Routing\RouteCollection;

class Container
{
    public static function register(RouteCollection $routes): ContainerBuilder
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../config/'));
        $loader->load('services.yaml');

        $containerBuilder->register('matcher', Routing\Matcher\UrlMatcher::class)
            ->setArguments([$routes, new Reference('context')])
        ;

        return $containerBuilder;
    }
}

