<?php


namespace Gifts\HttpFoundation\Router;


use Gifts\HttpFoundation\ParameterBag;

class RouteCollection extends ParameterBag
{

    public function __construct(ParameterBag $routeConfig)
    {
        foreach ($routeConfig->all() as $routerName => $routes) {
            foreach ($routes as $requestUri => $route) {
                $this->set($requestUri, new Route($requestUri, $route));
            }
        }
    }

}