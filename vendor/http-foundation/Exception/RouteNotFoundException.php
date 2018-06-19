<?php

namespace Gifts\HttpFoundation\Exception;

class RouteNotFoundException extends \Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Route not found! - ".$message, 500, $previous);
    }

}