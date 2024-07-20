<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\TrainingsController;

(new TrainingsController())->addTraining();

/**
 * @var string<\App\Controller\UsersController> $auth_user 
 * @var array<\App\Entity\Level> $levels
 * @var string<\App\Controller\TrainingsController> $flasMessage  

 */
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une formation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../../../assets/css/animationFormTrainings.css">
   

<body class="bg-gray-100">
    
            <!-- Logo -->
            <div class="absolute inset-0 z-0">
                <img src="./../../../../assets/img/logo1.png" alt="Logo" class="ml-0 p-0 h-1/12 w-1/12 object-contain">
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
                    class="bg-blue-800 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none">Search</button>
            </form>
        </div>

        <!-- Profile Button -->
        <div class="flex items-center space-x-4">
            <button class="text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500">Profil</button>
            <button id="btnOpenVerticalMenu" onclick="openVerticalMenu()" class="lg:hidden text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500"><i class="fas fa-align-justify"></i>Menu</button>
        </div>
    </div>

  
</nav>

    
<div class="flex flex-col md:flex-row h-full ">
    <!-- Menu vertical à gauche -->
    <div id="verticalMenu" class="hidden md:block  sm:w-1/3 md:w-1/5 hidden bg-blue-900 opacity-90 text-white p-4 overflow-auto top-2/12">
        <ul>
            <a href="./../Users/Aindex.php" > <h1 class="bg-blue-600 w-full rounded underline p-1 m-0 hover:bg-blue-800 "> Accueil</h1></a>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">Évenements</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">Formations</a></li>
           
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Utilisateurs</h1>
            <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-user-plus"></i>ajouter</a></li>
            <li><a href="./../Users/directorHead.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-user"></i>voir les Utilisateurs</a></li>
            
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Formation</h1>
            <li><a href="getTrainings.php" class="block p-2 hover:bg-blue-800 rounded">voir les formations</a></li>
            
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Niveau</h1>
            <li><a href="./../Level/addLevels.php" class="block p-2 hover:bg-blue-800 rounded">ajouter</a></li>
            <li><a href="./../Level/getLevels.php" class="block p-2 hover:bg-blue-800 rounded">voir les Niveaux</a></li>         
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Évenements</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">voir les Évenements</a></li>         
        </ul>
    </div>

    <!-- Contenu personnalisé -->
    <div class="flex-1 bg-gray-200 p-4">

    <div class="flex-1">    
    <div flex-1>
    <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
            <span id="flashConnxion"
                class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] ?> <span class="text-sm">, vous etes connecter!</span></span>
        <?php } ?>
    </div>
    <!-- form add training -->
    <div class="flex-1 bg-white p-8 rounded-lg shadow-md w-full max-w-md relative z-10 p-4" id="formTrainingsAdd">
        <!-- pour le message de la requete en cas d'erreur -->
        <span id="flashMessage" class="mt-4 flex items-center justify-center text-red-500"><?php
        if (isset($flashMessage)) {
            echo ($flashMessage);
        }
        if (isset($_SESSION['flashMessage'])) {
            unset($_SESSION['flashMessage']);
        }
        ?></span>
          

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Formulaire d'ajout de formation</h2>
        
        <form id="TrainingsAdd"  method="POST" >
            <div  class="grid grid-cols-1 md:grid-cols-2 gap-3 overflow-auto p-4">
                <div class="w-full">
                    <!-- modifid value -->
                    <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) {?>
                        <input type="text" placeholder="modified" id="modified" name="modified" value="<?=$_SESSION['ArrayAuth'][2]?>"
                            class=" hidden font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
        <?php }?>
                    
                           
                     <label for="codes" class="text-black">Code: <br>
                        <input type="text" placeholder="Code de la formation" id="codes" name="codes"
                            class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                            <span id="codesError" class="text-red-500"></span>
                        </label>
                </div>
                <div class="w-full">
                    <label for="descriptions" class="text-black">Description: <br>
                        <input type="text" placeholder="Description de la formation" id="descriptions"
                            name="descriptions"
                            class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                            <span id="descriptionsError" class="text-red-500"></span>
                        </label>
                </div>
                <div class="w-full">
                    <label for="price" class="text-black">Prix: <br>
                        <input type="number" placeholder="Prix de la formation" id="prices" name="prices"
                            class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                            <span id="pricesError" class="text-red-500"></span>
                        </label>
                </div>
                <div class="w-full">
                    <label for="durations" class="text-black">Durée: <br>
                        <input type="number" placeholder="Durée de la formation" id="durations" name="durations"
                            class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                            <span id="durationsError" class="text-red-500"></span>
                        </label>
                </div>
            </div>
            <div id="error-message" class="text-red-500 mt-2"></div>
            <label class="text-black">Choisir le(s) niveau(x) d'étude pour cette formation:</label>
            <div class="flex justify-center items-cente">
                <button type="button" onclick="viewLevel()" id="viewlevel"
                    class="w-1/3 justify-between  bg-blue-400 text-white p-1 rounded-md hover:bg-blue-600">
                    Voir les niveaux</button>
            </div> <br>
            <div id="viewLevels" class="grid grid-cols-1 md:grid-cols-2 gap-3 overflow-auto p-4 hidden">
                <?php if (isset($levels) && is_array($levels)) {
                    foreach ($levels as $level) { ?>
                        <div class="w-full">
                            <label class="flex items-center">
                                <input type="checkbox" name="trainingAddLevel[]"
                                    value="<?= htmlspecialchars($level->getGradeLevel()) ?>"
                                    class="font-normal rounded-md text-center w-4 h-4 placeholder-gray-400 border border-gray-400 mr-2">
                                <?php echo htmlspecialchars($level->getGradeLevel()); ?>
                            </label>
                        </div>
                    <?php }
                } else { ?>
                    <p class=" bg-red-300 w-full p-1 rounded text-white flex items-center justify-center text-sm mx-auto">Aucun
                        niveau
                        disponible.</p>
                <?php } ?>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit" name="btnAddTraining" id="btnAddTraining"
                    class="w-full bg-blue-600 text-white p-2 text-center rounded-md shadow-sm hover:bg-blue-700 focus:outline-none">Enregistrer</button>
                <a href="./../Users/directorHead.php"
                    class="w-full bg-gray-500 text-white p-2 text-center rounded-md shadow-sm hover:bg-gray-600 focus:outline-none">Annuler</a>
            </div>
        </form>
    </div>
    </div>

    </div>
</div>

    <script src="./../../../assets/js/scriptsFormAddTrainings.js"></script>
    <script src="./../../../assets/js/DirectorHead.js"></script>


   
</body>
</html>
