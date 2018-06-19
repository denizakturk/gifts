<?php


namespace App\Controller;


use App\Repository\GiftSentRepository;
use App\Service\SocialUserService;
use Gifts\HttpFoundation\Request;

class MemberController extends Controller
{

    /**
     * @var SocialUserService
     */
    protected $socialUserService;

    /**
     * @var GiftSentRepository
     */
    protected $giftSentRepository;

    public function index()
    {
        $this->socialUserService = $this->get(SocialUserService::class);
        $socialScores = $this->socialUserService->calculateUsersScores();

        return ['socialScores' => $socialScores];
    }

    public function giftbox()
    {
        $this->giftSentRepository = $this->get(GiftSentRepository::class);

        $unapprovedGifts = $this->giftSentRepository->getUnapprovedGifts($this->getUser());

        return ['unapprovedGifts' => $unapprovedGifts];
    }

    public function giftApproved()
    {
        /** @var Request $request */
        $request = $this->get(Request::class);
        $this->giftSentRepository = $this->get(GiftSentRepository::class);

        if ($request->request->get('approved')) {
            $result = $this->giftSentRepository->giftApprove(
                $this->getUser(),
                $request->request->get('approve_id')
            );
        } else {
            $result = $this->giftSentRepository->giftUnapprove(
                $this->getUser(),
                $request->request->get('approve_id')
            );
        }

        return ['status' => $result];
    }

}