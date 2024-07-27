<?php session_start(); 


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;
(new UsersController())->signin();

$error_message = isset($_SESSION['not_f_user']) ? $_SESSION['not_f_user'] : '';
//print_r($error_message); die();
unset($_SESSION['not_f_user']);

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./../../../assets/css/signin.css">

    <script src="./../../../assets/js/nav.js" defer></script>
    <script src="./../../../assets/js/login.js" defer></script>
    <script src="./../../../assets/js/input.js" defer></script>
    <style>
        .error {
            border: 2px solid red;
        }
    </style>
</head>

<body class="">

    <!-- formulaire de connexion au compte d'utilisateur -->


    <div class=" flex float-none items-center justify-center h-screen col-start-2 col-span-4 overflow-hidden">

        <div id="slider" class=" bg-white p-4 relative">
            
             <!-- image d'arriere plan -->
            
             

            <img src=" ./../../../assets/img/equipefootball2.jpg" alt="Image 1"
                class="w-full h-full object-contain hidden">

            <img src=" ./../../../assets/img/equipefootball2.jpg" alt="Image 1"
                class="w-full h-full object-contain hidden">

            <img src="./../../../assets/img/aceuil3.jpg" alt="Image 1" class="w-full h-full object-contain hidden">

            <img src="./../../../assets/img/acceuil4.jpg" alt="Image 1" class="w-full h-full object-contain hidden">

            <button id="prev"
                class="absolute rounded-lg  left-4 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2  hover:bg-sky-400">Previous</button>
            <button id="next"
                class=" absolute rounded-lg  right-4 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2  hover:bg-sky-400">Next</button>

            <div class="absolute inset-0 flex mt-8 mb-8 sm:text-xs text-center m-auto shadow-xl rounded-lg sm:w-10/12   md:w-96 lg:w-96  xl:w-96 lg:text-xl md:text-lg 
                2xl:bg-red-200 overflow-hidden border border-gray-800">

                <form action="" class=" m-auto  xl:w-96 2xl:w-96 "
                    id="log_in_form" method="post">
                        
                    <div class=" p-1 bg-white overflow-auto rounded-lg  m-auto">
                        <!-- balise du message d'erreur -->
                    <span class="text-red-800" id="error_user"></span>
                                     
                        <h1
                            class="mt-8 sm:text-xs md:text-base lg:text-lg xl:text-xl  2xl:text-2xl  m-auto capitalize  text-blue-500 font-bold">
                            formulaire de connexion au compte</h1><br>

                        <label for="" class="text-black font-bold ">Adresse Email: <br>
                            <input required type="email" placeholder="Votre Adresse Email ici" id="mail" name="mail"
                                class="font-normal rounded-md text-center  sm:h-5 xl:h-10 lg:h-10 md:h-10  w-3/5  placeholder-gray-400 border border-gray-400">
                        </label> <br><br>

                        <label for="" class="text-black font-bold ">Mot de passe: <br>
                            <input required type="password" placeholder="Votre mot de passe ici" id="password"
                                name="password"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 sm:text-xs xl:text-xl w-3/5  placeholder-gray-400 border border-gray-400">
                        </label> <br><br>
                        <button type="sumbit" class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 sm:w-3/5 md:w-2/5 hover:bg-blue-200 hover:text-blue-00 text-white font-bold
                             rounded-md text-center" name="signin" id="btn_login">
                            Se Connecter
                        </button>
                        <button class="bg-gray-500 sm:text-xs xl:text-xl p-1 h-10 sm:w-2/5 md:w-1/5 hover:bg-red-300 text-white font-bold
                            rounded-md text-center">
                            <a href="Aindex.php">Anuler</a>
                        </button><br>
                        <a href="" class="underline text-base hover:bg-blue-300 rounded-sm"> mot de passe oublier?</a>

                    </div>
                </form>
            </div>

        </div>

    </div>
    <?php require ("./../elements/footerLogin.php"); ?>>

</body>
</html>

    <script>
    // metre le message d'erreur dans une variable js
    var errorMessage = "<?php if(isset($error_message)){
    echo $error_message; } ?>";
    if (errorMessage) {
        // Utiliser JavaScript pour écrire dans la balise avec l'ID "error_user"
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('error_user').innerText = errorMessage;
            document.getElementById('mail').style.borderColor = 'red';
            document.getElementById('mail').style.borderWidth = '2px';
         

        });

    }
    </script>



