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
            <li><a href="addUser.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>Ajouter</a></li>
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

    <!--debut Contenu personnalisé -->
    <div class="flex bg-gray-200 p-4">
        <!-- debutContenu personnalisé -->
          <!-- pour le resulat de la requete -->
      
        
         <!-- list of users -->
    <div class="flex-1 z-10 place-items-center w-10/12 m-auto">

   <?php if (isset($auth_user)  && is_array($auth_user)) { ?>
        <span id="flashConnxion"
            class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white  items-center justify-center  m-auto"
            onclick="closeFlashConnexion()"> <?= $auth_user[1].', vous ete connecter' ?></span>
    <?php } ?> 
    
    <span id="flashMessage" class="mt-4 flex place-items-center text-red-500"><?php 
            if(isset($flashMessage)) {
                echo ($flashMessage);
            }
            if (isset($_SESSION['flashMessage'])) {
                 unset($_SESSION['flashMessage']); 
                }?>
       </span>

    <table class="w-full flex-1 bg-white m-auto mb-8"> <?php if (isset($users) && is_array($users)) { ?>
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
                                data-IdUser="<?= $user->getId() ?>" 
                               
                                onclick="openEditUser(this)">
                                <i class="fas fa-user-edit "></i></button>
                            <button class="bg-red-300 hover:bg-red-400 text-white px-3 py-1 rounded"
                                data-nom_1="<?= $user->getId() ?>" 
                                onclick="openDeleteModal(this)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>

                    </tr>
                <?php endforeach;
    } else { ?>
        <p class=" bg-blue-500 w-2/3 p-2 rounded text-white flex items-center justify-center mx-auto">Aucun utilisateur
            trouvé.</p>
    <?php } ?>
        </tbody>
    </table>
</div> 
<!-- End users list -->

 <!-- delete modal -->
 <div id="deleteModal" class="container lg:w-2/5 flex-1  mx-auto fixed z-10 inset-0 overflow-y-auto hidden">
     <form class="bg-red-200 p-8 rounded-lg shadow-md w-full max-w-md " method="post" action="delete.php">
        <h3>voulez-vous Supprimer <span id="DeleteNom" class="font-bold"> </span>?</h3>

        <div class="mb-4">
        <?php if (isset($auth_user)): ?>
                                     <input required type="hedden"  id="deletedU" name="deletedU" value="<?php echo$auth_user;  ?>"  class="hidden ">
                                    <?php endif; ?>
            <input type="hidden" id="deleteID" name="deleteID" class=" border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" name="btnDeleteUser">confirmer</button>
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeDeleteModalUser()">quitter</button>      
        </div>            
    </form>
    </div>
    <!--end delete modal -->
    
 <!-- form Edit user -->
     <!-- form -->
     <div id="formEditUser" class=" absolute flex-1 z-10 hidden place-items-center sm:text-xs text-center m-auto rounded-lg sm:w-10/12 md:w-96 lg:w-1/2 xl:w-1/2 lg:text-xl md:text-lg 2xl:bg-red-200 overflow-auto ">
    <form action="update.php" class="m-auto xl:w-full 2xl:w-full" id="EditForm" method="post">
    <div class=" bg-white text-white overflow-auto rounded-lg m-auto text-base">
        <h1 class="text-black p-2 sm:text-xs md:text-base lg:text-lg xl:text-xl 2xl:text-2xl m-auto capitalize font-bold">
            Formulaire de modification d'utilisateur
        </h1>idUser
        <div class="grid bg-white grid-cols-1 md:grid-cols-2 gap-3 overflow-auto p-4">
          
                    <input required type="hidden"  id="idUser" name="idUser" class="text-black bg-gray-300">
                    
                    <input required type="hidden"  id="modifiedSessionUser" name="modifiedSessionUser" class="text-black bg-gray-300" value="<?php  if(isset($_SESSION['ArrayAuth'])){ ?>
                    
                    <?= $_SESSION['ArrayAuth'][1]; }?>">
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
                <label for="phoneNumber" class="text-black font-bold">Numéro de téléphone (9chiffres): <br>
                    <input required type="number" placeholder="690 487 232" id="phoneNumber" name="phoneNumber"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="phoneNumberError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="matriculeUser" class="text-black font-bold">Matricule: <br>
                    <input required type="text" placeholder="matricule" id="matriculeUser" name="matriculeUser"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="matriculeUserError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="birthDate" class="text-black font-bold">Date de Naissance: <br>
                    <input type="date" id="birthDate" name="birthDate"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="birthDateError" class="text-red-500 text-xs"></span>
                </label>
            </div>
            <div class="w-full">
                <label for="photo_user" class="text-black font-bold">Photo: <br>
                    <input type="file" id="photoUser" name="photoUser"
                        class="text-black font-normal rounded-md text-center sm:h-5 xl:h-10 lg:h-10 md:h-10 w-full placeholder-gray-400 border border-gray-400">
                    <span id="photoUserError" class="text-red-500 text-xs"></span>
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
                    class="bg-blue-500 sm:text-xs xl:text-xl p-1 h-10 w-2/3 hover:bg-blue-700 hover:text-blue-00 text-white font-bold rounded-md text-center"
                    name="btnEditUser" id="btnEditUser">
                    Enregistrer
                </button>
            </div>
            <div class="w-full">
                <button type="button" onclick="closeEditUser()"
                    class="bg-gray-500 sm:text-xs xl:text-xl p-1 h-10 w-2/3 hover:bg-gray-700 text-white font-bold rounded-md text-center">
                    <a href="">Retour</a>
                </button>
            </div>
        </div>
    </div>
</form>
    </div>
<!-- end Form Edit user -->

    <!-- fin Contenu personnalisé -->
    </div>
        <!--fin Contenu personnalisé -->
</div>


    <script src="./../../../assets/js/DirectorHead.js"></script>
    <script src="./../../../assets/js/EditUserdirectorHead.js" defer></script>
   <script>
    function openDeleteModal(button) {
     const deleteID = button.getAttribute('data-nom_1');
    document.getElementById('deleteID').value=deleteID;  
    document.getElementById('deleteModal').classList.toggle('hidden');

}
   </script>
  
   
</body>
</html>
