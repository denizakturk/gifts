<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Gifts\HttpFoundation\Request;
use Gifts\Security\Token;

class SecurityController extends Controller
{

    public function loginForm()
    {
        /** @var Token $token */
        $token = $this->get(Token::class);

        if ($token->isLogin()) {
            $this->redirect('/');
        }

        return [];
    }

    public function login()
    {
        /** @var Request $request */
        $request = $this->get(Request::class);
        /** @var UserRepository $userRepository */
        $userRepository = $this->get(UserRepository::class);
        /** @var Token $token */
        $token = $this->get(Token::class);
        $user = $userRepository->findBy(['email' => $request->request->get('_email')]);
        if ($token->passwordAuthentication($user, $request->request->get('_password'))) {
            $token->setUser($user);
        }

        $this->redirectToReferrer();
    }

    public function logout()
    {
        /** @var Token $token */
        $token = $this->get(Token::class);

        $token->logout();

        $this->redirect('/');
    }

}