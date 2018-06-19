<?php


namespace App\Controller;


use App\Repository\GiftRepository;
use App\Repository\GiftSentRepository;
use App\Repository\UserRepository;
use Gifts\HttpFoundation\Request;

class GiftController extends Controller
{

    /**
     * @var GiftRepository
     */
    protected $giftRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var GiftSentRepository
     */
    protected $giftSentRepository;

    /**
     * @var Request
     */
    protected $request;

    public function index()
    {
        $this->giftRepository = $this->get(GiftRepository::class);
        $this->userRepository = $this->get(UserRepository::class);

        $gifts = $this->giftRepository->getAll();

        $giftSendableUsers = $this->userRepository->getGiftSendableUser($this->getUser()->getId());

        return ['gifts' => $gifts, 'giftSendableUsers' => $giftSendableUsers];
    }

    public function send()
    {
        $this->request = $this->get(Request::class);
        $this->giftSentRepository = $this->get(GiftSentRepository::class);
        $this->giftRepository = $this->get(GiftRepository::class);
        $this->userRepository = $this->get(UserRepository::class);
        $sender = $this->getUser();
        $recipient = $this->userRepository->find($this->request->request->get('user'));
        $gift = $this->giftRepository->find($this->request->request->get('gift'));

        if ($this->giftSentRepository->isSendable($sender, $recipient)) {
            return ['status' => (boolean)$this->giftSentRepository->send($sender, $recipient, $gift)];
        }

        return ['status' => false];
    }

}