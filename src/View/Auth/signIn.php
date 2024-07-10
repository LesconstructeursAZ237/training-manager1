<?php

/**
 * Leave manager : Simple app for contract and leave management.
 *
 * @copyright Copyright (c) Silevester D. (https://github.com/SilverD3)
 * @link      https://github.com/SilverD3/leave-manager Leave Manager Project
 * @since     1.0 (2022)
 */

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\View\Helpers\TitleHelper;
use App\Controller\AuthController;
use Core\FlashMessages\Flash;

(new AuthController())->signIn();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= (new TitleHelper())->getTitle(); ?></title>
	<meta content="Simple Leave Manager Application" name="description">
	<meta content="Leaves, Manager, Contracts" name="keywords">

	<!-- Favicons -->
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./../../../assets/css/signin.css">
	<!-- js files -->
	<script src="./../../../assets/js/login.js" defer></script>
</head>

<body>

	<!-- form signIn -->
	<div class="absolute inset-0 flex mt-8 mb-8 sm:text-xs text-center m-auto shadow-xl rounded-lg sm:w-10/12   md:w-96 lg:w-96  xl:w-96 lg:text-xl md:text-lg 
				bg-red-200 overflow-auto  border-gray-500">

		<form action="" class=" m-auto  xl:w-96 2xl:w-96 " id="log_in_form" method="post">

			<div class=" p-1  overflow-auto rounded-lg  m-auto">
				<!-- balise du message d'erreur -->

				<span class="text-red-500" id=""><?= Flash::render() ?></span>
				<span class="text-red-800" id="error_user"></span>

				<h1
					class="mt-8 sm:text-xs md:text-base lg:text-lg xl:text-xl  2xl:text-2xl  m-auto capitalize  text-blue-500 font-bold">
					formulaire de connexion au compte</h1><br>

				<label for="" class="text-black font-bold ">Adresse Email: <br>
					<input required type="email" placeholder="Votre Adresse Email ici" id="mail" name="mail"
						class="font-normal rounded-md text-center  sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full  placeholder-gray-400 border border-gray-400">
				</label> <br><br>

				<label for="" class="text-black font-bold ">Mot de passe: <br>
					<input required type="password" placeholder="Votre mot de passe ici" id="password" name="password"
						class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 sm:text-xs xl:text-xl w-full  placeholder-gray-400 border border-gray-400">
						<span id="passwordIncorect" class="text-sm text-red-500"></span>
				</label> <br><br>
				<button type="sumbit" class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 sm:w-3/5 md:w-2/5 hover:bg-blue-200 hover:text-blue-00 text-white font-bold
							 rounded-md text-center" name="btnSignIn" id="btn_login">
					Se Connecter
				</button>
				<button class="bg-gray-500 sm:text-xs xl:text-xl p-1 h-10 sm:w-2/5 md:w-1/5 hover:bg-red-300 text-white font-bold
							rounded-md text-center">
					<a href="index.php">Anuler</a>
				</button><br>
				<a href="" class="underline text-base hover:bg-blue-300 rounded-sm"> mot de passe oublier?</a>

			</div>
		</form>
	</div>


</body>

</html>