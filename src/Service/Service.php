<?php


namespace App\Service;


use Gifts\DependencyInjection\Container;
use Gifts\Security\Token;

class Service
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function get($class)
    {
        return $this->container->get($class);
    }

    protected function getUser()
    {

        if ($this->container->has(Token::class)) {
            /** @var Token $token */
            $token = $this->get(Token::class);

            return $token->getUser();
        }
    }

    protected function set()
    {
        throw new \Exception('Not use settable');
    }
}