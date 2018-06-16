<?php

return [
    'member' => [
        "/" => [ 'controller' => \App\Controller\DefaultController::class, 'action' => 'index', 'method' => 'GET'],
        "/gift/{id}/show/" => [ 'controller' => \App\Controller\DefaultController::class, 'action' => 'showGifts', 'method' => 'GET']
    ]
];