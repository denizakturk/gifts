<?php

namespace Gifts\Security;

use Gifts\HttpFoundation\ParameterBag;
use Gifts\HttpFoundation\Request;

class Token extends ParameterBag
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request->session->all());
    }

    public function passwordAuthentication(User $user, $password)
    {
        if($user->password == md5($password)){
            return true;
        }

        return false;
    }

    public function getUser()
    {
        return ($this->has('user') ? unserialize($this->get('user')) : null);
    }

    public function isLogin()
    {
        $user = $this->getUser();

        return $user instanceof User && $user->getId() > 0;
    }

    public function setUser(User $user)
    {
        $this->set('user', serialize($user));
    }

    public function logout()
    {
        $this->unset('user');
    }

    public function __destruct()
    {
        $_SESSION = $this->all();
    }
}