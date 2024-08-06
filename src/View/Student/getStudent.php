<?php session_start();

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\RegistrationController;

(new RegistrationController())->getStudent();

/**
 * @var array<\App\Entity\User> $students
 * @var array<\App\Entity\User> $roles
 * @var array<\App\Controller\UsersController> $auth_user   
 * @var array<\App\Entity\User> $auth
 */

if (!($_SESSION['ArrayAuth'])) {

    header("location: ./../Users/signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Logo -->
    <div class="absolute inset-0 z-0">
        <img src="./../../../assets/img/logo1.png" alt="Logo Leader" class="ml-0 p-0 h-1/12 w-1/12 object-contain">
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
                <button class="text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500" onclick="menuProfil()"><i
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
                        class=" w-full text-blue-700 font-bold rounded p-2 m-0 hover:bg-blue-800 hover:text-white hover:underline">
                        <i class="fas fa-home px-2"></i> Accueil
                    </h1>
                </a>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-calendar-alt px-2"></i> Évenements</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-graduation-cap px-2"></i> Formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i class="fas fa-user px-2"></i>
                    Utilisateurs
                </h1>
                <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded "><i
                            class="fas fa-plus px-2"></i> Ajouter</a></li>
                <li><a href="./../Users/directorHead.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-eye px-2 px-2"></i>
                        voir les
                        Utilisateurs</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0  "><i class="fas fa-graduation-cap px-2"></i>
                    Formation</h1>
                <li><a href="./../Trainings/addTrainings.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-plus px-2"></i>
                        ajouter</a></li>
                <li><a href="./../Trainings/getTrainings.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-eye px-2"></i>
                        voir les
                        formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="bg-white text-blue-700 font-bold w-full rounded p-1 m-0 "><i
                        class="fas fa-graduation-cap px-2"></i> Niveau</h1>
                <li><a href="./../Level/addLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i> ajouter</a></li>
                <li><a href="./../Level/getLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-eye px-2"></i> voir les Niveaux</a></li>
            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0  "><i
                        class="fas fa-graduation-cap px-2"></i></i>
                    Etudiant</h1>
                <li><a href="./../Student/addStudent.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white  rounded"><i class="fas fa-plus px-2"></i>
                        ajouter</a></li>
               
            </ul>
            <hr>
            <ul>
                <h1 class="w-full rounded p-1 m-0 text-blue-700 font-bold "><i class="fas fa-calendar-alt px-2"></i>
                    Évenements</h1>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white  rounded"><i
                            class="fas fa-plus px-2"></i> ajouter</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white  rounded"><i
                            class="fas fa-eye px-2"></i>
                        voir les
                        Évenements</a></li>
            </ul>
        </div>

        <!--debut Contenu personnalisé -->
        <div class="flex bg-gray-200 p-4 w-full">
            <!-- debutContenu personnalisé -->



            <!--menu profi user  -->
            <div id="profileUser"
                class="menuProfil absolute right-0 hidden bg-white top-0 z-10 flex-1 rounded shadow-lg w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/5 text-gray-700 ">
                <div class="">
                    <a class="m-0 block capitalize rounded hover:text-white p-2 w-full hover:bg-gray-400" href="#">mon
                        compte</a>
                    <hr>
                    <a class="m-0 block capitalize rounded hover:text-white p-2 w-full hover:bg-gray-400" href="#">mon
                        compte</a>
                    <hr>
                    <a class="m-0 block capitalize rounded hover:text-white p-2 w-full hover:bg-gray-400" href="#">mon
                        compte</a>
                    <hr>
                    <a class="m-0 block capitalize rounded hover:text-white p-2 w-full hover:bg-gray-400" href="#">mon
                        compte</a>
                    <hr>
                    <a class="m-0 block capitalize rounded hover:text-white p-2 w-full hover:bg-gray-400"
                        href="#">paramettre</a>
                    <hr>
                    <a class="m-0 block capitalize rounded hover:text-white p-2 w-full hover:bg-gray-400" href="#">
                        Sign Out</a>
                    <hr>
                    <button onclick="quitterMenuProfil()"
                        class="m-0 block capitalize p-2 font-bold rounded hover:text-white p-2 w-full hover:bg-blue-500">
                        quitter</button>
                    <hr>

                </div>
            </div>

            <!-- pour le resulat de la requete -->
            <!-- list of users -->
            <div class="flex-1 z-10  w-full overflow-auto">
                <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
                    <span id="flashConnxion"
                        class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white  items-center justify-center  m-auto"
                        onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] . ', vous ete connecter' ?></span>
                <?php } ?>

                <span id="flashMessage" class="mt-4 flex place-items-center text-red-500"><?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                } ?>
            
                </span>
                <?php if (isset($students) && is_array($students) && (!empty($students))) { ?>
                    <div class="pagination w-full flex justify-between ">
                        <?php if ($page > 1): ?>
                            <!-- Lien vers la page précédente -->
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <a href="?page=<?= $page - 1 ?>" class="w-full h-full block">Précédent</a>
                            </button>
                        <?php else: ?>

                        <?php endif; ?>

                        <?php if ($page < $totalPages): ?>
                            <!-- Lien vers la page suivante -->
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <a href="?page=<?= $page + 1 ?>" class="w-full h-full block">Suivant</a>
                            </button>
                        <?php else: ?>
                            <div></div>
                        <?php endif; ?>
                    </div>

                    <table class="w-full flex-1 overflow-auto">
                        <h2 class="text-2xl font-bold  p-4 mt-16  mx-auto "><?= $studentsList ?> </h2>
                        <div class="text-blue-500 underline">Page :<?= $page ?></div>
                        <thead>
                            <tr class="bg-blue-700">

                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Photo</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Nom</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Prenom</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Numéro de téléphone</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    role</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Filiere-Niveau</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Matricule</th>
                                <th
                                    class="text-center py-2 px-4 border-b-2 border-gray-200 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                    Action</th>
                      
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($students as $student): ?>
                                <tr class="text-sm">
                                    <td class="py-2 px-4  border-b border-gray-200 text-center">
                                        <img src="<?php echo USERS_IMG_PATH.$student->getPhoto_user() ?> "
                                            alt=" <?= 'photo de :' . htmlspecialchars($student->getFirst_name()) ?>"
                                            class="w-12 h-12 rounded-full object-contain">
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <?= htmlspecialchars($student->getFirst_name()) ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <?= htmlspecialchars($student->getName()) ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <?php 
                                       echo wordwrap(htmlspecialchars($student->getMail()), 15, "<br>", true);
                                        ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <?= htmlspecialchars($student->getPhone_number()) ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <?= htmlspecialchars($student->getRole()) ?>
                                    </td>

                                    <td>
                                        <select class="py-2 px-4 border-b border-gray-200">
                                            <?php
                                            // Séparer les données 'trainingsWithLevels' en utilisant la virgule comme délimiteur
                                            $trainingsWithLevels = explode(', ', $student->getTrainingwithLevel());

                                            // Parcourir les niveaux et les formations et les afficher comme options
                                            foreach ($trainingsWithLevels as $entry): ?>
                                                <option><?= htmlspecialchars($entry) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>

                                        <select class="py-2 px-4 border-b border-gray-200">
                                            <?php
                                            $matricule = explode('+', $student->getRegistration_number());
                                            foreach ($matricule as $oneMatricule): ?>
                                                <option><?= htmlspecialchars($oneMatricule) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="p-4 border-b border-gray-200 flex justify-between items-center">
                                        
                                    
                                        
                                        <button type="button" name="btnEditGetStudent" class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded">
                                        <?php $TabInfoSdudent1=htmlspecialchars($student->getId()).','.htmlspecialchars($student->getFirst_name()).','.htmlspecialchars($student->getName()).','.htmlspecialchars($student->getMail()).','.htmlspecialchars($student->getPhone_number()).','.htmlspecialchars($student->getNomdiplome()).','.htmlspecialchars($student->getRole()).','.$student->getRegistration_number(); ?>
                                            <a href="updateStudent.php?tabInfoSdudent=<?php echo$TabInfoSdudent1?>"><i class="fas fa-user-edit "></i></a>
                                        </button>
                                       
                                        <!-- delete modal -->
                                        <div id="deleteModalStudent"
                                            class="absolute p-4 rounded-lg bg-red-200 flex flex-col items-center justify-center h-1/3 w-1/4 lg:w-2/5 m-auto fixed z-10 inset-0 overflow-y-auto hidden">
                                            <form class="w-full flex flex-col items-center" method="post"
                                                action="deleteStudent.php">
                                                <h3 class="text-center mb-4">Voulez-vous supprimer <span id="DeleteNom"
                                                        class="font-bold"> </span>?</h3>
                                                <div class="mb-4 w-full">
                                                    <?php if (isset($_SESSION['ArrayAuth'])): ?>
                                                        <input  type="hidden" id="deletedU" name="deletedU"
                                                            value="<?php echo $_SESSION['ArrayAuth'][0] . ' ' . $_SESSION['ArrayAuth'][1]; ?>"
                                                            class="">
                                                    <?php endif; ?>
                                                    <input type="hidden" id="idStudent" name="idStudent"
                                                        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        value="<?= $student->getId() ?>">
                                                </div>
                                                <div class="flex space-x-2">
                                                    <button type="submit"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline"
                                                        name="btnDeleteUser">Confirmer</button>
                                                    <button type="button" id="closeModalButton"
                                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Quitter</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--end delete modal -->
                                        <button class="bg-red-300 hover:bg-red-400 text-white px-3 py-1 rounded"
                                            onclick="openDeleteModalStudent(<?= $student->getId() ?>)"><i class="fa fa-trash"
                                                aria-hidden="true"></i>
                                        </button>
                                    </td>
                                
                                </tr>
                            <?php endforeach;

                } else { ?>
                        </tbody>
                    </table>
                    <p class="text-blue-500  w-full p-2 rounded text-white flex items-center justify-center mx-auto">
                        Aucun étudiant
                        trouvé.</p>
                <?php } ?>

            </div>



            <?php   if (isset($_SESSION['flashMessage'])) {
                    unset($_SESSION['flashMessage']);
                } ?>
            <!-- fin Contenu personnalisé -->
        </div>
        <!--fin Contenu personnalisé -->
    </div>


    <script src="./../../../assets/js/DirectorHead.js"></script>
    <script src="./../../../assets/js/EditUserdirectorHead.js" defer></script>
    <script>
        function openDeleteModalStudent(idStudent) {

            document.getElementById('idStudent').value = idStudent;
            document.getElementById('deleteModalStudent').classList.toggle('hidden');

        }
        document.getElementById('deleteModalStudent').addEventListener('click', () => {
            document.getElementById('deleteModalStudent').classList.add('hidden');
        });

    </script>
    <script>
        /* menu profil user */
        /* menu profil user */
        function menuProfil() {
            const dropdown = document.getElementById('profileUser');
            dropdown.classList.toggle('hidden');
        }
        function quitterMenuProfil() {
            const dropdown = document.getElementById('profileUser');
            dropdown.classList.toggle('hidden');
        }
    </script>
  


</body>

</html>