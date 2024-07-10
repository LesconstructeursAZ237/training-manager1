<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";


if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}

define('ROOT', dirname(__DIR__));

define('APP_DIR', 'src');

define('APP', ROOT . DS . APP_DIR . DS);

define('CONFIG', ROOT . DS . 'config' . DS);

define('CORE_PATH', ROOT . DS . 'Core' . DS);

define('IMG_PATH', ROOT . DS . 'Core' . DS.'Classes'. DS);
define('ASSETS', ROOT . DS . 'assets' . DS);
define('ADD_IMG_PATH','./../../../assets/img/');

define('MODEL_PATH', APP . 'Entity' . DS);

define('CONTROLLER_PATH', APP . 'Controller' . DS);

define('VIEW_PATH', APP . 'View' . DS);

define('SERVICE_PATH', APP . 'Service' . DS);
if (!defined('BASE_URL')) {
    define('BASE_URL', getFullDomainUrl().'training-manager'.VIEW_PATH.'Users/dashboard.php');
}
