<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\LevelsController;

(new LevelsController())->addLevel();

/**
 * @var string<\App\Controller\LevelsController> $flasMessage  

 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un niveau </title>
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
            <a href="./../Users/Aindex.php" > <h1 class="bg-blue-600 w-full rounded underline p-1 m-0 hover:bg-blue-800 "> <i class="fas fa-home"></i>Accueil</h1></a>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-calendar-alt"></i>
            Évenements</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">Formations</a></li>
           
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Utilisateurs</h1>
            <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>Ajouter</a></li>
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
            <li><a href="./../Level/getLevels.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Niveaux</a></li>         
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Évenements</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Évenements</a></li>         
        </ul>
    </div>

    <!-- Contenu personnalisé -->
    <div class="flex-1 bg-gray-200 p-4 relative z-10">
        
    <div class="flex">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md flex-1">
          <!-- pour le message de la requete en cas d'erreur -->
       <span id="flashMessage" class="mt-4 flex items-center justify-center text-red-500"><?php 
       if(isset($flashMessage)) {
        echo ($flashMessage);
       }
       if (isset($_SESSION['flashMessage'])) {
        unset($_SESSION['flashMessage']);
    }
       ?></span>

        <h2 id="defaulfText" class="text-xl font-bold mb-6 text-center">Ajouter un niveau d'étude</h2>
    
        <form id="formAddLevel" method="post">
         
            <div class="mb-4" id="defaultGrade">
                <label for="grade" class="block text-gray-700 text-sm font-bold mb-2">Liste des niveaux déja disponible:</label> 
                <select id="lastName" name="lastName" class="bg-gray-200 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="notvalue">Voir</option> 
                <?php if (isset($levels) && is_array($levels)) { foreach ($levels as $level):{ ?>       
                    <option value="Niveau-1"><?= $level->getGradeLevel() ?></option>
                    
                  <?php } endforeach; } ?>
                </select><span id="lastNameError"></span>
               
            </div><hr>

                <label for="NamLevel" class="block text-gray-700 text-sm font-bold mb-2">Nom du niveau:</label>
                <input id="NamLevel" name="NamLevel" placeholder="Ex: Niveau-1 ou niveau-1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">        
                </input>
                <span id="NamLevelError" class="text-red-500 text-sm"></span>

            <div class="mb-4" >
                <label for="availability" class="block text-gray-700 text-sm font-bold mb-2">Disponibilité :</label>
                <select id="availability" name="availability" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="ouvert">Ouvert</option>
                    <option value="fermer">Fermer</option>
                </select>
            </div> 
            <span class="text-sm text-red-700">NB: un niveau peut etre enregitrer mais fermer (disponibilité=Fermer)</span>
            <div class="flex items-center justify-between">
                <button type="submit" name="btnAddLevel" id="btnAddLevel"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <i class="fas fa-save"></i>Enregistrer
                </button>
               <a href="./../Users/directorHead.php">
               <button id="btnCloseAddLevel" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
               <i class="fas fa-arrow-right"></i> quitter
                </button>
               </a>        
            
            </div>
        </form>
    </div>
    <div class="flex-1">
    <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
            <span id="flashConnxion"
                class=" hover:bg-blue-300 bg-blue-500 w-2/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] ?> <span class="text-sm">, vous etes connecter!</span></span>
        <?php } ?>
    </div>
    </div>


   
    <!-- fin Contenu personnalisé -->
    </div>
</div>

    <script src="./../../../assets/js/DirectorHead.js"></script>
     <!-- add js files -->
   <!--   //<script src="./../../../assets/js/scriptFormAddLevel.js"></script> -->
     <script src="./../../../assets/js/input.js"></script>

   <script>
    
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAddLevel');
    const NamLevelInput = document.getElementById('NamLevel');
    const NamLevelError = document.getElementById('NamLevelError');

    // Fonction de validation pour le champ NamLevel
    function validateField(input, field) {
        let errorMessage = '';
        const value = input.value.trim();
        let valid = true;

        if (field.type === 'text') {
            if (value.length !== field.minLength || value.length !== field.maxLength) {
                errorMessage = "Format requis: NIVEAU-4 ou niveau-4 (soit 8 caractères)";
                valid = false;
            }
        }

        NamLevelError.textContent = errorMessage;
        return valid;
    }

    // Écouteur d'événement pour la validation en temps réel lors de la saisie
    NamLevelInput.addEventListener('input', function () {
        validateField(NamLevelInput, { id: 'NamLevel', minLength: 8, maxLength: 8, type: 'text' });
    });

    // Écouteur d'événement pour la soumission du formulaire
    form.addEventListener('submit', function (e) {
        const NamLevelValue = NamLevelInput.value.trim();
        const NamLevelRegex = /^(niveau-|NIVEAU-)[1-9]$/;

        let valid = true;
        let errorMessage = '';

        if (!NamLevelValue) {
            errorMessage = 'Veuillez remplir tous les champs.';
            valid = false;
        } else if (NamLevelValue.length !== 8) {
            errorMessage = 'Le champ doit contenir 8 caractères';
            valid = false;
        } else if (!NamLevelRegex.test(NamLevelValue)) {
            errorMessage = 'Format incorrect.';
            valid = false;
        }

        NamLevelError.textContent = errorMessage;
        
        if (!valid) {
            e.preventDefault();
        }
    });
});

   </script>
  
   
</body>
</html>

