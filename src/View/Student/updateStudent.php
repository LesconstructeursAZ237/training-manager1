<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\RegistrationController;
use App\Entity\Level;

(new RegistrationController())->updateStudent();


?>