<?php


// These directives override the PHP default config
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Import autoload.php
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * Redirect to the main view of your app
 */
require_once APP_DIR . DS . 'View' . DS . 'Users' . DS . 'Aindex.php';
