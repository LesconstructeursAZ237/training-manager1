<?php
//variable de session pour retour de message
session_start(); // debut
$message = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}// fin


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->registration();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="./../../../assets/js/nav.js" defer></script>
    <style>
        .error {
            border: 2px solid red;
        }
    </style>
</head>

<body class="">


    <!-- formulaire d'inscription d'utilisateur -->

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

            <div class="absolute inset-0 flex mt-8 mb-8 sm:text-xs text-center m-auto shadow-xl rounded-lg sm:w-10/12   md:w-96 lg:w-1/2 xl:w-1/2 lg:text-xl md:text-lg 
                2xl:bg-red-200 overflow-hidden border border-gray-800">

                <form action="" class=" m-auto  xl:w-full 2xl:w-full " id="registrationForm" method="post">

                    <div class=" p-1 bg-white overflow-auto rounded-lg  m-auto text-base">
                        <?php if ($message): ?>
                            <p
                                class="mt-8 sm:text-xs md:text-base lg:text-lg xl:text-xl  2xl:text-2xl  m-auto capitalize  text-blue-500 font-bold ">
                                <?php echo htmlspecialchars($message); ?>
                            </p>
                        <?php endif; ?>
                        <h1
                            class="mt-8 sm:text-xs md:text-base lg:text-lg xl:text-xl  2xl:text-2xl  m-auto capitalize  text-blue-500 font-bold">
                            formulaire d'ajout d'utilisateur
                        </h1>

                        <div class="bg-gray-100 grid grid-cols-2 gap-3 overflow-auto ">
                            <div class="w-full ">
                                <label for="" class="text-black font-bold ">Nom: <br>
                                    <input required type="text" placeholder="Votre nom ici" id="name" name="name"
                                        class="font-normal rounded-md text-center  sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full placeholder-gray-400 border border-gray-400">
                                </label> <br>

                                <label for="" class="text-black font-bold ">Adresse Email: <br>
                                    <input required type="email" placeholder="Votre adresse email ici" id="mail"
                                        name="mail"
                                        class="font-normal rounded-md text-center  sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full placeholder-gray-400 border border-gray-400">
                                </label> <br>

                                <label for="" class="text-black font-bold ">Date de Naissance: <br>
                                    <input required type="date" placeholder="" id="bith_date" name="birth_date"
                                        class="font-normal rounded-md text-center  sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full placeholder-gray-400 border border-gray-400">
                                </label> <br><br>

                            </div>

                            <div class="w-full ">
                                <label for="" class="text-black font-bold ">Prenom: <br>
                                    <input required type="text" placeholder="first Name" id="firstName" name="firstName"
                                        class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full  placeholder-gray-400 border border-gray-400">
                                </label> <br>
                                <label for="" class="text-black font-bold ">Numero de télephone: <br>
                                    <input required type="number" placeholder="690 487 232" id="phone_number"
                                        name="phone_number"
                                        class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full  placeholder-gray-400 border border-gray-400">
                                </label> <br>

                                <label for="" class="text-black font-bold ">Photo: <br>
                                    <input required type="file" placeholder="" id="photo_user" name="photo_user"
                                        class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10  w-full  placeholder-gray-400 border border-gray-400">
                                </label> <br><br>


                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 overflow-auto ">
                            <div class="w-full">

                                <button type="sumbit" class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 w-2/3  hover:bg-blue-200 hover:text-blue-00 text-white font-bold
                                    rounded-md text-center" name="registration" id="btn_login">
                                    Ajouter
                                </button>


                            </div>
                            <div class="w-full">
                                <button class="bg-gray-500 sm:text-xs xl:text-xl p-1 h-10 w-2/3 hover:bg-red-300 text-white font-bold
                                    rounded-md text-center">
                                    <a href="./index.php">Retour</a>
                                </button><br>
                            </div>

                        </div>


                    </div>
                </form>
            </div>

        </div>

    </div>
    <?php require ("./../Elements/footerLogin.php"); ?>


</body>

</html>