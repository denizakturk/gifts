<?php


namespace Gifts\Template;

use Gifts\HttpFoundation\Request;
use Gifts\HttpFoundation\Router\Route;
use Gifts\HttpFoundation\Router\RouteCollection;
use Gifts\Security\Token;

class ViewApplicationInterface
{

    /**
     * @var Token
     */
    protected $token;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    public function __construct(Request $request, Token $token, RouteCollection $routeCollection)
    {
        $this->request = $request;
        $this->token = $token;
        $this->routeCollection = $routeCollection;
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    public function url($routeName, array $parameters = null)
    {
        $route = $this->routeCollection->get($routeName);

        if (!$route instanceof Route) {
            throw new \Exception('Not found '.$routeName.' named route');
        }

        if ($route->getParameters()->count() < 1) {
            return $route->getRequestUri();
        }

        if ($route->getParameters()->count() > count($parameters)) {
            throw new \Exception('Not match parameters');
        }

        foreach ($parameters as $key => $parameter) {
            $route->getParameters()->set($key, $parameters);
        }

        return str_ireplace(
            $route->getParameters()->getKeys(),
            $route->getParameters()->getValues(),
            $route->getRequestUri()
        );


    }
}