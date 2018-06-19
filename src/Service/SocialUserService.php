<?php


namespace App\Service;


use App\Repository\GiftSentRepository;
use App\Utility\Cache;
use App\Utility\Constants;
use Gifts\DependencyInjection\Container;

class SocialUserService extends Service
{

    /**
     * @var GiftSentRepository
     */
    protected $giftSentRepository;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    public function calculateUsersScores()
    {
        $cacheKey = Constants::CALCULATED_USER_SCORES;

        $userGifts = Cache::get($cacheKey);

        if (empty($userGifts)) {

            $this->giftSentRepository = $this->get(GiftSentRepository::class);
            $now = new \DateTime();
            $weekDay = (new \DateTime())->format('w') - 1;
            $now->modify("-{$weekDay} Day");
            $weekStart = new \DateTime($now->format('Y-m-d H:i:s'));
            $weekEnd = $now->modify('+6 Day');

            $sentGifts = $this->giftSentRepository->getSentByApproved($weekStart, $weekEnd);
            $userGifts = [];

            foreach ($sentGifts as $gift) {
                if (!isset($userGifts[$gift['recipientName']])) {
                    $userGifts[$gift['recipientName']] = 1 * 100;
                } else {
                    $userGifts[$gift['recipientName']] += (1 * 100);
                }
            }

            arsort($userGifts);

            Cache::set($cacheKey, $userGifts);
        }

        return $userGifts;
    }
}