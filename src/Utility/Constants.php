<?php


namespace App\Utility;


class Constants
{

    /**
     * sendable_senderId_recipientId
     */
    const SENDABLE_CACHE_KEY = "sendable_%s_%s";

    /**
     * sendable_user_senderId
     */
    const SENDABLE_USER_CACHE_KEY = "sendable_user_%s";

    const ALL_GIFT_OBJECT = 'all_gift_object';

    const CALCULATED_USER_SCORES = 'calculated_user_score';

    const CACHE_TIMEOUT_ONE_DAY = 86400;

}