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

    public function getUser()
    {
        return ($this->has('user') ? unserialize($this->get('user')) : null);
    }

    public function setUser(User $user)
    {
        $this->set('user', serialize($user));
    }

    public function __destruct()
    {
        $_SESSION = $this->all();
        session_abort();
    }
}