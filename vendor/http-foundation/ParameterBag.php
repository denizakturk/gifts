<?php


namespace Gifts\HttpFoundation;


class ParameterBag
{

    protected $parameters;

    public function __construct($parameters = null)
    {
        $this->parameters = $parameters;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->parameters);
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function all()
    {
        return $this->parameters;
    }

    public function count()
    {
        return count($this->parameters);
    }

    public function getKeys()
    {
        return array_keys($this->parameters);
    }

    public function getValues()
    {
        return array_values($this->parameters);
    }

}