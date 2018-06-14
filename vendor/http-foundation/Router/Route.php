<?php


namespace Gifts\HttpFoundation\Router;


use Gifts\HttpFoundation\ParameterBag;

class Route
{
    protected $requestUri;

    protected $method;

    protected $controller;

    protected $action;

    /**
     * @var ParameterBag
     */
    protected $parameters;

    /**
     * @var ParameterBag
     */
    protected $segments;

    public function __construct($requestUri, $parameters)
    {
        $this->requestUri = $requestUri;
        $this->method = $parameters['method'];
        $this->controller = $parameters['controller'];
        $this->action = $parameters['action'];
        $this->parameters = $this->resolveParameters($requestUri);
        $this->segments = $this->resolveSegments($requestUri);
    }

    protected function resolveParameters($requestUri)
    {
        preg_match_all(
            '"|{\w*}|U"',
            $requestUri,
            $requestUriParameters,
            PREG_PATTERN_ORDER
        );

        $cleanRequestUriParameters = [];
        foreach ($requestUriParameters[0] as $key => $parameter) {
            if (!empty($parameter)) {
                $cleanRequestUriParameters[] = $parameter;
            }
        }

        return new ParameterBag($cleanRequestUriParameters ? array_flip($cleanRequestUriParameters) : null);
    }

    protected function resolveSegments($requestUri)
    {
        return new ParameterBag(explode('/', trim($requestUri, '/')));
    }

    public function getActionParameters()
    {
        $reflection = new \ReflectionMethod($this->getController(), $this->getAction());

        $parameters = [];

        foreach ($reflection->getParameters() as $parameter) {
            $parameterName = $parameter->getName();
            if ($this->getParameters()->has("{{$parameterName}}")) {
                $parameters[$parameter->getName()] = $this->getParameters()->get("{{$parameterName}}");
            } else {
                $parameters[$parameter->getName()] = null;
            }
        }

        return $parameters;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return ParameterBag
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return ParameterBag
     */
    public function getSegments()
    {
        return $this->segments;
    }
}