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

// Assets files
if (!defined('VIEWS')) {
    define('VIEWS', BASE_URL . APP_DIR . '/View/');
}

if (!defined('ASSETS')) {
    define('ASSETS', BASE_URL . 'assets/');
}

if (!defined('UPLOADS')) {
    define('UPLOADS', BASE_URL . 'public/uploads/');
}

if (!defined('INTERNSHIP_REPORTS_DIR_NAME')) {
    define('INTERNSHIP_REPORTS_DIR_NAME', 'internship-reports');
}

if (!defined('INTERNSHIP_DOCUMENTS_DIR_NAME')) {
    define('INTERNSHIP_DOCUMENTS_DIR_NAME', 'internship-documents');
}

if (!defined('UPLOADS_PATH')) {
    define('UPLOADS_PATH', ROOT . DS . 'public' . DS . 'uploads' . DS);
}

if (!defined('IMAGES')) {
    define('IMAGES', ASSETS . 'images' . DS);
}

if (!defined('VENDOR')) {
    define('VENDOR', BASE_URL . 'vendor' . DS);
}

if (!defined('PAGINATOR_KEY')) {
    define('PAGINATOR_KEY', "__paginator__");
}
