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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Navigation Menu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
            <!-- Logo -->
            <div class="absolute inset-0 z-0">
                <img src="./../../../assets/img/logo1.png" alt="Logo" class="ml-0 p-0 h-1/12 w-1/12 object-contain">
            </div>
  
<nav class="bg-blue-900 opacity-90 p-0 h-2/12">
     
    <div class="container mx-auto flex items-center justify-between ">
        
              <!-- Navigation Links -->
        <div class="hidden md:flex space-x-4 items-center">
            <button class="text-white hover:bg-blue-400 p-2 rounded"><i class="fas fa-user"></i>Utilisateurs</button>
            <button class="text-white hover:bg-blue-400 p-2 rounded"><i class="fas fa-graduation-cap"></i>Formations</button>
            <button class="text-white hover:bg-blue-400 p-2 rounded"><i class="fas fa-calendar-alt"></i>Évènements</button>
            <button class="text-white hover:bg-blue-400 p-2 rounded" ><i class="fas fa-graduation-cap"></i>Niveau</button>
            <button class="text-white hover:bg-blue-400 p-2 rounded"><i class="fas fa-user-graduate"></i>Étudiants</button>
            <button class="text-white hover:bg-blue-400 p-2 rounded"><i class="fas fa-home"></i>Accueil</button>
        </div>


        <!-- Search Bar -->
        <div class=" m-2 rounded-lg w-full max-w-md flex items-center justify-center h-full">
            <form action="" method="post" class="w-full flex">
                <input type="text" id="search" name="search" placeholder="Entrez votre recherche"
                    class="w-full px-4 py-2 h-full border rounded-l-lg">
                <button type="submit"
                    class="bg-blue-800 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Profile Button -->
        <div class="flex items-center space-x-4">
            <button class="text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500"><i class="fas fa-user-cog"></i>Profil</button>
            <button id="btnOpenVerticalMenu" onclick="openVerticalMenu()" class="lg:hidden text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500">Menu</button>
        </div>
    </div>

  
</nav>

    
<div class="flex flex-col md:flex-row h-full ">
    <!-- Menu vertical à gauche -->
    <div id="verticalMenu" class="hidden md:block  sm:w-1/3 md:w-1/5 hidden bg-blue-900 opacity-90 text-white p-4 overflow-auto top-2/12">
        <ul>
            <a href="Aindex.php" > <h1 class="bg-blue-600 w-full rounded underline p-1 m-0 hover:bg-blue-800 "> <i class="fas fa-home"></i>Accueil</h1></a>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-calendar-alt"></i>Évenements</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-graduation-cap"></i>Formations</a></li>
           
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-user"></i>Utilisateurs</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Utilisateurs</a></li>
            
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Formation</h1>
            <li><a href="./../Trainings/addTrainings.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>ajouter</a></li>
            <li><a href="./../Trainings/getTrainings.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les formations</a></li>
            
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-graduation-cap"></i>Niveau</h1>
            <li><a href="./../Level/addLevels.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>ajouter</a></li>
            <li><a href="./../Level/getLevels.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Niveaux</a></li>         
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-calendar-alt"></i>Évenements</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Évenements</a></li>         
        </ul>
    </div>

    <!-- Contenu personnalisé -->
    <div class="flex-1 bg-gray-200 p-4">
        



    
    <!-- add an User -->
     <!-- form -->
    <div id="formAddUser" class="absolute inset-10 flex sm:text-xs text-center m-auto rounded-lg sm:w-10/12 md:w-96 lg:w-1/2 xl:w-1/2 lg:text-xl md:text-lg 2xl:bg-red-200 overflow-auto ">
    <form action="addUser.php" class="m-auto xl:w-full 2xl:w-full" id="registrationForm" method="post">
    <div class=" bg-white text-white overflow-auto rounded-lg m-auto text-base">
        <h1 class="text-black p-2 sm:text-xs md:text-base lg:text-lg xl:text-xl 2xl:text-2xl m-auto capitalize font-bold">
            Formulaire d'ajout d'utilisateur
        </h1>
        <div class="grid bg-white grid-cols-1 md:grid-cols-2 gap-3 overflow-auto p-4">
            <div class="w-full">
                <label for="name" class="text-black font-bold">Nom: <br>
                    <input required type="text" placeholder="Votre nom ici" id="name" name="name"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="nameError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="firstName" class="text-black font-bold">Prenom: <br>
                    <input required type="text" placeholder="First Name" id="firstName" name="firstName"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="firstNameError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="mail" class="text-black font-bold">Adresse Email: <br>
                    <input required type="email" placeholder="Votre adresse email ici" id="mail" name="mail"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="mailError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="phone_number" class="text-black font-bold">Numéro de téléphone (9chiffres): <br>
                    <input required type="number" placeholder="690 487 232" id="phone_number" name="phone_number"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="phoneNumberError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="birth_date" class="text-black font-bold">Date de Naissance: <br>
                    <input required type="date" id="birth_date" name="birth_date"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="birthDateError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="photo_user" class="text-black font-bold">Photo: <br>
                    <input required type="file" id="photo_user" name="photo_user"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="photoUserError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full md:col-span-2">
                <label for="address" class="text-black font-bold">Mot de passe: <br>
                    <input required type="password" placeholder="Votre mot de passe ici" id="pwdUser" name="pwdUser"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="pwdUserError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full md:col-span-2">
                <?php if (isset($_SESSION['ArrayAuth'])): ?>
                    <input required type="hidden" id="modified" name="modified"
                        value="<?php echo $_SESSION['ArrayAuth'][1]; ?>"
                        class="">
                <?php endif; ?>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 overflow-auto p-4">
            <div class="w-full">
                <button type="submit"
                    class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 w-2/3 hover:bg-blue-200 hover:text-blue-00 text-white font-bold rounded-md text-center"
                    name="registration" id=""><i class="fas fa-plus"></i>
                    Ajouter
                </button>
            </div>
            <div class="w-full">
                <button 
                    class="bg-gray-400 sm:text-xs xl:text-xl p-1 h-10 w-2/3 hover:bg-gray-500 text-white font-bold rounded-md text-center">
                    <a href="./directorHead.php">Retour<i class="fas fa-arrow-right"></i></a>
                </button>
            </div>
        </div>
    </div>
</form>
    </div>

    <!-- fin Contenu personnalisé -->
    </div>
</div>


    <script src="./../../../assets/js/DirectorHead.js"></script>
    <script src="./../../../assets/js/controlFormaddUser.js" defer></script>


   
</body>
</html>
