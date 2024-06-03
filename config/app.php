<?php

/**
 * PHP Skeleton app
 * Minimum structure for native PHP web apps development
 * 
 * @copyright Copyright (c) Silevester D. (https://github.com/SilverD3)
 * @link      https://github.com/devacademia/php-skeleton-ap PHP Skeleton App
 * @since     v1.0 (2024)
 */

/**
 * This is the app configuration array
 * You can define your custom configuration and access them later 
 * from \Core\
 */
return [
    'DataSource' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'silevester',
        'database' => 'leave_manager',
    ],

    'Session' => [
        'timeout' => 60 * 60 * 24 * 2 // 2 days
    ]
];
