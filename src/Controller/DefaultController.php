<?php


namespace App\Controller;


class DefaultController extends Controller
{

    public function index($name = '')
    {

    }

    public function showGifts($id)
    {
        echo "Hello {$id}";
    }

}