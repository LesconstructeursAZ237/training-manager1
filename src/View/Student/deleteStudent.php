<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\RegistrationController;

(new RegistrationController())->delete();


?>