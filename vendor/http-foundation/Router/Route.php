<?php


namespace Gifts\HttpFoundation\Router;


use Gifts\HttpFoundation\ParameterBag;
use Gifts\HttpFoundation\RouteParameterBag;

class Route
{
    protected $name;

    protected $requestUri;

    protected $method;

    protected $controller;

    protected $action;

    /**
     * @var RouteParameterBag
     */
    protected $parameters;

    /**
     * @var RouteParameterBag
     */
    protected $segments;

    /**
     * @var string
     */
    protected $view;

    protected $viewTemplate;

    /**
     * @var boolean
     */
    protected $loginRequired;

    public function __construct($name, $parameters)
    {
        $this->name = $name;
        $this->requestUri = $parameters['uri'];
        $this->method = isset($parameters['method']) ? $parameters['method'] : null;
        $this->controller = $parameters['controller'];
        $this->action = $parameters['action'];
        $this->parameters = $this->resolveParameters($this->requestUri);
        $this->segments = $this->resolveSegments($this->requestUri);
        if (isset($parameters['view'])) {
            $this->view = $parameters['view'];
        }

        if (!empty($parameters['viewTemplate'])) {
            $this->viewTemplate = $parameters['viewTemplate'];
        }

        if (isset($parameters['loginRequired'])) {
            $this->loginRequired = (boolean)$parameters['loginRequired'];
        } else {
            $this->loginRequired = true;
        }
    }

    protected function possibleViewPath()
    {
        if (empty($this->getController()) || empty($this->getAction())) {
            return '';
        }
        $className = str_ireplace('controller', '', strtolower(end(explode('\\', $this->getController()))));
        $methodName = $this->getAction();

        return $className.'/'.$methodName;
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

        return new RouteParameterBag($cleanRequestUriParameters ? array_flip($cleanRequestUriParameters) : null);
    }

    protected function resolveSegments($requestUri)
    {
        return new RouteParameterBag(explode('/', trim($requestUri, '/')));
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
    public function getName()
    {
        return $this->name;
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
     * @return RouteParameterBag
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return RouteParameterBag
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return (($this->view === false || !empty($this->view)) ? $this->view : $this->possibleViewPath());
    }

    /**
     * @return mixed
     */
    public function getViewTemplate()
    {
        return $this->viewTemplate;
    }

    /**
     * @return bool
     */
    public function isLoginRequired(): bool
    {
        return $this->loginRequired;
    }

}