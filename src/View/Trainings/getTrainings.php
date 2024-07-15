<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\TrainingsController;

(new TrainingsController())->getTrainings();

/**

 * @var array<\App\Entity\Training> $trainings
 * @var string<\App\Controller\TrainingsController> $flasMessage  

 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des formations liés aux niveaux d'études</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- add js files -->
    <script src="./../../../assets/js/getTrainings.js" defer></script>

</head>

<body class="bg-gray-300">

    <!-- pour le resulat de la requete -->
    <span id="flashMessage" class="mt-4 flex items-center justify-center text-red-500"><?php
    if (isset($flashMessage)) {
        echo ($flashMessage);
    }
    if (isset($_SESSION['flashMessage'])) {
        unset($_SESSION['flashMessage']);
    } ?>
    </span>

    <div class="container mx-auto px-4 py-8">
        <?php if (isset($auth_user)) { ?>
            <span id="flashConnxion"
                class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                onclick="closeFlashConnexion()"> <?= ($auth_user) ?></span>
        <?php } ?>

        <?php if (isset($trainings) && is_array($trainings)) { ?>
            <span id="response" class="mt-4 flex items-center justify-center text-red-500"></span>
            <h2 class="text-2xl font-bold text-center p-4 mt-16"><?= $listTraining ?></h2>

            <div class="overflow-x-auto">
                <table class="w-4/5 bg-white mx-auto mb-8 text-sm">
                    <thead>
                        <tr>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                CODE</th>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Description</th>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Durée de Formation</th>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Nom du niveau</th>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Disponibilité</th>
                            <th
                                class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trainings as $training): ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $training->getId() ?></td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $training->getCode() ?></td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $training->getDescriptions() ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <?= $training->getDurations() . ' ans' ?></td>
                                <td <?php if ((htmlspecialchars($training->getLevelAvailabilities())) == 'ouvert') {
                                    echo 'class="py-2 px-4 border-b border-gray-200 text-center text-green-500 " ';
                                } else {
                                    echo 'class="py-2 px-4 border-b border-gray-200 text-center text-red-500" ';
                                } ?> ?>
                                    <?= htmlspecialchars($training->getLevelName()) ?>
                                </td>
                                <td <?php if ((htmlspecialchars($training->getLevelAvailabilities())) == 'ouvert') {
                                    echo 'class="py-2 px-4 border-b border-gray-200 text-center text-green-500 " ';
                                } else {
                                    echo 'class="py-2 px-4 border-b border-gray-200 text-center text-red-500" ';
                                } ?> ?>
                                    <?= htmlspecialchars($training->getLevelAvailabilities()) ?>
                                </td>

                                <td class="py-1 px-1 border-b border-gray-200 text-center">



                                    <button type="button" class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded"
                                    data-cod="<?= $training->getCode() ?>"
                                    data-descritp="<?= $training->getDescriptions() ?>"
                                    data-dure="<?= $training->getDurations() ?>"
                                    data-prix="<?= $training->getPrice() ?>"
                                        onclick="EditTraining(this)">Modifier</button>

                                    <?php if ((htmlspecialchars($training->getLevelAvailabilities())) == 'ouvert') { ?>

                                        <form action="updateTraining.php" method="post">
                                            <input type="text" class="hidden" name="levelName"
                                                value="<?= $training->getLevelName() ?>">
                                            <input type="text" class="hidden" name="actualDisponibility"
                                                value="<?= $training->getLevelAvailabilities() ?>">
                                            <button type="submit" name="closeLevel"
                                                class="bg-red-400 hover:bg-red-500  text-white px-3 py-1 rounded">Fermer</button>

                                        </form>

                                    <?php } else { ?>
                                        <form action="updateTraining.php" method="post">
                                            <input type="text" class="hidden" name="levelName"
                                                value="<?= $training->getLevelName() ?>">
                                            <input type="text" class="hidden" name="actualDisponibility"
                                                value="<?= $training->getLevelAvailabilities() ?>">
                                            <button type="submit" name="openLevel"
                                                class="bg-green-400 hover:bg-green-500  text-white px-3 py-1 rounded">Ouvrir</button>
                                        </form>
                                    <?php } ?>

                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="./../Users/dashboard.php"><button
                        class="bg-green-400 hover:bg-green-500  text-white px-3 py-1 rounded"> quiter</button></a>
            </div>
        <?php } else { ?>
            <p class=" bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto">Aucune formation
                disponible.</p>
        <?php } ?>
    </div>

    <!-- form update training -->
    <div id="openFormEditTraining" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md relative z-10 p-4 hidden m-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Formulaire de modification d'une formation</h2>
        <form id="EditTraining">
            <div class="grid grid-cols-2 gap-4">
                <button type="button" id="btnCode" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">code</button> 
                <div id="editCode" class="mb-4 hidden">
                    <label for="newCodes" class="block text-gray-700 text-sm font-bold mb-2">Nouveau code :</label>
                    <input type="text" id="newCodes" name="newCodes"
                        class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Nouveau code">
                </div>
                <button type="button" id="btnDescription"> description</button>
                <div  class="mb-4 hidden">
                    <label for="newDescriptions" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle Description
                        :</label>
                    <input type="text" id="newDescriptions" name="newDescriptions"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Nouvelle description">
                    <span id="error" class="text-red-500 text-sm"></span>
                </div>
                <button type="button" id="btnPrix">prix</button>
                <div class="mb-4 hidden ">
                    <label for="newPrices" class="block text-gray-700 text-sm font-bold mb-2">Nouveau prix :</label>
                    <input type="text" id="newPrices" name="newPrices"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Nouveau prix">
                </div>
                <button type="button" id="btnDuree">durée</button>
                <div class="mb-4 hidden">
                    <label for="newduree" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle Durée :</label>
                    <input type="text" id="newduree" name="newduree"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Nouvelle durée">
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="button" onclick="closeEditTrainingForm()"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Annuler
                </button>
            </div>
        </form>
    </div>


</body>

</html>