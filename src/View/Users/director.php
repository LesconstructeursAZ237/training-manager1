<?php session_start();
if (!isset($_SESSION['nom']) and !isset($_SESSION['prenom']) and !isset($_SESSION['mail']) and !isset($_SESSION['telephone']) and !isset($_SESSION['role_id'])) {

    header('Location: index.php');
}
$user1 = $_SESSION['nom'];
$user2 = $_SESSION['prenom'];
$user3 = $_SESSION['mail'];
$user4 = $_SESSION['telephone'];
$user5 = $_SESSION['role_id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Page director </title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<script src="./../../../assets/js/nav.js" defer></script>
</head>

<body>
    <!-- star header -->
    <nav class="fixed w-full z-10 top-0 start-0 mb-1 opac">

        <div class="p-4 flex justify-between flex-wrap">

            <span class="mt-8 text-justify">

                <h1>Bonjour, , <?php echo htmlspecialchars($user1) . ' ' . $user2 . ' ' . $user3 . ' ' . $user4; ?></h1>
            </span>
            <ul class="font-medium flex flex-row text-justify mt-8 justify-between overflow-x-auto ">

                <li class="  hover:bg-gray-200 rounded-lg  ">
                    <button> <a href="registration.php" class="text-sky-500 font-bold p-8">Ajouter un
                            utilisateur</a></button>
                </li>
                <li class="  hover:bg-gray-200 rounded-lg  ">
                    <button> <a href="obtainAllUser.php" class="text-sky-500 font-bold p-8" name="obtainAllUser">Voir
                            les utilisateurs</a></button>
                </li>

                <li class="  hover:bg-gray-200 rounded-lg  ">
                    <a href="signOut.php" class="text-sky-500 font-bold p-8">Deconnexion</a>
                </li>

            </ul>

            <button id="main_nav" class=" justify-between">

                <span class="text-sky-400 font-bold  hover:bg-gray-500 rounded-lg p-4">
                    MENU
                </span>

            </button>

            <div class="w-full hidden  overflow-x-auto" id="main_nav1">

                <ul class=" font-medium flex flex-row justify-between ">

                    <li class="  hover:bg-gray-500 rounded-lg p-4">
                        <a href="trainings.php" class="text-sky-500 font-bold  ">Formations</a>
                    </li>


                    <li class="  hover:bg-gray-500 rounded-lg p-4">
                        <a href="#" class="text-sky-500 font-bold">EVENEMENTS</a>
                    </li>

                    <li class="  hover:bg-gray-500 rounded-lg p-4">
                        <a href="#" class="text-sky-500 font-bold">ETUDIANTS</a>
                    </li>

                    <li class="  hover:bg-gray-500 rounded-lg p-4">
                        <a href="#" class="text-sky-500 font-bold">ENSEIGNANTS</a>
                    </li>

                    <li class="  hover:bg-gray-500 rounded-lg p-4">
                        <a href="#" class="text-sky-500 font-bold">autre</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <!-- Menu button for mobile -->
    <div class="lg:hidden p-4">
        <button id="menu-toggle" class="text-gray-500 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>
    <div id="sidebar" class="lg:block hidden fixed top-0 left-0 w-64 h-full bg-white shadow-md float">
        <div class="p-4 border-b">
            <h1 class="text-lg font-semibold">Menu</h1>
        </div>
        <nav class="p-4">
            <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 1</a>
            <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 2</a>
            <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 3</a>
            <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 4</a>
            <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 5</a>
        </nav>
    </div>





    <!-- end page -->
    <div class="p-5 content-stretch md:content-around grid gap-8 sm:grid-cols-1 sm:size-10/12
      md:grid-cols-2 md:size-11/12 xl:grid-cols-4 xl:size-full 2xl:grid-cols-4 ">


        <div class="overflow-auto p-1 bg-white rounded-md text-center">

            <img src="./../../../assets/img/logo2.jpg" class="w-32 h-32  object-cover rounded-md m-auto" alt=""> <br>
            <h4 class="text-gray-500">une équipe d'encadreurs qualifiés, expérimentés et disponibles.</h4> <br>
            <a href="#">
                <button class=" h-10 w-10 bg-gray-200 text-black font-bold hover:bg-red-300 rounded-full">
                    f
                </button>
            </a>
            <a href="#">
                <button class=" h-10 w-10 bg-gray-200 text-black font-bold hover:bg-red-300 rounded-full">
                    f
                </button>
            </a>
        </div>

        <div class="overflow-auto p-1 bg-white rounded-md text-center">

            <h4 class="font-bold underline uppercase">conditions d'admission</h4> <br>

            <a href="#">
                <button class="text-gray-500 capitalize  bg-white  hover:bg-red-300 rounded p-1">
                    criteres d'admission.
                </button>
            </a> <br>

            <a href="#">
                <button class="text-gray-500 capitalize  bg-white  hover:bg-red-300 rounded p-1">
                    a propos de nous.
                </button>
            </a> <br>

            <a href="#">
                <button class="text-gray-500 capitalize  bg-white  hover:bg-red-300 rounded p-1">
                    calendrier academic.
                </button>
            </a> <br>
        </div>



        <div class="overflow-auto p-1 bg-white  rounded-md text-center">

            <h4 class="font-bold underline uppercase">liens utiles</h4> <br>

            <a href="#">
                <button class="text-gray-500 capitalize  bg-white  hover:bg-red-300 rounded p-1">
                    nos formations.
                </button>
            </a> <br>

            <a href="#">
                <button class="text-gray-500 capitalize  bg-white  hover:bg-red-300 rounded p-1">
                    voir les évenements.
                </button>
            </a> <br>
        </div>

        <div class="overflow-auto p-1 bg-white rounded-md text-center">

            <h4 class="font-bold underline uppercase">trouvez nous au:</h4> <br>
            <h3 class="capitalize text-gray-500 ">Cameroun, region de l'ouest, ville de Dschang</h3> <br>
            <h3 class="capitalize text-gray-500 ">Dschang centre ville, derriere la quincaillerie sofotou,
                <br> 2eme étage immeuble Nomeny Marché A
            </h3> <br>
            <h3 class="capitalize text-gray-500 ">+237 679 637 622 /+237 697 870 683</h3> <br>
            <h3 class="capitalize text-gray-500 ">leaderinfo20323@gmail.com</h3>
        </div>

    </div>
    <!-- flooter start -->
    <div class="w-full h-16 bg-gray-600 text-center p-4 shadow-2xl">
        <h1 class="text-gray-300">Copyright © <span class="text-white">fabrice nkeumo</span> 2024. All Right Reserved By
            <a href="#"><span class="text-white underline hover:bg-gray-400 p-2 rounded ">fabrice nkeumo.</span></a>
        </h1>
    </div>
    <!-- flloter end -->
    <!-- end page -->
    <script>
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
</script>
</body>

</html>