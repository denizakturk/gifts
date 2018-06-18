<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Gifts\Security\Token;

class DefaultController extends Controller
{

    public function index($name = '')
    {

    }

    public function showGifts($id)
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->get(UserRepository::class);
        /** @var Token $token */
        $token = $this->get(Token::class);

        $user = $userRepository->find($id);
        $token->setUser($user);

        return ['user' => $user];
    }

}