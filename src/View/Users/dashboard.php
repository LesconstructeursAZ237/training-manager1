<?php session_start();

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->dashboard();

/**
 * @var array<\App\Entity\User> $users
 * @var array<\App\Controller\UsersController> $auth_user  
 * @var string<\App\Controller\UsersController> $flasMessage  
 * @var array<\App\Entity\User> $auth
 */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'administration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../../../assets/css/animationDasboard.css">
    <script src="./../../../assets/js/scriptMenuDashboard.js" defer></script>
    <script src="./../../../assets/js/openModalUsersDashboard.js" defer></script>
    <script src="./../../../assets/js/anotherFunctionDashboard.js" defer></script>

</head>

<body class="bg-gray-100">

    <!-- Top Navigation -->
    <nav class="bg-white shadow-md w-full fixed top-0 z-10 bg-blue-400 opacity-70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="menueActive flex justify-between h-16 items-center">
                <h1 class="text-lg font-bold text-white">IFP Le leader en Info </h1>
                    
                <!-- Bouton de menu pour les appareils mobiles -->
                <div class="relative">
                    <button id="btnMobilePhone"
                            class="lg:hidden bg-gray-700 sm:p-1 w-15 text-white p-4 hover:bg-blue-900 focus:outline-none  right-0">
                            Menu
                    </button>
                </div>

        <div>
            <button id="btnAccueil" onclick="toggleSubmenu('btnAccueil', 'submenu1')" class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">pages</button>
            <div id="submenu1" class="hidden ml-4 mt-2 w-48 shadow-lg rounded">
                <a href="index.php" class="block px-4 py-2 text-white hover:bg-gray-200">accueil</a>
                <a href="#" class="block px-4 py-2 text-white hover:bg-gray-200">formation</a>
                <a href="#" class="block px-4 py-2 text-white hover:bg-gray-200">evenement</a>
                <button onclick="closeSubmenu('submenu1')" class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
            </div>
        </div>
        <div>
            <button id="btnUser" onclick="toggleSubmenu('btnUser', 'submenu2')" class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">utilisateurs</button>
            <div id="submenu2" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                <button type="submit" id="btnAddUder" href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200" onclick="addNewUser()">ajouter</button>
                <form action="" method="post">
                    <button  name="get_all" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les utilisateurs</button>
                </form>
                <button onclick="closeSubmenu('submenu2')" class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
            </div>
        </div>
        <div>
            <button id="btnService" onclick="toggleSubmenu('btnService', 'submenu3')" class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">formations</button>
            <div id="submenu3" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                <a href="./../Trainings/trainings.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                <a href="./../Trainings/getTrainings.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les formations</a>
                <button onclick="closeSubmenu('submenu3')" class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
            </div>
        </div>
        <div>
            <button id="btnLevel" onclick="toggleSubmenu('btnLevel', 'submenuNiveau')" class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">Niveau</button>
            <div id="submenuNiveau" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                <a href="./../Level/addLevels.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                <a href="./../Level/getLevels.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les niveaux</a>
                <button onclick="closeSubmenu('submenuNiveau')" class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
            </div>
        </div>
        <div>
            <button id="btnEvent" onclick="toggleSubmenu('btnEvent', 'submenu4')" class="btnMenu text-white rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">evenements</button>
            <div id="submenu4" class="hidden ml-4 mt-2 w-48 bg-white shadow-lg rounded">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les evenements</a>
                <button onclick="closeSubmenu('submenu4')" class="block px-4 py-2 bg-red-500 text-white rounded">X</button>
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

                <div class="relative group">
                    <a href="#"
                        class="text-white   rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">Deconnexion</a>
                </div>


            </div>

        </div>
        </div>
    </nav>

    <!-- Sidebar (for mobile view) -->
    <div id="menuMobilePhone"
        class="soumenu2 lg:hidden bg-opacity-70 fixed top-0 left-0 w-1/3 h-full bg-blue-700 shadow-md  z-20 transition-transform transform -translate-x-full lg:translate-x-0 lg:block">
        <nav class="p-1 flex flex-col">
            <!-- Barre de navigation principale -->
            <div class="w-full ">
                <button id="btn_propos"
                    class="text-white  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">utilisateurs</button>

                <div id="propos" class=" left-0 mt-2 w-48 bg-white shadow-lg rounded">
                    <a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                    <form action="" method="post">
                        <button type="submit" name="get_all"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les
                            utilisateurs</button>
                    </form>
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
    </div><br>

    <!-- Main content -->
    <div id="content" class="lg:ml-64 p-4 mt-16  mx-auto ">
        
    </div>
       <!-- pour le resulat de la requete -->
       <span id="flashMessage" class="mt-4 flex items-center justify-center text-red-500"><?php 
            if(isset($flashMessage)) {
                echo ($flashMessage);
            }
            if (isset($_SESSION['flashMessage'])) {
                 unset($_SESSION['flashMessage']); 
                }?>
       </span>

    <!-- list of users -->
    <div class=" place-items-center w-10/12 m-auto">
   <?php if (isset($auth_user)  && is_array($auth_user)) { ?>
        <span id="flashConnxion"
            class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center  m-auto"
            onclick="closeFlashConnexion()"> <?= $auth_user[0].' '.$auth_user[1].', vous ete connecter' ?></span>
    <?php } ?>
    <table class="w-full bg-white m-auto mb-8"> <?php if (isset($users) && is_array($users)) { ?>
            <h2 class="text-2xl font-bold lg:ml-64 p-4 mt-16  mx-auto "><?= $listUser ?></h2>
            <thead>
                <tr>
                    <th
                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        occupation</th>
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
            <tbody class="text-sm">
                <?php foreach ($users as $user): ?>
                    <tr >
                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                            <?= $user->getRole() ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                            <?= $user->getFirst_name() ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                            <?= htmlspecialchars($user->getName()) ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200  justify-center items-center">
                            <?= htmlspecialchars($user->getMail()) ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200  justify-center items-center">
                            <?= ($user->getPhone_number()) ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200  justify-center items-center">
                            <?= htmlspecialchars($user->getRegistration_number()) ?>
                        </td>
                        <td class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <button class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded"
                                data-FistName="<?= $user->getFirst_name() ?>" data-name="<?= $user->getName() ?>"
                                data-email="<?= $user->getMail() ?>" data-telephone="<?= $user->getPhone_number() ?>"
                                data-registrationNumber="<?= $user->getRegistration_number() ?>"
                                data-matricule="<?= $user->getId() ?>" onclick="openModal(this)">
                                Modifier</button>
                            <button class="bg-red-300 hover:bg-red-400 text-white px-3 py-1 rounded"
                                data-identifiant="<?= $user->getId() ?>" data-Nom="<?= $user->getFirst_name() ?>"
                                data-Prenom="<?= $user->getName() ?>" onclick="openDeleteModal(this)">Supprimer</button>
                        </td>

                    </tr>
                <?php endforeach;
    } ?>
        </tbody>
    </table>
</div>

    <!-- delete modal -->
     <div id="deleteModal" class="container lg:w-2/5  mx-auto fixed z-10 inset-0 overflow-y-auto hidden">
     <form class="bg-red-200 p-8 rounded-lg shadow-md w-full max-w-md " method="post">
        <h3>voulez-vous Supprimer <span id="DeleteNom" class="font-bold"> </span>?</h3>

        <div class="mb-4">
        <?php if (isset($auth_user)): ?>
                                     <input required type="hedden"  id="deletedU" name="deletedU" value="<?php echo$auth_user;  ?>"  class="hidden ">
                                    <?php endif; ?>
            <input type="hidden" id="identifiant" name="identifiant" class=" border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" name="btnDeleteUser">confirmer</button>
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeDeleteModalUser()">quitter</button>      
        </div>            
    </form>
    </div>
    <!--end delete modal -->
 
  
   

    <!--open modal -->
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
                    <td>
                        <p id="userNom" class="text-sm text-gray-500"></p>
                        <form action="" id="editNom" method="post" class="hidden">
                            <div>
                            <?php if (isset($auth_user)): ?>
                                     <input required type="hidden"  id="modifiedNom" name="modifiedNom" value="<?php echo$auth_user; ?>"  class=" ">
                                    <?php endif; ?>
                                <input type="hidden" id="indentifiantNom" name="indentifiantNom">
                                <input type="text" placeholder="nouvelle valeur nom ici" class="font-normal 
                                rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 
                                 w-full  placeholder-gray-400 border border-gray-400" required name="newNom" >
                            </div>
                            <div class="flex justify-between">
                                <button type="bumit" class="bg-blue-300 text-white p-1 
                            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" name="editNom">✔</button>
                                <button type="button" class="bg-gray-400 w-10 right-0 text-white p-1 
                            hover:bg-grax-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onclick="closeeditModalNom()">X</button>
                            </div>
                        </form>
                    </td>
                    <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full"
                            onclick="editModalNom()">Modifier</button>
                    </td>
                </tr>
                <!-- ligne 2 -->
                <tr>
                    <td class="py-2  px-4 bg-gray-300 border">Prenom </td>
                    <td>
                        <p id="userPrenom" class="text-sm text-gray-500"></p>
                        <form action="" id="editPrenom" method="post" class="hidden">
                            <div>
                            <?php if (isset($auth_user)): ?>
                                     <input required type="hidden"  id="modifiedPrenomr" name="modifiedPrenom" value="<?php echo$auth_user;  ?>"  class=" ">
                                    <?php endif; ?>
                                <input type="hidden" id="indentifiantPrenom" name="indentifiantPrenom">
                                <input type="text" placeholder="nouvelle valeur prenom ici" class="font-normal 
                                rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 
                                 w-full  placeholder-gray-400 border border-gray-400" required name="newPrenom">
                            </div>
                            <div class="flex justify-between">
                                <button type="bumit" class="bg-blue-300 text-white p-1 
                            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" name="editPrenom">✔</button>
                                <button type="button" class="bg-gray-500 w-10 right-0 text-white p-1 
                            hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onclick="closeeditModalPrenom()">X</button>
                            </div>
                        </form>
                    </td>
                    <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full"
                            onclick="editModalPrenom()">Modifier</button>
                    </td>
                </tr>
                <!-- ligne 3 -->
                <tr>
                    <td class="py-2  px-4 bg-gray-200 border">Numéro de Téléphone</td>
                    <td>
                        <p id="userTelephone" class="text-sm text-gray-500"></p>
                        <form action="" id="editPhoneNumber" method="post" class="hidden">
                            <div>
                            <?php if (isset($auth_user) ): ?>
                                     <input required type="hidden"  id="modifiedPhoneNumber" name="modifiedPhoneNumber" value="<?php echo$auth_user ; ?>"  class=" ">
                                    <?php endif; ?>
                                <input type="text" id="indentifiantTelephone" name="indentifiantTelephone">
                                <input type="number" placeholder="nouvelle valeur numero telephone ici" class="font-normal 
                                rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 
                                 w-full  placeholder-gray-400 border border-gray-400" name="newPhoneNumber" required>
                            </div>
                            <div class="flex justify-between">
                                <button type="bumit" class="bg-blue-300 text-white p-1 
                            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" name="EditPhoneNumber">✔</button>
                                <button type="button" class="bg-gray-500 w-10 right-0 text-white p-1 
                            hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onclick="closeeditModalPhone()">X</button>
                            </div>
                        </form>
                    </td>
                    <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full"
                            onclick="editModalPhoneNumber()">Modifier</button>
                    </td>
                </tr>
                <!-- ligne 4 -->
                <tr>
                    <td class="py-2  px-4 bg-gray-300 border">Email</td>
                    <td>
                        <p id="userEmail" class="text-sm text-gray-500"></p>
                        <form action="" id="editEmail" method="post" class="hidden">
                            <div>
                            <?php if (isset($auth_user)): ?>
                                     <input required type="hidden"  id="modifiedEmail" name="modifiedEmail" value="<?php echo$auth_user;  ?>"  class=" ">
                                    <?php endif; ?>
                    
                                <input type="hidden" id="indentifiantEmail" name="indentifiantEmail">
                                <input type="email" placeholder="nouvelle valeur email ici" class="font-normal 
                                rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 
                                 w-full  placeholder-gray-400 border border-gray-400" name="newEmail" required>
                            </div>
                            <div class="flex justify-between">
                                <button type="bumit" class="bg-blue-300 text-white p-1 
                            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" name="editEmail">✔</button>
                                <button type="button" class="bg-gray-500 w-10 right-0 text-white p-1 
                            hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onclick="closeeditModalEmail()">X</button>
                            </div>
                        </form>
                    </td>
                    <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full"
                            onclick="editModalEmail()">Modifier</button>
                    </td>
                </tr>
                <!-- ligne 5 -->
                <tr>
                    <td class="py-2  px-4 bg-gray-200 border">Matricule</td>
                    <td>
                        <p id="registrationNumber" class="text-sm text-gray-500"></p>
                        <!-- form change registration number -->
                        <form action="" id="editMat" method="post" class="hidden">
                            <div>
                                <?php if (isset($auth_user)): ?>
                                     <input required type="hidden"  id="modifiedMatricule" name="modifiedMatricule" value="<?php echo$auth_user;  ?>"  class=" ">
                                    <?php endif; ?>
                                <input id="indentifiantMat" name="indentifiantMat" type="hidden">
                                <input type="text" placeholder="nouvelle valeur matricutle ici" class="font-normal 
                                rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 
                                 w-full  placeholder-gray-400 border border-gray-400" name="newMat" required>
                            </div>
                            <div class="flex justify-between">
                                <button type="bumit" class="bg-blue-300 text-white p-1 
                            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" name="editMat">✔</button>
                                <button type="button" class="bg-gray-500 w-10 right-0 text-white p-1 
                            hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onclick="closeeditModalMat()">X</button>
                            </div>
                        </form>

                    </td>
                    <td><button class="bg-blue-300 hover:bg-blue-500 text-white px-3 py-1 rounded w-full"
                            onclick="editModalMat()">Modifier</button>
                    </td>
                </tr>
                <!-- ligne 6 boutton -->

                <tr>
                    <td colspan="3" class="p-auto text-center ">
                        <button type="button" id="editModal1" onclick="closeOpenModal()" class="mt-3 lg:w-2/5 inline-flex justify-center  rounded-md border 
                            border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium
                             text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                        <button id="openModalChangeRole"
                            class="bg-blue-500 hover:bg-blue-800 text-white px-3 py-1 rounded w-2/5"
                            onclick="openModalChangeRole()">Nommer
                            Admin?</button>
                    </td>
                </tr>
                <!-- ligne  7 changer le role/ Nommer Admin?  -->
                <tr class="hidden" id="changeRole">
                    <td colspan="3" class="p-auto text-center items-center ">
                        <!--formulaire de modification du status -->
                        <div class="bg-white p-8 rounded-lg shadow-md w-1/2 max-w-md">
                            <h2 class="text-lg font-bold mb-6 text-center">Formulaire de modification d'occupation</h2>
                            <form action="" method="post">
                                <div class="mb-4">
                              
                                    <?php if (isset($auth_user)): ?>
                                     <input required type="hidden"  id="modified" name="modified" value="<?php echo$auth_user; ?>"  class=" ">
                                    <?php endif; ?>
                               
                                    <input id="identifiantModalChangeRole" class="hidden" type="number" name="newId">
                                    <label for="dropdown" class="block text-gray-700 font-medium mb-2">Sélectionnez une
                                        option</label>
                                    <select id="dropdown" name="dropdown"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="visitor">Visiteur</option>
                                        <option value="student">Étudiant</option>
                                        <option value="secretary">Sécrétaire</option>
                                    </select>
                                </div>
                                <div class="flex justify-between">
                                    <button type="submit" name="changeRole"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">✔</button>
                                    <button id="closeModalChangeRole" type="button"
                                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                        onclick="ChangeRole()">X</button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- add an User -->
     <!-- formulaire d'inscription d'utilisateur -->
<div id="formAddUser" class="absolute hidden  inset-10 flex mt-2 mb-8 h-full sm:text-xs text-center m-auto shadow-xl rounded-lg sm:w-10/12 md:w-96 lg:w-1/2 xl:w-1/2 lg:text-xl md:text-lg 2xl:bg-red-200 overflow-auto border-gray-800">

<form action="addUser.php" class="m-auto xl:w-full 2xl:w-full" id="registrationForm" method="post">

    <div class="p-1 bg-red-200 overflow-auto rounded-lg m-auto text-base">
                <h1
                    class="mt-8 sm:text-xs md:text-base lg:text-lg xl:text-xl 2xl:text-2xl m-auto capitalize text-blue-500 font-bold">
                    Formulaire d'ajout d'utilisateur
                </h1>

                <div class=" grid grid-cols-1 md:grid-cols-2 gap-3 overflow-auto p-4">
                    <div class="w-full">
                        <label for="name" class="text-black font-bold">Nom: <br>
                            <input required type="text" placeholder="Votre nom ici" id="name" name="name"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <div class="w-full">
                        <label for="firstName" class="text-black font-bold">Prenom: <br>
                            <input required type="text" placeholder="First Name" id="firstName" name="firstName"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <div class="w-full">
                        <label for="mail" class="text-black font-bold">Adresse Email: <br>
                            <input required type="email" placeholder="Votre adresse email ici" id="mail" name="mail"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <div class="w-full">
                        <label for="phone_number" class="text-black font-bold">Numéro de téléphone: <br>
                            <input required type="number" placeholder="690 487 232" id="phone_number" name="phone_number"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <div class="w-full">
                        <label for="birth_date" class="text-black font-bold">Date de Naissance: <br>
                            <input required type="date" id="birth_date" name="birth_date"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <div class="w-full">
                        <label for="photo_user" class="text-black font-bold">Photo: <br>
                            <input required type="file" id="photo_user" name="photo_user"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <!-- Input qui prend deux colonnes -->
                    <div class="w-full md:col-span-2">
                        <label for="address" class="text-black font-bold">Mot de passe: <br>
                            <input required type="password" placeholder="Votre mot de passe ici" id="pwdUser" name="pwdUser"
                                class="font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                        </label>
                    </div>
                    <div class="w-full md:col-span-2">
                        <?php if (isset($auth_user)): ?>
                            <input required type="hidden" id="modified" name="modified"
                                value="<?php echo$auth_user;  ?>"
                                class="">
                        <?php endif; ?>
                    </div>
                </div>
    
                <div class="grid grid-cols-2 gap-3 overflow-auto p-4">
                    <div class="w-full">
                        <button type="submit"
                            class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 w-full hover:bg-blue-200 hover:text-blue-00 text-white font-bold rounded-md text-center"
                            name="registration" id="">
                            Ajouter
                        </button>
                    </div>
                    <div class="w-full">
                        <button 
                            class="bg-gray-500 sm:text-xs xl:text-xl p-1 h-10 w-full hover:bg-red-300 text-white font-bold rounded-md text-center">
                            <a href="">Retour</a>
                        </button>
                    </div>
                    
                </div>
            </div>
            
        </form>
    </div>

</body>

</html>