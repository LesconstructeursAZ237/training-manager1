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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../../../assets/css/animationFormTrainings.css">
    <script src="./../../../assets/js/scriptMenuTrainings.js" defer></script>
    <script src="./../../../assets/js/openModalUsersDashboard.js" defer></script>
    <script src="./../../../assets/js/scriptsFormAddTrainings.js" defer></script>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-md w-full fixed top-0 z-10 bg-blue-500 opacity-70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="menueActive flex justify-between h-16 items-center">
                <h1 class="text-lg font-bold text-white">IFP Le leader en Informatique </h1>

                <!-- Bouton de menu pour les appareils mobiles -->
                <div class="relative">
                    <button id="btnMobilePhone"
                        class="lg:hidden bg-gray-700 sm:p-1 w-15 text-white p-4 hover:bg-blue-900 focus:outline-none  right-0">
                        Menu
                    </button>
                </div>

                <div>
                    <button id="btnAccueil" onclick="toggleSubmenu('btnAccueil', 'submenu1')"
                        class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">pages</button>
                    <div id="submenu1" class="hidden ml-4 mt-2 w-48 shadow-lg rounded">
                        <a href="dashboard.php" class="block px-4 py-2 text-white hover:bg-gray-200">administration</a>
                        <a href="#" class="block px-4 py-2 text-white hover:bg-gray-200">evenement</a>
                        <button onclick="closeSubmenu('submenu1')"
                            class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
                    </div>
                </div>
                <div>
                    <button id="btnUser" onclick="toggleSubmenu('btnUser', 'submenu2')"
                        class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">utilisateurs</button>
                    <div id="submenu2" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                        <button id="btnAddUder" href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200"
                            onclick="addNewUser()">ajouter</button>
                        <form action="" method="post">
                            <button type="submit" name="get_all"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les utilisateurs</button>
                        </form>
                        <button onclick="closeSubmenu('submenu2')"
                            class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
                    </div>
                </div>
                <div>
                    <button id="btnService" onclick="toggleSubmenu('btnService', 'submenu3')"
                        class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">formations</button>
                    <div id="submenu3" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                        <a href="trainings.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">modifier</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les formations</a>
                        <button onclick="closeSubmenu('submenu3')"
                            class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
                    </div>
                </div>
                <div>
                    <button id="btnEvent" onclick="toggleSubmenu('btnEvent', 'submenu4')"
                        class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">evenements</button>
                    <div id="submenu4" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les evenements</a>
                        <button onclick="closeSubmenu('submenu4')"
                            class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
                    </div>
                </div>


            </div>
            <div class="">
                <!-- search form -->
                <div class=" rounded-lg w-full max-w-md lg:float-right">
                    <form action="" method="post">
                        <div class="flex items-center mb-4">
                            <input type="text" id="search" name="search" placeholder="Entrez votre recherche"
                                class="w-full px-4 py-2 h-full border rounded-l-lg ">
                            <button type="submit"
                                class="bg-blue-500 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        </div>
    </nav>

    <!-- form add training -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md relative z-10 p-4" id="formTrainingsAdd">
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
        
        <form id="FormAddTraining"  method="POST" >
            <div  class="grid grid-cols-1 md:grid-cols-2 gap-3 overflow-auto p-4">
                <div class="w-full">
                    <!-- modifid value -->
                    <?php if (isset($auth_user) && is_array($auth_user)) {?>
                        <input type="text" placeholder="modified" id="modified" name="modified" value="<?= $auth_user[2]?>"
                            class=" hidden font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
        <?php }?>
                    
                           
                     <label for="codes" class="text-black">Code: <br>
                        <input type="text" placeholder="Code de la formation" id="codes" name="codes"
                            class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                            <span id="codesError" class="text-red-500"></span>
                        </label>
                </div>
                <div class="w-full ">
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
                <button type="submit" name="btnAddTraining"
                    class="w-full bg-blue-600 text-white p-2 text-center rounded-md shadow-sm hover:bg-blue-700 focus:outline-none">Enregistrer</button>
                <a href="./../Users/dashboard.php"
                    class="w-full bg-gray-500 text-white p-2 text-center rounded-md shadow-sm hover:bg-gray-600 focus:outline-none">Annuler</a>
            </div>
        </form>
    </div>

</body>

</html>