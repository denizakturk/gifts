<?php

namespace App;

use Gifts\Database\Connection;
use Gifts\DependencyInjection\Container;
use Gifts\HttpFoundation\ControllerResolver;
use Gifts\HttpFoundation\Exception\RouteNotFoundException;
use Gifts\HttpFoundation\ParameterBag;
use Gifts\HttpFoundation\Request;
use Gifts\HttpFoundation\Router\Route;
use Gifts\HttpFoundation\Router\RouteCollection;
use Gifts\Security\AccessControl;
use Gifts\Security\Token;
use Gifts\Template\Render;
use Gifts\Template\ViewApplicationInterface;

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

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->configPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
        $this->request = $request;
        $this->loadConfig();
        $this->container = new Container();
        $this->classLoader();
    }

    public function run()
    {
        $route = $this->routeResolver($this->request);
        /** @var AccessControl $accessControl */
        $accessControl = $this->container->get(AccessControl::class);
        $token = $this->container->get(Token::class);
        $accessControl->loginRequired($route, $token);
        $accessControl->methodRequired($route, $this->request);
        $result = $this->controllerResolver($route);

        if ($route->getView() === false) {
            echo json_encode($result);

            return;
        }
        $render = new Render();
        $result = array_merge($result, ['app' => $this->container->get(ViewApplicationInterface::class)]);

        $renderedView = $render->render($route->getView(), $result);

        if ($route->getViewTemplate() === false) {
            echo $renderedView;
        } elseif (empty($route->getViewTemplate())) {
            echo $render->render(
                $render->templateName,
                ['content' => $renderedView, 'app' => $this->container->get(ViewApplicationInterface::class)]
            );
        } else {
            echo $render->render($route->getViewTemplate(), ['content' => $renderedView]);
        }

        return;
    }

    protected function controllerResolver(Route $route)
    {
        $controllerName = $route->getController();

        $controller = new $controllerName($this->container);

        return call_user_func_array([$controller, $route->getAction()], $route->getActionParameters());
    }

    protected function routeResolver(Request $request)
    {
        $routeCollection = $this->container->get(RouteCollection::class);
        $controllerResolver = new ControllerResolver($routeCollection);
        /** @var Route $route */
        $route = $controllerResolver->requestParameterResolver($request)->matchRouteToRequest();
        if (!$route instanceof Route) {
            throw new RouteNotFoundException($request->server->get('REQUEST_URI'));
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
        $classes[] = $this->container;
        $classes[] = new Connection($this->database);
        $classes[] = new RouteCollection($this->routing);
        $classes[] = $this->request;
        $classes[] = new Token($this->request);

        foreach ($classes as $class) {
            $this->container->set($class);
        }
    }
}