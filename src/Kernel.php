<?php

namespace App;

use Gifts\Database\Connection;
use Gifts\Database\EntityManager;
use Gifts\DependencyInjection\Container;
use Gifts\HttpFoundation\ControllerResolver;
use Gifts\HttpFoundation\Exception\RouteNotFoundException;
use Gifts\HttpFoundation\ParameterBag;
use Gifts\HttpFoundation\Request;
use Gifts\HttpFoundation\Router\Route;
use Gifts\HttpFoundation\Router\RouteCollection;
use Gifts\Security\Token;
use Gifts\Template\Render;

class Kernel
{
    /**
     * @var ParameterBag
     */
    protected $routing;
    /**
     * @var ParameterBag
     */
    protected $database;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string
     */
    protected $configPath;

    public function __construct()
    {
        $this->configPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
        $this->loadConfig();
        $this->container = new Container();
        $this->classLoader();
    }

    public function handle(Request $request)
    {
        $route = $this->routeResolver($request);

        $result = $this->controllerResolver($route);

        $render = new Render();
        $renderedView = $render->render($route->getView(), $result);

        if ($route->getViewTemplate() === false) {
            echo $renderedView;
        } elseif (empty($route->getViewTemplate())) {
            echo $render->render($render->templateName, ['content' => $renderedView]);
        } else {
            echo $render->render($route->getViewTemplate(), ['content' => $renderedView]);
        }
    }

    protected function controllerResolver(Route $route)
    {
        $controllerName = $route->getController();

        $controller = new $controllerName($this->container);

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

    protected function loadConfig()
    {
        $this->routing = new ParameterBag(include $this->configPath.'routing.php');
        $this->database = new ParameterBag(include $this->configPath.'database.php');
    }

    protected function classLoader()
    {
        $classes = [];

        $classes[] = new Connection($this->database);
        $request = new Request();
        $classes[] = $request;
        $classes[] = new Token($request);

        foreach ($classes as $class) {
            $this->container->set($class);
        }
    }
}