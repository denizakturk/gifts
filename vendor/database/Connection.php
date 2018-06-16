<?php

namespace Gifts\Database;

use Gifts\HttpFoundation\ParameterBag;

class Connection extends \PDO implements ConnectionInterface
{

    public function __construct(ParameterBag $parameters)
    {
        parent::__construct($parameters->get('dns'), $parameters->get('username'), $parameters->get('password'), $parameters->get('options'));
    }

}