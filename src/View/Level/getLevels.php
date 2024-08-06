<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\LevelsController;

(new LevelsController())->getLevel();

/**
 * @var array<\App\Entity\Level> $levels
 * @var string<\App\Controller\LevelsController> $flasMessage  

 */
if(!($_SESSION['ArrayAuth'])){  

    header("location: ./../Users/signin.php");
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des niveaux d'étude</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../../../assets/css/animationGetLevel.css">
    <!-- add js files -->

</head>

<body class="bg-gray-100">

    <!-- Logo -->
    <div class="absolute inset-0 z-0">
        <img src="./../../../../assets/img/logo1.png" alt="Logo" class="ml-0 p-0 h-1/12 w-1/12 object-contain">
    </div>

    <nav class="bg-blue-900 opacity-90 p-0 h-2/12">

        <div class="container mx-auto flex items-center justify-between ">

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-4 items-center">
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i
                        class="fas fa-user px-2"></i>Utilisateurs</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i
                        class="fas fa-graduation-cap px-2"></i>Formations</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i
                        class="fas fa-calendar-alt px-2"></i>Évènements</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i
                        class="fas fa-graduation-cap px-2"></i>Niveau</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i
                        class="fas fa-user-graduate px-2"></i>Étudiants</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i
                        class="fas fa-home px-2"></i>Accueil</button>
                        <?php if (isset($_SESSION['ArrayAuth'])) { ?>
                       <form action="../Users/signOut.php" method="post">
                       <button type="sumbit" class="text-white hover:bg-blue-400 p-2 rounded
                             " name="signout" id="btn_signout">
                             Deconnexion
                        </button>
                       </form>
                            
                    <?php }  ?>
            </div>

            <!-- Search Bar -->
            <div class=" m-2 rounded-lg w-full max-w-md flex items-center justify-center h-full">
                <form action="" method="post" class="w-full flex">
                    <input type="text" id="search" name="search" placeholder="Entrez votre recherche"
                        class="w-full px-4 py-2 h-full border rounded-l-lg">
                    <button type="submit"
                        class="bg-blue-800 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none"><i
                            class="fas fa-search px-2"></i></button>
                </form>
            </div>

            <!-- Profile Button -->
            <div class="flex items-center space-x-4">
                <button class="text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500"><i
                        class="fas fa-user-cog px-2"></i>Profil</button>
                <button id="btnOpenVerticalMenu" onclick="openVerticalMenu()"
                    class="lg:hidden text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500">Menu</button>
            </div>
        </div>


    </nav>


    <div class="flex flex-col md:flex-row h-full ">
        <!-- Menu vertical à gauche -->
        <div id="verticalMenu"
            class="hidden md:block  sm:w-1/3 md:w-1/5 hidden bg-white text-black opacity-90  p-4  overflow-auto top-2/12">
            <ul>
                <a href="./../Users/Aindex.php">
                    <h1
                        class="w-full text-blue-700 font-bold rounded p-2 m-0 hover:bg-blue-800 hover:text-white hover:underline ">
                        <i class="fas fa-home px-2"></i> Accueil</h1>
                </a>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-calendar-alt px-2"></i>Évenements</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-graduation-cap px-2"></i>Formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i class="fas fa-user px-2"></i>Utilisateurs
                </h1>
                <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i>ajouter</a></li>
                <li><a href="./../Users/directorHead.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-eye px-2"></i>voir
                        les Utilisateurs</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i
                        class="fas fa-graduation-cap"></i>Formation</h1>
                <li><a href="./../Trainings/addTrainings.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i>ajouter</a></li>
                <li><a href="./../Trainings/getTrainings.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-eye px-2"></i>voir
                        les formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i class="fas fa-graduation-cap"></i>Niveau
                </h1>
                <li><a href="./../Level/addLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i>ajouter</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0  "><i
                        class="fas fa-graduation-cap px-2"></i></i>
                    Etudiant</h1>
                <li><a href="./../Student/addStudent.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white  rounded"><i class="fas fa-plus px-2"></i>
                        ajouter</a></li>
                <li><a href="./../Student/getStudent.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white  rounded"><i class="fas fa-eye px-2"></i>
                        voir
                        les Étudiants</a></li>
            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i
                        class="fas fa-calendar-alt"></i>Évenements</h1>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i>ajouter</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-eye px-2"></i>voir les Évenements</a></li>
            </ul>
        </div>

        <!-- Contenu personnalisé -->
        <div class="flex-1 bg-gray-200 p-4 relative z-10">
            <!-- Contenu personnalisé -->

            <!-- pour le resulat de la requete -->
            <span id="flashMessage" class="mt-4 flex items-center justify-center text-white font-bold"><?php
            if (isset($flashMessage)) {
                echo ($flashMessage);
            }
            if (isset($_SESSION['flashMessage'])) {
                unset($_SESSION['flashMessage']);
            } ?>
            </span>

            <div class="container mx-auto px-4 py-8">
                <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
                    <span id="flashConnxion"
                        class=" flex hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                        onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] ?> <span class="text-sm">, vous etes
                            connecter!</span></span>
                <?php } ?>

                <?php if (isset($levels) && is_array($levels)) { ?>
                    <span id="response" class="mt-4 flex items-center justify-center"></span>
                    <h2 class="text-2xl font-bold text-center p-4 mt-16"><?= $listLevel ?></h2>

                    <div class="overflow-x-auto">
                        <table class="w-2/3 bg-white mx-auto mb-8">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Nom</th>
                                    <th
                                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Disponibilité</th>
                                    <th
                                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($levels as $level): ?>
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $level->getId() ?></td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                                            <?= $level->getGradeLevel() ?></td>
                                        <td <?php if ((htmlspecialchars($level->getAvailabilities())) == 'ouvert') {
                                            echo 'class="py-2 px-4 border-b border-gray-200 text-center text-green-500 " ';
                                        } else {
                                            echo 'class="py-2 px-4 border-b border-gray-200 text-center text-red-500" ';
                                        } ?> ?>
                                            <?= htmlspecialchars($level->getAvailabilities()) ?>
                                        </td>

                                        <td class="py-1 px-1 border-b border-gray-200 text-center flex justify-between">
                                            <!-- btn open and close level -->
                                            <div>
                                                <form action="updateLevel.php" method="post">

                                                    <?php if ((htmlspecialchars($level->getAvailabilities())) == 'ouvert') { ?>
                                                        <input type="number" class="hidden" name="idUpdateLevel" id="idUpdateLevel"
                                                            value="<?= $level->getId() ?>">
                                                        <button name="btnCloseLevel" type="submit"
                                                            class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded"><i
                                                                class="fas fa-window-close"></i>Fermer</button>
                                                    <?php } else { ?>
                                                        <input type="number" class="hidden" name="idUpdateLevel" id="idUpdateLevel"
                                                            value="<?= $level->getId() ?>">
                                                        <button type="submit" name="btnOpenLevel"
                                                            class="bg-green-400 hover:bg-green-500 text-white px-3 py-1 rounded"><i
                                                                class="fas fa-unlock"></i>Ouvrir </button>
                                                    <?php } ?>

                                                </form>
                                            </div>
                                            <!-- btn delele level -->
                                            <div>
                                                <form action="deleteLevel.php" method="post">
                                                    <input type="hidden" class="number" name="iddeleteLevel" id="iddeleteLevel"
                                                        value="<?= $level->getId() ?>">
                                                    <button type="submit" name="btndeleteLevel"
                                                        class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </div>

                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p class=" bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto">Aucun
                        niveau
                        disponible.</p>
                <?php } ?>
            </div>
            <!--fin Contenu personnalisé -->
        </div>
        <!--fin Contenu personnalisé -->
    </div>

    <script src="./../../../assets/js/scriptMenuTrainings.js" defer></script>
    <script src="./../../../assets/js/scriptsFormAddTrainings.js" defer></script>
    <script src="./../../../assets/js/DirectorHead.js"></script>



</body>

</html>