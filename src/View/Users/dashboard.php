<?php session_start();

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->dashboard();

/**
 * @var array<\App\Entity\User> $users
 * @var array<\App\Controller\UsersController> $auth_user 
 * @var array<\App\Service\UsersServices>  $auth  
 */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'administration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../../../assets/css/stylesMenuAdminP.css">
    <script src="./../../../assets/js/scriptMenuAdminP.js" defer></script>
    <script src="./../../../assets/js/editModal_1UsersDashboard.js" defer></script>
</head>

<body class="bg-gray-100">

    <!-- Top Navigation -->
    <nav class="bg-white shadow-md w-full fixed top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <h1 class="text-lg font-semibold">IFP Le leader en Info </h1>

                <!-- Barre de navigation principale -->
                <div id="main_menu" class="hidden lg:flex space-x-8 flex-1 justify-evenly items-center">
                    <!-- pages -->
                    <div class="relative group">
                        <button id="btn_accueil"
                            class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">pages</button>
                        <div id="accueil" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">acceuil</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">formation</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">evenement</a>
                        </div>
                    </div>
                    <!-- utilisateurs -->
                    <div class="relative group">
                        <button id="btn_propos"
                            class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">utilisateurs</button>

                        <div id="propos" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                            <a href="registration.php"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                            <form action="" method="post">
                                <button type="submit" name="get_all"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les
                                    utilisateurs</button>
                            </form>
                        </div>
                    </div>
                    <!-- formations -->
                    <div class="relative group">
                        <button id="btn_services"
                            class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">formations</button>
                        <div id="services" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les formations</a>
                        </div>
                    </div>
                    <!-- evenements -->
                    <div class="relative group">
                        <button id="btn_contact"
                            class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">evenements</button>
                        <div id="contact" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les evenements</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="inline-flex justify-between">
                <div class="bg-white p-1 block">
                    <form action="" method="post">
                        <button class="h-7 ">
                            <input type="search" required placeholder="rechercher"
                                class="px-2 h-full rounded placeholder-gray-400 border border-gray-400"><span
                                class="hover:bg-blue-400 hover:text-white h-7">rechercher</span>
                        </button>
                    </form>
                </div>
                <div class="relative group">
                    <a href="#"
                        class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">Deconnexion</a>
                </div>
                <!-- Bouton de menu pour les appareils mobiles -->
                <button id="menu_toggle" class=" bg-red-700  w-2/3 text-white hover:text-gray-900 focus:outline-none">
                    Menu
                </button>

            </div>

        </div>
        </div>
    </nav>

    <!-- Sidebar (for mobile view) -->
    <div id="sidebar"
        class="soumenu2 lg:hidden bg-opacity-50 fixed top-0 left-0 w-1/3 h-full bg-blue-300 shadow-md  z-20 transition-transform transform -translate-x-full lg:translate-x-0 lg:block">
        <nav class="p-1 flex flex-col">
            <!-- Barre de navigation principale -->

            <!-- pages -->
            <div class=" w-full">
                <button id="btn_accueil"
                    class="text-white  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">pages</button>
                <div id="accueil" class=" left-0 mt-2  bg-white shadow-lg rounded ">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">acceuil</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">formation</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">evenement</a>
                </div>
            </div>
            <!-- utilisateurs -->
            <div class="w-full ">
                <button id="btn_propos"
                    class="text-white  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">utilisateurs</button>
                <div id="propos" class="  left-0 mt-2 bg-white shadow-lg rounded ">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>

                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les utilisateurs</a>
                </div>
            </div>
            <!-- formations -->
            <div class="w-full">
                <button id="btn_services"
                    class="text-white  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">formations</button>
                <div id="services" class="  left-0 mt-2 bg-white shadow-lg rounded ">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les formations</a>
                </div>
            </div>
            <!-- evenements -->
            <div class="w-full">
                <button id="btn_contact"
                    class="text-white  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">evenements</button>
                <div id="contact" class="  left-0 mt-2  bg-white shadow-lg rounded ">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les evenements</a>
                </div>
            </div>


        </nav>
    </div>

    <!-- Main content -->
    <div id="content" class="lg:ml-64 p-4 mt-16  mx-auto ">
        <h1 class="text-2xl font-bold">Page d'Administration</h1>

        <p class="mt-4"> principal page.</p>
        <span class="mt-8 text-justify">
            <?php if (isset($_SESSION['auth']) && is_array($_SESSION['auth'])): ?>
                <p class="mb-4"><?= htmlspecialchars($_SESSION['auth'][1]) ?>     <?= htmlspecialchars($_SESSION['auth'][2]) ?>
                </p>
            <?php endif; ?>

            <h1>Bonjour,........ , </h1>
        </span>
    </div>

    <!-- list of users -->
    <div class="container place-items-center">
        <table class="lg:w-4/5 sm:w-full bg-white m-auto"> <?php if (isset($users) && is_array($users)) { ?>
                <thead>
                    <tr>
                        <th
                            class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Nom</th>
                        <th
                            class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Prenom</th>
                        <th
                            class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Numéro de téléphone</th>
                        <th
                            class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Matricule</th>
                        <th
                            class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 text-center">
                                <?= $user->getFirst_name() ?>
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200 text-center">
                                <?= htmlspecialchars($user->getName()) ?>
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200  justify-center items-center">
                                <?= htmlspecialchars($user->getMail()) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200  justify-center items-center">
                                <?= ($user->getPhone_number()) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200  justify-center items-center">
                                <?= htmlspecialchars($user->getRegistration_number()) ?>
                            </td>
                            <td class="py-1 px-1 border-b border-gray-200  justify-between items-center">
                                <button class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded"
                                    data-id="<?= $user->getId() ?>" data-Fist_name="<?= $user->getFirst_name() ?>"
                                    data-name="<?= $user->getName() ?>" onclick="openModal(this)">
                                    Modifier</button>
                                <button class="bg-red-300 hover:bg-red-400 text-white px-3 py-1 rounded">Supprimer</button>
                            </td>

                        </tr>
                    <?php endforeach;
        } ?>
            </tbody>
        </table>
    </div>
    <!-- modal de modification2-->
    
    <div id="editModal_2" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"> ​</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Modifier Un Utilisateur</h3>
                            <div class="mt-2">
                                <form id="editForm" method="POST" action="update_user.php">
                                    <input type="hidden" id="userId" name="id">
                                    <div class="mb-4">
                                        <label for="userName"
                                            class="block text-sm font-medium text-gray-700">Nom</label>
                                        <input type="text" id="userName" name="name"
                                            class="mt-1 p-2 border border-gray-300 rounded w-full">
                                    </div>
                                    <div class="mb-4">
                                        <label for="userFirst_name"
                                            class="block text-sm font-medium text-gray-700">Prenom</label>
                                        <input type="text" id="userFirst_name" name="First_name"
                                            class="mt-1 p-2 border border-gray-300 rounded w-full">
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button type="submit"
                                            class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:text-sm">Enregistrer</button>
                                        <button type="button" onclick="closeEditModal()"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- modal 1 de modification --> 
<div id="OpenModal" class="container lg:w-2/5  mx-auto fixed z-10 inset-0 overflow-y-auto hidden">
        <table class="bg-white border w-full">
            <thead>
                <tr>
                    <th class="py-2  px-4 bg-gray-400 border">Element</th>
                    <th class="py-2 px-4 bg-gray-300 border">Valeur</th>
                    <th class="py-2 px-4 bg-gray-500 border">Action</th>
                </tr>
            </thead> 
            <tbody>
                <!-- Ligne 1 -->
                <tr>
                    <td class="py-2  px-4 bg-gray-200 border "> Nom</td>
                    <td >  <p id="userFirst_name" class="text-sm text-black"></p></td>
                    <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full">Modifier</button></td>
                </tr>
                <!-- ligne 2 -->
                 <tr>
                 <td class="py-2  px-4 bg-gray-300 border">Prenom </td>
                 <td> <p id="userDetails" class="text-sm text-gray-500"></p></td>
                 <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full">Modifier</button></td>
                 </tr>
                 <!-- ligne 3 -->
                 <tr>
                 <td class="py-2  px-4 bg-gray-200 border">Numéro de Téléphone</td>
                 <td></td>
                 <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full">Modifier</button></td>
                 </tr>
                <!-- ligne 4 -->
                 <tr>
                 <td class="py-2  px-4 bg-gray-300 border">Email</td>
                 <td></td>
                 <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full">Modifier</button></td>
                 </tr>

               <!-- ligne 5 -->
                <tr>
                <td class="py-2  px-4 bg-gray-200 border">Matricule</td>
                <td></td>
                <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full">Modifier</button></td>
                </tr>
                <tr>
                <td colspan="3" class="py-2 px-4 text-center">
                        <button type="button" id="editModal1" onclick="closeOpenModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border 
                            border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium
                             text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                            
                </tr>
            </tbody>
        </table>
    </div>
   
       
</body>

</html>