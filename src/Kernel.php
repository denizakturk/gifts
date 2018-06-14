<?php

namespace App;

use Gifts\HttpFoundation\ControllerResolver;
use Gifts\HttpFoundation\Exception\RouteNotFoundException;
use Gifts\HttpFoundation\ParameterBag;
use Gifts\HttpFoundation\Request;
use Gifts\HttpFoundation\Router\Route;
use Gifts\HttpFoundation\Router\RouteCollection;

class Kernel
{
    /**
     * @var ParameterBag
     */
    protected $routing;

    protected $configPath;

    public function __construct()
    {
        $this->configPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
        $this->loadConfig();
    }

    public function handle(Request $request)
    {

        $route = $this->routeResolver($request);

        $result = $this->controllerResolver($request);


    }

    protected function controllerResolver(Request $request)
    {
        $routeCollection = new RouteCollection($this->routing);
        $controllerResolver = new ControllerResolver($routeCollection);
        /** @var Route $route */
        $route = $controllerResolver->requestParameterResolver($request)->matchRouteToRequest();

        if (!$route instanceof Route) {
            throw new RouteNotFoundException();
        }

        $controllerName = $route->getController();

        $controller = new $controllerName();

        return call_user_func_array([$controller, $route->getAction()], $route->getActionParameters());
    }

    protected function routeResolver(Request $request)
    {
        $routeCollection = new RouteCollection($this->routing);
        $controllerResolver = new ControllerResolver($routeCollection);
        /** @var Route $route */
        $route = $controllerResolver->requestParameterResolver($request)->matchRouteToRequest();

        if (!$route instanceof Route) {
            throw new RouteNotFoundException();
        }

        return $route;
    }

    public function loadConfig()
    {
        $this->routing = new ParameterBag(include $this->configPath.'routing.php');
    }
}