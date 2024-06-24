<?php

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->signOut();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="./../../../assets/js/nav.js" defer></script>

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
                    id="log_out_form" method="post">

                    <div class=" p-1 bg-white overflow-auto rounded-lg  m-auto">
                    <span class="text-red-800" id="error_user"></span>
                  
                    
                        <h1
                            class="mt-8 sm:text-xs md:text-base lg:text-lg xl:text-xl  2xl:text-2xl  m-auto capitalize  text-blue-500 font-bold">
                            se Deconnecter de votre espace utilisateur?</h1><br>

                        <button type="sumbit" class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 sm:w-3/5 md:w-2/5 hover:bg-blue-200 hover:text-blue-00 text-white font-bold
                             rounded-md text-center" name="signout" id="btn_signout">
                            Oui
                        </button>
                        <button class="bg-gray-500 sm:text-xs xl:text-xl p-1 h-10 sm:w-2/5 md:w-1/5 hover:bg-red-300 text-white font-bold
                            rounded-md text-center">
                            <a href="index.php">Non</a>
                        </button><br>
                       
                    </div>
                </form>
            </div>

        </div>

    </div>
    <?php require ("./../elements/footerLogin.php"); ?>>

</body>
</html>

