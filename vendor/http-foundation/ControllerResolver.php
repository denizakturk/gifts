<?php


namespace Gifts\HttpFoundation;


use Gifts\HttpFoundation\Router\Route;
use Gifts\HttpFoundation\Router\RouteCollection;

class ControllerResolver
{
    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @var ParameterBag
     */
    protected $requestSegments;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    public function requestParameterResolver(Request $request)
    {
        $cleanRequestUri = explode('?', $request->server->get('REQUEST_URI'))[0];
        $this->requestSegments = new RouteParameterBag(explode('/', trim($cleanRequestUri, '/')));

        return $this;
    }

    public function matchRouteToRequest()
    {
        /** @var Route $route */
        foreach ($this->routeCollection->all() as $route) {
            if ($route->getSegments()->count() == $this->requestSegments->count()) {

                $isMatch = false;

                foreach ($route->getSegments()->all() as $key => $segment) {
                    if ($route->getParameters()->has($segment)) {
                        $parameterValue = $this->requestSegments->all()[$key] ? $this->requestSegments->all(
                        )[$key] : null;
                        $route->getParameters()->set($segment, $parameterValue);
                        continue;
                    }

                    if (in_array($segment, $this->requestSegments->getValues())) {
                        $isMatch = true;
                    } else {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    return $route;
                }
            }

        }

        return false;
    }

}