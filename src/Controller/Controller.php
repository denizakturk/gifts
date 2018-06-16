<?php namespace App\Controller;


use Gifts\DependencyInjection\Container;

class Controller
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function get($class)
    {
        return $this->container->get($class);
    }

    protected function set()
    {
        throw new \Exception('Not use settable');
    }
}