<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Repository\GiftSentRepository;
use Gifts\DependencyInjection\Container;
use Gifts\HttpFoundation\Request;

class CleanController extends Controller
{

    /**
     * @var GiftSentRepository
     */
    protected $giftSentRepository;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        /** @var Request $request */
        $request = $this->get(Request::class);
        if (!in_array($request->server->get('REMOTE_ADDR'), ['192.168.20.100', '127.0.0.1'])) {
            echo $request->server->get('REMOTE_ADDR');
            throw new \Exception('Bad Request');
        }
    }

    public function expireGifts()
    {
        $this->giftSentRepository = $this->get(GiftSentRepository::class);
        $status = $this->giftSentRepository->expiredGifts(new \DateTime('-1 Week'));

        return ['status' => $status];
    }

}