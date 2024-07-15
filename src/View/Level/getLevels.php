<?php session_start();


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\LevelsController;

(new LevelsController())->getLevel();

/**
 * @var array<\App\Entity\Level> $levels
 * @var string<\App\Controller\LevelsController> $flasMessage  

 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des niveaux d'étude</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../../../assets/css/animationGetLevel.css">
    <!-- add js files -->

</head>

<body class="bg-gray-300">

    <div class="container mx-auto px-4 py-8">
        <?php if (isset($auth_user)) { ?>
            <span id="flashConnxion"
                class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                onclick="closeFlashConnexion()"> <?= ($auth_user) ?></span>
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
                                <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $level->getGradeLevel() ?></td>
                                <td <?php if ((htmlspecialchars($level->getAvailabilities())) == 'ouvert') {
                                    echo 'class="py-2 px-4 border-b border-gray-200 text-center text-green-500 " ';
                                } else {
                                    echo 'class="py-2 px-4 border-b border-gray-200 text-center text-red-500" ';
                                } ?> ?>
                                    <?= htmlspecialchars($level->getAvailabilities()) ?>
                                </td>

                                <td class="py-1 px-1 border-b border-gray-200 text-center">


                                    <?php if ((htmlspecialchars($level->getAvailabilities())) == 'ouvert') { ?>
                                        <button type="button" class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded"
                                            onclick="openLevel(<?= $level->getId() ?>,'<?= $level->getAvailabilities() ?>')">Fermer</button>
                                    <?php } else { ?>
                                        <button type="button" class="bg-green-400 hover:bg-green-500 text-white px-3 py-1 rounded"
                                            onclick="openLevel( <?= $level->getId() ?>,'<?= $level->getAvailabilities() ?>')">Ouvrir</button>
                                    <?php } ?>

                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class=" bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto">Aucun niveau
                disponible.</p>
        <?php } ?>
    </div>

    <script>

        function openLevel(level_id, otherVariable) {
            if (confirm("Voulez-vous vraiment modifier ce niveau ?")) {
                var xmlhttp = new XMLHttpRequest();
                var url = "http://localhost/training-manager/src/View/Level/updateLevel.php";

                /* Paramètres POST */
                var params = "ajax=1&id=" + level_id + "&othervar=" + otherVariable;
                document.getElementById('response').innerHTML = `
                <div class="flex flex-col items-center">
                    <div id="spinner" class="spinner mb-2"></div>
                    <p class="text-gray-500">Traitement en cours veuillez patienter...</p>
                </div>
                `;

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4) {
                        if (xmlhttp.status == 200) {
                            
                                var responseObject = JSON.parse(xmlhttp.responseText);
                                /* Lecture des données */
                                var message = responseObject.message; /* Objet message */
                                var levelData = responseObject.data; /* Objet data */
                                var levelDescription = responseObject.data.description;
                                var responseElement = document.getElementById("response");
                                if(message=='succes'){
                                    
                                }
                                switch (message){
                                    case 'succes':
                                        responseElement.textContent = responseObject.data.succes;
                                        responseElement.classList.add('text-green-500');
                                        break;
                                    case 'error':
                                        responseElement.textContent = responseObject.data.error;
                                        responseElement.classList.remove('text-green-500');
                                        responseElement.classList.add('text-red-500');
                                        break; 
                                    case 'invalidparameters':
                                        responseElement.textContent = responseObject.data.invalidparameters;
                                        responseElement.classList.remove('text-green-500');
                                        responseElement.classList.add('text-red-500');
                                        break; 
                                    case 'invalidrequest':
                                        responseElement.textContent = responseObject.data.invalidrequest;
                                        responseElement.classList.remove('text-green-500');
                                        responseElement.classList.add('text-red-500');
                                        break;         
                                    default:
                                    responseElement.textContent = responseObject.data.error;  
                                    responseElement.classList.remove('text-green-500');
                                        responseElement.classList.add('text-red-500');
                                    break;
                                }
                               location.reload();
                           
                        } else {
                            /* Gestion de l'erreur HTTP */
                            var responseElement = document.getElementById("response");
                            responseElement.textContent = "Erreur HTTP : " + xmlhttp.status;
                        }
                    }
                };

                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(params);
            }
        }


    </script>
</body>

</html>