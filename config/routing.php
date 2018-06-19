<?php

return [
    /*
    Example route
    'example' => [
            'example_route' => [
                'uri' => '/example',
                'controller' => \App\Controller\ExampleController::class,
                'action' => 'example',
                'method' => 'POST',
                'loginRequired' => false,
                'view' => 'example/example',
                'viewTemplate' => 'example',
            ],
        ],
    */
    'gift' => [
        'gift_index' => [
            'uri' => '/gift',
            'controller' => \App\Controller\GiftController::class,
            'action' => 'index',
            'method' => ['GET'],
        ],

        'gift_send' => [
            'uri' => '/gift/send',
            'controller' => \App\Controller\GiftController::class,
            'action' => 'send',
            'method' => ['POST'],
            'view' => false,
        ],
    ],
    'member' => [
        'member_index' => [
            'uri' => '/member',
            'controller' => \App\Controller\MemberController::class,
            'action' => 'index',
            'method' => ['GET'],
        ],
        'member_giftbox' => [
            'uri' => '/member/giftbox',
            'controller' => \App\Controller\MemberController::class,
            'action' => 'giftbox',
            'method' => ['GET'],
        ],
        'member_giftapproved' => [
            'uri' => '/member/gift/approved',
            'controller' => \App\Controller\MemberController::class,
            'action' => 'giftApproved',
            'method' => ['POST'],
            'view' => false,
        ],
    ],
    'general' => [
        'home' => [
            'uri' => '/',
            'controller' => \App\Controller\MemberController::class,
            'action' => 'index',
        ],
    ],
    'security' => [
        'loginForm' => [
            'uri' => '/security/login',
            'controller' => \App\Controller\SecurityController::class,
            'action' => 'loginForm',
            'method' => ['GET'],
            'loginRequired' => false,
        ],
        'login' => [
            'uri' => '/security/login_action',
            'controller' => \App\Controller\SecurityController::class,
            'action' => 'login',
            'method' => ['POST'],
            'loginRequired' => false,
        ],
        'logout' => [
            'uri' => '/security/logout',
            'controller' => \App\Controller\SecurityController::class,
            'action' => 'logout',
            'method' => ['GET'],
            'loginRequired' => false,
        ],
    ],
    'api' => [
        'gift_expire' => [
            'uri' => '/api/expire-gifts',
            'controller' => \App\Controller\Api\CleanController::class,
            'action' => 'expireGifts',
            'method' => ['GET'],
            'loginRequired' => false,
        ],
    ],
];