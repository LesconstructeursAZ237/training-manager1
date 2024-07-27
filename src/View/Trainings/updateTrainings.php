<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\TrainingsController;
use App\Entity\Level;

(new TrainingsController())->updateTraining();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des formations</title>
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
                        class="bg-blue-800 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none"><i
                            class="fas fa-search px-2"></i></button>
                </form>
            </div>

            <!-- Profile Button -->
            <div class="flex items-center space-x-4">
                <button class="text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500"><i
                        class="fas fa-user-cog"></i>Profil</button>
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
                    <h1 class="w-full text-blue-700 font-bold rounded p-2 m-0 hover:bg-blue-800 hover:text-white hover:underline "> <i
                            class="fas fa-home px-2"></i>Accueil</h1>
                </a>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-calendar-alt px-2"></i>Évenements</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800  hover:text-white rounded"><i
                            class="fas fa-graduation-cap px-2"></i>Formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i
                        class="fas fa-user px-2"></i>Utilisateurs</h1>
                <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i>Ajouter</a></li>
                <li><a href="./../Users/directorHead.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-eye px-2"></i>voir les Utilisateurs</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i
                        class="fas fa-graduation-cap px-2"></i>Formation</h1>
                <li><a href="addTrainings.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-plus px-2"></i>
                        ajouter</a></li>
            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded "><i
                        class="fas fa-graduation-cap px-2"></i>Niveau</h1>
                <li><a href="./../level/addLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-plus px-2"></i>ajouter</a></li>
                <li><a href="./../level/getLevels.php" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i
                            class="fas fa-eye px-2"></i>voir les Niveaux</a></li>
            </ul>
            <hr>
            <ul>
                <h1 class="text-blue-700 font-bold w-full rounded p-1 m-0 "><i
                        class="fas fa-calendar-alt px-2"></i>Évenements</h1>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-plus px-2"></i>ajouter</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800 hover:text-white rounded"><i class="fas fa-eye px-2"></i>voir les
                        Évenements</a></li>
            </ul>
        </div>

        <!-- Contenu personnalisé -->
        <div class="flex-1 bg-gray-200 p-4 relative z-10 ">

            <!-- pour le resulat de la requete -->
            <span id="flashMessage" class="mt-4 flex items-center justify-center text-white font-bold"><?php
            if (isset($_SESSION['flashMessage'])) {
                echo $_SESSION['flashMessage'];
            }
            if (isset($_SESSION['flashMessage'])) {
                unset($_SESSION['flashMessage']);
            } ?>
            </span>

            <div class="container mx-auto px-4 py-8">


                <!-- form update training -->

                <div id=""
                    class=" overflow-auto h-2/3 bg-white mt-20 p-8 rounded-lg shadow-md w-full max-w-md mx-auto fixed inset-0  items-center justify-center z-50 p-4">
                    <h2 class=" text-2xl font-bold mb-6 text-center">Formulaire de Modification d'une formation</h2>
                    <form id="EditTraining" method="post">
                    <span id="errorMessage" class="text-red-500 tex-sm overflow-auto"></span>
                        <div class="grid grid-cols-2 gap-4">
                            <div id="editCode" class="mb-4">
                                <label for="newCodes" class="block text-gray-700 text-sm font-bold mb-2">Nouveau code
                                    :</label>
                                
                                <input type="text" id="newCodes" name="newCodes"
                                    value="<?php if (isset($_SESSION['arrayTrainintg'])) {
                                        echo $_SESSION['arrayTrainintg'][1];
                                    } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Nouveau code">
                                <input type="hidden" id="TrainingID" name="TrainingID" value="<?php if (isset($_SESSION['arrayTrainintg'])) {
                                        echo $_SESSION['arrayTrainintg'][0];
                                    } ?>" class="h-10 hidden">
                            </div>

                            <div id="editDescript" class="mb-4">
                                <label for="newDescriptions" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle
                                    Description :</label>
                                <input type="text" id="newDescriptions" name="newDescriptions"
                                    value="<?php if (isset($_SESSION['arrayTrainintg'])) {
                                        echo $_SESSION['arrayTrainintg'][2];
                                    } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Nouvelle description">
                            </div>

                            <div id="editPrix" class="mb-4">
                                <label for="newPrices" class="block text-gray-700 text-sm font-bold mb-2">Nouveau prix
                                    :</label>
                                <input type="number" id="newPrices" name="newPrices"
                                    value="<?php if (isset($_SESSION['arrayTrainintg'])) {
                                        echo $_SESSION['arrayTrainintg'][4];
                                    } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Nouveau prix">
                            </div>

                            <div id="editDuree" class="mb-4">
                                <label for="newduree" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle Durée
                                    :</label>
                                <input type="number" id="newduree" name="newduree"
                                    value="<?php if (isset($_SESSION['arrayTrainintg'])) {
                                        echo $_SESSION['arrayTrainintg'][3];
                                    } ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Nouvelle durée">
                            </div>
                        </div>

                        <?php if (isset($_SESSION['ArrayAuth'])): ?>
                            <input type="text" id="modifiedVAL" name="modifiedVAL"
                                value="<?php echo $_SESSION['ArrayAuth'][0] . ' ' . $_SESSION['ArrayAuth'][1]; ?>"
                                class="hidden">
                        <?php endif; ?>

                        <div class="flex items-center justify-between m-2">
                            <?php if (isset($_SESSION['LevelsNotInTraining'])): ?>
                                <?php foreach ($_SESSION['LevelsNotInTraining'] as $val): ?>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="LevelsNotInTraining[]"
                                            value="<?php echo $val['_gradeLevel']; ?>"
                                            class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out">
                                        <span class="text-gray-900 font-medium"><?php echo $val['_gradeLevel']; ?></span>
                                    </label>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                        </div>

                        <div class="flex items-center justify-between m-2">
                            <button type="submit" name="btnUpdateTraining"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                            <button type="button"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                <i class="fas fa-times"></i> <a href="getTrainings.php">Annuler</a>
                            </button>
                        </div>
                     
                    </form>

                </div>
                <!-- end update modal -->


            </div>

            <!-- add js files -->

            <script src="./../../../assets/js/DirectorHead.js"></script>

            <script>
                /* input form update training */

                document.getElementById('EditTraining').addEventListener('submit', function (event) {
                    const Newcode = document.getElementById('newCodes').value;
                    const newDescriptions = document.getElementById('newDescriptions').value;
                    const newPrice = document.getElementById('newPrices').value;
                    const newDuree = document.getElementById('newduree').value;

                    const regexAlphabetic = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;
                    const regexNumber = /^[1-7]$/;
                    const regexPrix = /^[0-9]+$/;
                    const regexCodee = /^[A-Za-z]+$/;

                    let valid = true;
                    let errorMessage = '';

                    /* Validate code */
                    if (!regexCodee.test(Newcode) || Newcode.length < 2 || Newcode.length > 4) {
                        errorMessage += "Le champ code ne doit contenir que des caractères alphabétiques entre 2 à 4 caractères.\n";
                        valid = false;
                    }

                    /* Validate description */
                    if (!regexAlphabetic.test(newDescriptions) || newDescriptions.length < 12) {
                        errorMessage += "Le champ Description doit contenir uniquement des caractères alphabétiques d'au moins 12 caractères.\n";
                        valid = false;
                    }

                    /* Validate price */
                    if (!regexPrix.test(newPrice) || newPrice < 5000) {
                        errorMessage += "Le prix ne doit pas être inférieur à 5000.\n";
                        valid = false;
                    }

                    /* Validate duree */
                    if (!regexNumber.test(newDuree)) {
                        errorMessage += "Le champ Durée doit être un nombre entre 1 et 7.\n";
                        valid = false;
                    }

                    if (!valid) {
                        document.getElementById('errorMessage').textContent = errorMessage;
                        event.preventDefault();
                    }
                });


            </script>
</body>

</html>