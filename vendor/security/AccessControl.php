<?php


namespace Gifts\Security;


use Gifts\HttpFoundation\Request;
use Gifts\HttpFoundation\Router\Route;

class AccessControl
{
    public function loginRequired(Route $route, Token $token)
    {
        if ($route->isLoginRequired() && !$token->isLogin()) {
            header('Location: /security/login');
            exit;
        }
    }

    public function methodRequired(Route $route, Request $request)
    {
        if (empty($route->getMethod()) || in_array($request->server->get('REQUEST_METHOD'), $route->getMethod())) {
            return true;
        } else {
            throw new \Exception('Bad request');
        }
    }

}