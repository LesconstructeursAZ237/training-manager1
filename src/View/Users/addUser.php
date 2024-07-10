<?php session_start();

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->addUser();

/**
 * @var array<\App\Entity\User> $users
 * @var array<\App\Controller\UsersController> $auth_user 
 * @var array<\App\Service\UsersServices>  $auth  
 */
?>
