<?php


namespace Gifts\HttpFoundation\Router;


use Gifts\HttpFoundation\ParameterBag;

class RouteCollection extends ParameterBag
{

    public function __construct(ParameterBag $routeConfig)
    {
        foreach ($routeConfig->all() as $clusterName => $routes) {
            foreach ($routes as $name => $route) {
                $this->set($name, new Route($name, $route));
            }
        }
    }

}