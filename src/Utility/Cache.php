<?php


namespace App\Utility;


class Cache
{

    protected static $init = false;

    /**
     * @var \Redis
     *
     */
    protected static $redis;

    protected static function init()
    {
        self::$redis = new \Redis();
        self::$redis->connect('127.0.0.1', 6379);
        self::$init = true;
    }

    public static function set($key, $value, $timeout = 3600)
    {
        if (!self::$init) {
            self::init();
        }

        self::$redis->set($key, serialize($value), $timeout);
    }

    public static function get($key)
    {
        if (!self::$init) {
            self::init();
        }

        return self::$redis->get(unserialize($key));
    }

}