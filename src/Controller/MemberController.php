<?php


namespace App\Controller;


use App\Service\SocialUserService;

class MemberController extends Controller
{

    /**
     * @var SocialUserService
     */
    protected $socialUserService;

    public function index()
    {
        $this->socialUserService = $this->get(SocialUserService::class);
        $socialScores = $this->socialUserService->calculateUsersScores();

        return ['socialScores' => $socialScores];
    }

}