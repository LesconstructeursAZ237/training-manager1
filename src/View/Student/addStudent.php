<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\RegistrationController;

(new RegistrationController())->addStudent();

/**
 * @var string<\App\Controller\UsersController> $auth_user 
 * @var array<\App\Entity\Level> $levels
 * @var string<\App\Controller\TrainingsController> $flasMessage  

 */

 if(!($_SESSION['ArrayAuth'])){  

    header("location: ./../Users/signin.php");
    } 
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
        <img src="./../../../assets/img/logo1.png" alt="Logo" class="ml-0 p-0 h-1/12 w-1/12 object-contain">
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
                <button class="text-white hover:bg-blue-400 p-2 rounded"><i class="fas fa-home px-2"></i>Accueil</button>
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
                <button id="btnOpenVerticalMenu" onclick="openVerticalMenu()"
                    class="lg:hidden text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500"><i
                        class="fas fa-align-justify px-2"></i>Menu</button>
            </div>
        </div>


    </nav>


    <div class="flex flex-col md:flex-row h-full ">
        <!-- Menu vertical à gauche -->
        <div id="verticalMenu"
            class="hidden md:block  sm:w-1/3 md:w-1/5 hidden bg-white opacity-90 text-black p-4 overflow-auto top-2/12">
            <ul>
                <a href="./../Users/Aindex.php">
                    <h1 class="w-full text-blue-700 font-bold rounded p-2 m-0 hover:bg-blue-800 hover:text-white hover:underline"> <i class="fas fa-home px-2"></i> Accueil</h1>
                </a>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i class="fas fa-calendar-alt px-2"></i> Évenements</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i class="fas fa-graduation-cap px-2"></i> Formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i class="fas fa-user px-2"></i> Utilisateurs</h1>
                <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-user-plus px-2"></i> ajouter</a></li>
                <li><a href="./../Users/directorHead.php" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-user px-2"></i> voir les Utilisateurs</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0  "><i
                class="fas fa-graduation-cap px-2"></i> Formation</h1>
                <li><a href="./../Trainings/getTrainings.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"> voir les
                        formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0  "><i
                class="fas fa-graduation-cap px-2"></i> Niveau</h1>
                <li><a href="./../Level/addLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                class="fas fas fa-plus px-2"></i> ajouter</a></li>
                <li><a href="./../Level/getLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                class="fas fas fa-eye px-2"></i> voir les Niveaux</a>
                </li>
            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0  "><i
                class="fas fa-calendar-alt px-2"></i>Évenements</h1>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                class="fas fas fa-plus px-2"></i> ajouter</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white rounded"> <i
                class="fas fas fa-eye px-2"></i>voir les Évenements</a></li>
            </ul>
        </div>

        <!-- Contenu personnalisé  -->
        <div class="flex-1 bg-gray-200 p-4">

            <div class="flex-1">
                <div flex-1>
                    <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
                        <span id="flashConnxion"
                            class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                            onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] ?> <span class="text-sm">, vous
                                etes connecter!</span></span>
                    <?php } ?>
                </div>
                <!-- form registration student start-->

                <div
                    class="w-full flex-1 relative z-10 sm:w-full md:w-2/3 lg:w-2/3 p-8 bg-white rounded-lg shadow-lg overflow-auto">

                    <h2 class="text-2xl font-bold mb-6 text-blue-600">Formulaire d'inscription d'étudiant a une
                        formation</h2>
                    <form class="" id="formAddStudent" method="post" enctype="multipart/form-data">
                        <!-- error Partie1 -->
                        <span id="partie1Error" class="text-red-500 text-sm"></span>
                        <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 1: Identification</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Text Input 1 -->
                            <div class="mb-4">
                                <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                                <input required  type="text" id="nom" name="nom"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="nom">
                                <span id="nomError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Text Input 2 -->
                            <div class="mb-4">
                                <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                                <input required  type="text" id="prenom" name="prenom"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="prénom">
                                <span id="prenomError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="adressEmail"
                                    class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input required type="email" id="adressEmail" name="adressEmail"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Email">
                                <span id="emailError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Number Input -->
                            <div class="mb-4">
                                <label for="numeroTelephone" class="block text-gray-700 text-sm font-bold mb-2">Numéro
                                    de téléphone:</label>
                                <input required type="number" id="numeroTelephone" name="numeroTelephone"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Numero telephone ">
                                <span id="numeroTelephoneError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- password Input -->
                            <div class="mb-4">
                                <label for="pwd" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe
                                    :</label>
                                <input required type="password" id="pwdStudent" name="pwdStudent"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="mot de passe">
                                <span id="pwdStudentError" class="text-red-500 text-sm"></span>
                            </div>
                            <!-- Date Input -->
                            <div class="mb-4">
                                <label for="dateNaissance" class="block text-gray-700 text-sm font-bold mb-2">Date de
                                    naissance:</label>
                                <input  required type="date" id="dateNaissance" name="dateNaissance"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <span id="dateNaissanceError" class="text-red-500 text-sm"> </span>
                            </div>
                            <!-- File Input -->
                            <div class="mb-4">
                                <label for="photoEtudiant"
                                    class="block text-gray-700 text-sm font-bold mb-2">Photo:</label>
                                <input required type="file" id="photoEtudiant" name="photoEtudiant"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                        </div>
                        <!-- document -->
                        <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 2: Document requis</h2>
                        <!-- ERROR PARTIE 2 -->
                        <span id="partie2Error" class="text-red-500 text-sm"></span>
                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- cni File  -->
                            <div class="mb-4">
                                <label for="cniEtudiant" class="block text-gray-700 text-sm font-bold mb-2">CNI:</label>
                                <input required type="file" id="cniEtudiant" name="cniEtudiant"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- bith certificate File  -->
                            <div class="mb-4">
                                <label for="birthCertificate" class="block text-gray-700 text-sm font-bold mb-2">Acte de
                                    naissance:</label>
                                <input required type="file" id="birthCertificate" name="birthCertificate"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- diplome certificate File  -->
                            <div class="mb-4">
                                <label for="entranceDegree" class="block text-gray-700 text-sm font-bold mb-2">Diplome
                                    d'entrée:</label>
                                <input required type="file" id="entranceDegree" name="entranceDegree"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                              <!-- name of diploma Input -->
                            <div class="mb-4">
                                <label for="nomDiplome" class="block text-gray-700 text-sm font-bold mb-2">Nom du diplome
                                    :</label>
                                <input required type="text" id="nomDiplome" name="nomDiplome"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="nom du diplome">
                                <span id="nomDiplomeError" class="text-red-500 text-sm"></span>
                            </div>
                            <?php if (isset($_SESSION['ArrayAuth'])): ?>
                    <input required type="hidden" id="createBy" name="createBy"
                        value="<?php echo $_SESSION['ArrayAuth'][1]; ?>"
                        class="">
                <?php endif; ?>
                        </div>
                        <span id="totalError" class="text-red-500 text-sm"></span>
                        <h2 class="text-lg font-bold mb-6 text-blue-500">Partie 3: Choix de la/des formation(s) et
                            niveau(x)</h2>


                        <?php if (isset($trainings) && is_array($trainings) && !empty($trainings)) { ?>

                            <?php foreach ($trainings as $index => $training) { ?>
                                <div class="flex space-x-4">
                                    <label class="block text-gray-700 text-md font-bold mb-2 uppercase">
                                        <?= $training->getDescriptions() ?> (<?= $training->getCode() ?>):
                                        <input type="checkbox" id="training-<?= $index ?>" class="training-checkbox mr-2"
                                            name="training[<?= $index ?>]" value="<?= $training->getId() ?>">
                                    </label>
                                </div>

                                <?php
                           
                                ?>

                                <span id="partie3Error" class="text-red-500 text-sm"></span>
                                <div class="overflow-x-auto">
                                    <div class="flex space-x-4">
                                        <?php foreach ($training->getLevel() as $levelIndex => $levelName) { ?>
                                            <div class="flex items-center">
                                                <input type="checkbox" id="level-<?= $index ?>-<?= $levelIndex ?>"
                                                    class="level-checkbox training-<?= $index ?>-level-checkbox mr-2"
                                                    name="level[<?= $index ?>][<?= $levelIndex ?>]" value="<?=  $levelIndex ?>">
                                                <label for="level-<?= $index ?>-<?= $levelIndex ?>"
                                                    class="text-gray-700"><?= htmlspecialchars($levelName)?> </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>

                        <div class="flex justify-between align-items-center space-x-4">
                            <button type="submit" name="btnAddStudent" id="btnAddStudent"
                                class="w-1/3 bg-blue-600 text-white p-2 text-center rounded-md shadow-sm hover:bg-blue-700 focus:outline-none">Enregistrer</button>
                            <a href="./../Users/directorHead.php"
                                class="w-1/3 bg-gray-500 text-white p-2 text-center rounded-md shadow-sm hover:bg-gray-600 focus:outline-none">Annuler</a>
                        </div>
                    </form>
                </div>
                <!-- form registration student end -->

            </div>
        </div>


        <script src="./../../../assets/js/DirectorHead.js"></script>
        <script src="./../../../assets/js/formAddStudent.js"></script>



</body>

</html>