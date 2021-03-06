<?php namespace App\Controller;


use Gifts\DependencyInjection\Container;
use Gifts\HttpFoundation\Request;
use Gifts\Security\Token;

class Controller
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

    protected function redirect($uri)
    {
        header('Location: '.$uri);
        exit;
    }

    protected function redirectToReferrer()
    {
        /** @var Request $request */
        $request = $this->get(Request::class);
        $referrer = $request->server->get('HTTP_REFERER');
        $this->redirect($referrer);
    }
}