<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\RegistrationController;
use App\Entity\Level;
use App\Entity\Training;

(new RegistrationController())->updateStudent();
if (!($_SESSION['ArrayAuth'])) {

    header("location: ./../Users/signin.php");
}
/** 

 * @var array<\App\Entity\Level> $levels 
 * @var array<\App\Entity\Training>  $newTrainingsForStudent
 * @var string<\App\Controller\TrainingsController> $flasMessage  
 * @var array<\App\Entity\Sessions> $sessionsProject  
 */

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
                <li><a href="./../Student/getStudent.php"
                        class="block p-2 hover:bg-blue-800 hover:text-white  rounded"><i class="fas fa-eye px-2"></i>
                        voir
                        les Étudiants</a></li>
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
            <div class="flex-1 z-10  w-full m-auto">
                <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
                    <span id="flashConnxion"
                        class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white  items-center justify-center  m-auto"
                        onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] . ', vous ete connecter' ?></span>
                <?php } ?>

                <span id="flashMessage" class="mt-4 flex place-items-center text-red-500"><?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                }
                if (isset($_SESSION['flashMessage'])) {
                    unset($_SESSION['flashMessage']);
                } ?>
                </span>

                <!-- form update student start-->

                <div
                    class="w-full flex-1 relative z-10 sm:w-full md:w-2/3 lg:w-2/3 p-8 bg-white rounded-lg shadow-lg overflow-auto">

                    <h2 class="text-2xl font-bold mb-6 text-blue-600">Formulaire de modification d'étudiant</h2>
                    <form class="" id="formEditStudent" method="post" enctype="multipart/form-data">
                        <!-- error Partie1 -->
                        <span id="partie1Error" class="text-red-500 text-sm"></span>
                        <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 1: information personnelle</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Text Input 1 -->
                            <div class="mb-4">
                                <!--  -->
                                <input type="text" name="idStud" value=" <?php if (isset($_SESSION['idStudent'])) {
                                    echo $_SESSION['idStudent'];
                                } ?>">
                                <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                                <input required type="text" id="nom" name="nom" value=" <?php if (isset($_SESSION['nomStudent'])) {
                                    echo $_SESSION['nomStudent'];
                                } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="nom">
                                <span id="nomError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Text Input 2 -->
                            <div class="mb-4">
                                <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                                <input required type="text" id="prenom" name="prenom" value="<?php if (isset($_SESSION['prenomStudent'])) {
                                    echo $_SESSION['prenomStudent'];
                                } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="prénom">
                                <span id="prenomError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="adressEmail"
                                    class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input required type="email" id="adressEmail" name="adressEmail" value="<?php if (isset($_SESSION['emailStudent'])) {
                                    echo $_SESSION['emailStudent'];
                                } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Email">
                                <span id="emailError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Number Input -->
                            <div class="mb-4">
                                <label for="numeroTelephone" class="block text-gray-700 text-sm font-bold mb-2">Numéro
                                    de téléphone:</label>
                                <input required type="number" id="numeroTelephone" name="numeroTelephone" value="<?php if (isset($_SESSION['telephoneStudent'])) {
                                    echo $_SESSION['telephoneStudent'];
                                } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Numero telephone ">
                                <span id="numeroTelephoneError" class="text-red-500 text-sm"></span>
                            </div>

                            <!-- Date Input -->
                            <div class="mb-4">
                                <label for="dateNaissance" class="block text-gray-700 text-sm font-bold mb-2">Date de
                                    naissance:</label>
                                <input type="date" id="dateNaissance" name="dateNaissance"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <span id="dateNaissanceError" class="text-red-500 text-sm"> </span>
                            </div>
                            <!-- File Input -->
                            <div class="mb-4">
                                <label for="photoEtudiant"
                                    class="block text-gray-700 text-sm font-bold mb-2">Photo:</label>
                                <input type="file" id="photoEtudiant" name="photoEtudiant"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- matricule -->
                            <div class="mb-4">
                                <label for="matrictule"
                                    class="block text-gray-700 text-sm font-bold mb-2">matrictule:</label>
                                <input type="text" id="matrictule" name="matrictule" value="<?php if (isset($_SESSION['matricule'])) {
                                    echo $_SESSION['matricule'];
                                } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                        </div>
                        <!-- document -->
                        <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 2: choix d'un nouveau document</h2>
                        <!-- ERROR PARTIE 2 -->
                        <span id="partie2Error" class="text-red-500 text-sm"></span>
                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- cni File  -->
                            <div class="mb-4">
                                <label for="cniEtudiant" class="block text-gray-700 text-sm font-bold mb-2">CNI:</label>
                                <input type="file" id="cniEtudiant" name="cniEtudiant"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- bith certificate File  -->
                            <div class="mb-4">
                                <label for="birthCertificate" class="block text-gray-700 text-sm font-bold mb-2">Acte de
                                    naissance:</label>
                                <input type="file" id="birthCertificate" name="birthCertificate"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- diplome certificate File  -->
                            <div class="mb-4">
                                <label for="entranceDegree" class="block text-gray-700 text-sm font-bold mb-2">Diplome
                                    d'entrée:</label>
                                <input type="file" id="entranceDegree" name="entranceDegree"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- name of diploma Input -->
                            <div class="mb-4">
                                <label for="nomDiplome" class="block text-gray-700 text-sm font-bold mb-2">Nom du
                                    diplome
                                    :</label>
                                <input required type="text" id="nomDiplome" name="nomDiplome" value="<?php if (isset($_SESSION['nomDiplome'])) {
                                    echo $_SESSION['nomDiplome'];
                                } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="nom du diplome">
                                <span id="nomDiplomeError" class="text-red-500 text-sm"></span>
                            </div>
                            <?php if (isset($_SESSION['ArrayAuth'])): ?>
                                <input required type="hidden" id="createBy" name="createBy"
                                    value="<?php echo $_SESSION['ArrayAuth'][1]; ?>" class="">
                            <?php endif; ?>
                        </div>
                        <span id="totalError" class="text-red-500 text-sm"></span>                       
                        
                            <?php  if (isset($_SESSION['newTrainingsForStudent']) && is_array($_SESSION['newTrainingsForStudent']) && !empty($_SESSION['newTrainingsForStudent'])) { 
                               ?>  <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 3: ajout d'une/des nouvelle(s)
                                 formation(s) et
                                 niveau(x)</h2>
                                 <?php foreach ($_SESSION['newTrainingsForStudent'] as $training) { ?>
        <div class="space-x-4">
            <label class="block text-gray-700 text-md font-bold mb-2 uppercase">
                <?= htmlspecialchars($training->getDescriptions()) ?> (<?= htmlspecialchars($training->getCode()) ?>):
                <input type="checkbox" class="trainingCheckbox" name="training[]" value="<?= htmlspecialchars($training->getId()) ?>">
            </label>
            <div class="">
                <?php 
                    $level = explode(',', htmlspecialchars($training->getLevel_id()));
                    $levelName = explode(',', htmlspecialchars($training->getLevelName()));
                    $levelId_AndName = array_combine($level, $levelName);
                ?>
                <select name="level[<?= htmlspecialchars($training->getId()) ?>]" class="block w-1/3 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <?php foreach ($levelId_AndName as $Id => $name) { ?>
                        <option value="<?= htmlspecialchars($Id) ?>"><?= htmlspecialchars($name) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <?php } ?>

                            <?php } else{?>
                                <h2 class="text-md font-bold mb-6 text-red-400">Deja inscrire a toutes les formations oubien les formations
                                 auquel l'etudiant n'est pas inscrite sont actuelement fermer.</h2>
                                <?php     } ?>
                       
                        <div class="flex py-2 justify-between ">
                            <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 4: Changer le role
                            </h2>

                            <?php if (isset($roles) && is_array($roles)) {?>

                                <select name="idRole" class="py-1 px-2  bg-blue-500 text-white hover:bg-blue-500 rounded">

                                    <?php foreach ($roles as $rol): ?>

                                        <option value="<?= $rol->getId() ?>">
                                            <?= htmlspecialchars($rol->getRole()); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            <?php } ?>
                        </div>


                        <div class="flex justify-between align-items-center space-x-4">
                            <button type="submit" name="btnEditStudent" id="btnEditStudent"
                                class="w-1/3 bg-blue-600 text-white p-2 text-center rounded-md shadow-sm hover:bg-blue-700 focus:outline-none">Enregistrer</button>
                            <a href="./getStudent.php"
                                class="w-1/3 bg-gray-500 text-white p-2 text-center rounded-md shadow-sm hover:bg-gray-600 focus:outline-none">Annuler</a>
                        </div>
                    </form>
                </div>
                <!-- form registration student end -->

            </div>




            <!-- fin Contenu personnalisé -->
        </div>
        <!--fin Contenu personnalisé -->
    </div>


    <script src="./../../../assets/js/DirectorHead.js"></script>
    <script src="./../../../assets/js/formEditStudent.js"></script>

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
    <!-- change role of student -->
    <script>
        function openFormChangeROle(idStudent) {
            document.getElementById('btnChangerRole').classList.add('hidden');
            document.getElementById('idUser').value = idStudent;
            document.getElementById('formChangeRole').classList.remove('hidden');

        }
        function closeFormChangerRole() {
            document.getElementById('formChangeRole').classList.add('hidden');
            document.getElementById('btnChangerRole').classList.remove('hidden');
        }
    </script>


</body>

</html>