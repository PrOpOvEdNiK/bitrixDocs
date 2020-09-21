<?php

return array(
    'routes' => array(
        'index-index'               => array(
            'route'    => '/index/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'index'
            )
        ),
        'exchange-import'               => array(
            'route'    => '/exchange/import/',
            'defaults' => array(
                'controller' => 'exchange',
                'action'     => 'import'
            )
        ),
        'exchange-history'               => array(
            'route'    => '/exchange/history/',
            'defaults' => array(
                'controller' => 'exchange',
                'action'     => 'history'
            )
        ),
        'section-list'               => array(
            'route'    => '/crypt/section/list/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'section-list'
            ),
        ),
        'section-save'               => array(
            'route'    => '/crypt/section/save/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'section-save'
            ),
        ),
        'section-move'               => array(
            'route'    => '/crypt/section/move/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'section-move'
            ),
        ),
        'section-remove'               => array(
            'route'    => '/crypt/section/remove/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'section-remove'
            ),
        ),
        'password-list'               => array(
            'route'    => '/crypt/password/list/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'password-list'
            ),
        ),
        'password-for-id'               => array(
            'route'    => '/crypt/password/list-for-id/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'password-list-for-id'
            ),
        ),
        'password-save'               => array(
            'route'    => '/crypt/password/save/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'password-save'
            ),
        ),
        'password-move'               => array(
            'route'    => '/crypt/password/move/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'password-move'
            ),
        ),
        'password-remove'               => array(
            'route'    => '/crypt/password/remove/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'password-remove'
            ),
        ),
        'rights-list'               => array(
            'route'    => '/crypt/rights/list/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'rights-list'
            ),
        ),
        'rights-save'               => array(
            'route'    => '/crypt/rights/save/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'rights-save'
            ),
        ),
        'rights-remove'               => array(
            'route'    => '/crypt/rights/remove/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'rights-remove'
            ),
        ),
        'set-owner'               => array(
            'route'    => '/crypt/set-owner/',
            'defaults' => array(
                'controller' => 'crypt',
                'action'     => 'set-owner'
            ),
        ),
        'api-favicon' => array(
            'route'    => '/api/favicon/',
            'defaults' => array(
                'controller' => 'api',
                'action'     => 'favicon'
            ),
        ),
        'api-request-access' => array(
            'route'    => '/api/request-access/',
            'defaults' => array(
                'controller' => 'api',
                'action'     => 'request-access'
            ),
        ),
    ),
);
