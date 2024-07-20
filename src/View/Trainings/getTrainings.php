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
    <title>liste des formations</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

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
                <button id="btnOpenVerticalMenu" onclick="openVerticalMenu()"
                    class="lg:hidden text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500">Menu</button>
            </div>
        </div>


    </nav>


    <div class="flex flex-col md:flex-row h-full ">
        <!-- Menu vertical à gauche -->
        <div id="verticalMenu"
            class="hidden md:block  sm:w-1/3 md:w-1/5 hidden bg-blue-900 opacity-90 text-white p-4 overflow-auto top-2/12">
            <ul>
                <a href="./../Users/Aindex.php">
                    <h1 class="bg-blue-600 w-full rounded underline p-1 m-0 hover:bg-blue-800 "> <i class="fas fa-home"></i>Accueil</h1>
                </a>
                <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-calendar-alt"></i>Évenements</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-graduation-cap"></i>Formations</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-user"></i>Utilisateurs</h1>
            <li><a href="./../Users/addUser.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>Ajouter</a></li>
                <li><a href="./../Users/directorHead.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Utilisateurs</a></li>

            </ul>
            <hr>
            <ul>
                <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-graduation-cap"></i>Formation</h1>
                <li><a href="addTrainings.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>
                ajouter</a></li>
            </ul>
            <hr>
            <ul>
                <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-graduation-cap"></i>Niveau</h1>
                <li><a href="./../level/addLevels.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>ajouter</a></li>
                <li><a href="./../level/getLevels.php" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Niveaux</a></li>
            </ul>
            <hr>
            <ul>
                <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 "><i class="fas fa-calendar-alt"></i>Évenements</h1>
                <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-plus"></i>ajouter</a></li>
                <li><a href="#" class="block p-2 hover:bg-blue-800 rounded"><i class="fas fa-eye"></i>voir les Évenements</a></li>
            </ul>
        </div>

        <!-- Contenu personnalisé -->
        <div class="flex-1 bg-gray-200 p-4 relative z-10 ">

            <!-- pour le resulat de la requete -->
            <span id="flashMessage" class="mt-4 flex items-center justify-center text-white font-bold"><?php
        if(isset($_SESSION['flashMessage'])) {
            echo $_SESSION['flashMessage'];
        }
        if (isset($_SESSION['flashMessage'])) {
             unset($_SESSION['flashMessage']); 
            }?>
   </span>

            <div class="container mx-auto px-4 py-8">
            <?php if (isset($_SESSION['ArrayAuth']) && is_array($_SESSION['ArrayAuth'])) { ?>
            <span id="flashConnxion"
                class="hover:bg-blue-300 bg-blue-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto"
                onclick="closeFlashConnexion()"> <?= $_SESSION['ArrayAuth'][1] ?> <span class="text-sm">, vous etes connecter!</span></span>
        <?php } ?>

                <?php if (isset($trainings) && is_array($trainings)  &&  !empty($trainings)) { ?>
                    <span id="response" class="mt-4 flex items-center justify-center text-red-500"></span>
                    <h2 class="text-2xl font-bold text-center p-4 mt-16"><?= $listTraining ?><a
                            href="./../Users/directorHead.php"><button
                                class="bg-red-300 hover:bg-gray-500  text-white px-3 py-1 rounded"> Dashboard</button></a></h2>

                    <div class="overflow-x-auto">

                        <table class="w-4/5 bg-white mx-auto mb-8 text-sm">
                            <thead>
                                <tr>

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
                                        Prix</th>
                                    <th
                                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Nom du niveau</th>
                                    <th
                                        class="text-center py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody><?php if(isset($trainings) && is_array($trainings) && !empty($trainings)) {?>

                                
                                <?php foreach ($trainings as $training){ ?>
                                   
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $training->getCode() ?>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                                            <?= $training->getDescriptions() ?>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                                            <?= $training->getDurations() . ' ans' ?>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-center"><?= $training->getPrice() ?>
                                        </td>
                                        <td>
                                            <?php $listOfLevel= htmlspecialchars($training->getLevelName()); 
                                           
                                            $arrayLevel=explode(',', $listOfLevel);?>
                                            <select class=" py-1 px-3 rounded bg-gray-400 text-white">
              
                                          <?php  foreach ($arrayLevel as $level) { 
                                             $dispos=htmlspecialchars($training->getLevelAvailabilities());
                                            ?>
                                                <option class=" "><?= htmlspecialchars($level) ?></option>
                                            <?php } ?>
                                            </select>
                                           
                                        </td>
 
                                        <td class=" flex p-auto border-b border-gray-200 text-center justify-between items-center p-2">
                                            <button type="button"
                                                class="bg-blue-400 hover:bg-blue-500 text-white rounded p-1"
                                                data-trainingvaleur="<?= $training->getId() ?>"
                                                data-cod="<?= $training->getCode() ?>"
                                                data-descritp="<?= $training->getDescriptions() ?>"
                                                data-dure="<?= $training->getDurations() ?>"
                                                data-prix="<?= $training->getPrice() ?>"
                                                onclick="EditTraining(this)"><i class="fas fa-user-edit "></i></button>
                                       

                                        
                                            <button type="button"
                                                class="bg-red-400 hover:bg-red-500 text-white text-sm rounded p-1"
                                                data-trainingCode="<?= $training->getCode() ?>"
                                                data-trainingId="<?= $training->getId() ?>"
        
                                                onclick="deleteTraining(this)"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>

                                    </tr>
                                <?php   } } ?>
                            </tbody>
                        </table>

                    </div>
                <?php } else { ?>
                    <p class=" bg-red-500 w-1/3 p-2 rounded text-white flex items-center justify-center mx-auto">Aucune
                        formation
                        disponible.</p>
                <?php } ?>
            </div>


            <!-- form update training -->

            <div id="openFormEditTraining"
                class="hidden h-2/3 bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto  fixed inset-0  items-center justify-center z-50 p-4 overflow-auto">
                <h2 class="text-2xl font-bold mb-6 text-center">Formulaire de Modification d'une formation</h2>
                <form id="EditTraining" action="updateTrainings.php" method="post">
                    <div class="grid grid-cols-2 gap-4">
                    
                                   
                        <div id="editCode" class="mb-4 ">
                            <label for="newCodes" class="block text-gray-700 text-sm font-bold mb-2">Nouveau code
                                :</label>
                            <input type="text" id="lastCodes" name="lastCodes" class="hidden">
                            <input type="text" id="newCodes" name="newCodes"
                                class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nouveau code">
                                <input type="hidden"  id="TrainingID" name="TrainingID" value=""  class="h-10 hidden">
                        </div>

                        <div id="editDescript" class="mb-4 ">
                            <label for="newDescriptions" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle
                                Description
                                :</label>
                            <input type="text" id="newDescriptions" name="newDescriptions"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nouvelle description">

                        </div>
                        <div id="editPrix" class="mb-4 ">
                            <label for="newPrices" class="block text-gray-700 text-sm font-bold mb-2">Nouveau prix
                                :</label>
                            <input type="number" id="newPrices" name="newPrices"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nouveau prix">

                        </div>
                        <div id="editDuree" class="mb-4 ">
                            <label for="newduree" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle Durée
                                :</label>
                            <input type="number" id="newduree" name="newduree"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nouvelle durée">

                        </div>
                    </div>
                    <?php if (isset($_SESSION['ArrayAuth'])): ?>
                                     <input type="text"  id="modifiedVAL" name="modifiedVAL" value="<?php echo$_SESSION['ArrayAuth'][0].' '.$_SESSION['ArrayAuth'][1];  ?>"  class=" hidden">
                                    <?php endif; ?>

                    <div class=" flex items-center justify-between  m-2">
                        <button type="submit" name="btnUpdateTraining"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <button type="button" onclick="closeEditTrainingForm()"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-times"></i> Annuler
                        </button>
                    </div>
                    <span id="errorMessage" class="text-red-500 tex-sm"></span>
                </form>
            </div>
           <!-- end update modal -->     
            
    <!-- delete modal -->
    <div id="deleteTraining" class="hidden lg:w-2/5 p-8 rounded-lg shadow-md w-full max-w-md mx-auto fixed inset-0 flex items-center justify-center z-50 p-4 overflow-auto">

     <form class="bg-red-200 p-8 rounded-lg shadow-md w-full max-w-md " method="post" action="delete.php">
        <h3>voulez-vous Supprimer <span id="NomTraining" class="font-bold"> </span>?</h3>

        <div class="mb-4">
        <?php if (isset($_SESSION['ArrayAuth'])): ?>
                                     <input type="text"  id="modifiedVAL" name="modifiedVAL" value="<?php echo$_SESSION['ArrayAuth'][0].' '.$_SESSION['ArrayAuth'][1];  ?>"  class=" hidden">
                                    <?php endif; ?>
            <input type="text" id="idTraining" name="idTraining" class=" border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline hidden">
            <input type="text" id="codeTraing" name="codeTraing" class=" border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline hidden">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" name="btnDeleteTraining">confirmer</button>
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeDeleteTrainingModal()">Annuler</button>      
        </div>            
    </form>
    </div>        
<!-- end delete modal -->
        </div>

        <!-- add js files -->
        <script src="./../../../assets/js/updateTrainings.js"></script> 
        <script src="./../../../assets/js/DirectorHead.js"></script>

<script>
    function deleteTraining(button){
    const codeT= button.getAttribute('data-trainingCode');
    const trainingID= button.getAttribute('data-trainingId');
 
    document.getElementById('idTraining').value=trainingID;
    document.getElementById('codeTraing').value=codeT;
    document.getElementById('deleteTraining').classList.remove('hidden');
}
function closeDeleteTrainingModal(){
    document.getElementById('deleteTraining').classList.add('hidden');

}
</script>
<script>
     function EditTraining(button){
   
   const codes= button.getAttribute('data-cod');
   const descript= button.getAttribute('data-descritp');
   const price= button.getAttribute('data-prix');
   const duree= button.getAttribute('data-dure');
   const trainingI= button.getAttribute('data-trainingvaleur');

       document.getElementById('newCodes').value=codes;
       document.getElementById('newDescriptions').value=descript;
       document.getElementById('newPrices').value=price;
       document.getElementById('newduree').value=duree;
       document.getElementById('lastCodes').value=codes;
       document.getElementById('TrainingID').value=trainingI;
       /* afficcher */
       document.getElementById('openFormEditTraining').classList.remove('hidden');
    
}
</script>
</body>

</html>