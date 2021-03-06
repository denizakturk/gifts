<?php

namespace Gifts\HttpFoundation;

class Request
{
    /**
     * @var ParameterBag
     */
    public $query;
    /**
     * @var ParameterBag
     */
    public $request;
    /**
     * @var ParameterBag
     */
    public $cookie;
    /**
     * @var ParameterBag
     */
    public $server;

    public $session;

    public function __construct()
    {
        session_start();
        $this->query = new ParameterBag($_GET);
        $this->request = new ParameterBag($_POST);
        $this->cookie = new ParameterBag($_COOKIE);
        $this->server = new ParameterBag($_SERVER);
        $this->session = new ParameterBag($_SESSION);
    }


}