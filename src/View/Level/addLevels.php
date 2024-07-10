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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- add js files -->
    <script src="./../../../assets/js/scriptFormAddLevel.js" defer></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
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
        <h2 id="persolnalizeText" class="text-xl font-bold mb-6 text-center hidden">Ajouter un niveau d'étude personalisé</h2>
        <form id="formAddLevel" method="post">
         
            <div class="mb-4" id="defaultGrade">
                <label for="grade" class="block text-gray-700 text-sm font-bold mb-2">Grade :</label>
                <select id="selectedGrade" name="grade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="notvalue">choisir un grade</option>    
                    <option value="Niveau-1">Niveau-1</option>
                    <option value="Niveau-2">Niveau-2</option>
                    <option value="Niveau-3">Niveau-3</option>
                    <option value="Niveau-4">Niveau-4</option>
                    <option value="Niveau-5">Niveau-5</option>
                   
                </select>
               
            </div>
            <div id="personalizeGrade" class="mb-4 hidden">
                <label for="gradeP" class="block text-gray-700 text-sm font-bold mb-2">Grade personalisé:</label>
                <input type="number" id="gradePersonalize" name="gradePersonalize" class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ex: 2">
                <span id="error" class="text-sm text-red-500"></span>
            </div>

            <div class="mb-4" >
                <label for="availability" class="block text-gray-700 text-sm font-bold mb-2">Disponibilité :</label>
                <select id="availability" name="availability" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="ouvert">Ouvert</option>
                    <option value="fermer">Fermer</option>
                </select>
            </div>
            <span class="text-sm text-red-700">NB: un niveau peut etre enregitrer mais fermer (disponibilité=Fermer)</span>
            <div class="flex items-center justify-between">
                <button type="submit" name="btnAddLevel" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
               <a href="./../Users/dashboard.php">
               <button id="btnCloseAddLevel" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    quitter
                </button>
               </a>
                <button id="btnPreviewAddLevel" onclick="retour()" type="button" class=" hidden bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    retour
                </button>
                <button id="btnPersonalize" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="personalizeLevel()">
                    Personaliser
                </button>
            </div>
        </form>
    </div>
</body>
</html>
