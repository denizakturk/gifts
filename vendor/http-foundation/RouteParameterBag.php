<?php


namespace Gifts\HttpFoundation;


class RouteParameterBag extends ParameterBag
{

    public function set($key, $value)
    {
        return parent::set($key, $value);
    }

    public function get($key, $default = null)
    {
        return parent::get($key, $default);
    }

}