<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],

        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'dbrecruitmentTEST',
            'username' => 'root',
            'password' => '?!dbtscservices1967!(^&',
            'charser' => 'utf8',
            'collation' => 'utf8_encode_ci',
            'prefix' => '',
        ],
    ],
];
