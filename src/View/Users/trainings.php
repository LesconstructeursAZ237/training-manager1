<?php session_start(); 


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\TrainingsController;
(new TrainingsController())->registrationTraining();

if (!isset($_SESSION['nom']) AND !isset($_SESSION['prenom']) AND !isset($_SESSION['mail']) AND !isset($_SESSION['telephone']) AND !isset($_SESSION['role_id']) ) {
    
    header('Location: index.php'); 
}
$user1 = $_SESSION['nom'];
$user2 = $_SESSION['prenom'];
$user3 = $_SESSION['mail'];
$user4 = $_SESSION['telephone'];
$user4 = $_SESSION['role_id']; 

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de formation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1>bonjour, <?php echo htmlspecialchars($user1).' '.$user2.' '.$user3.' '.$user4; ?></h1>
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Formulaire d'ajout de formation</h2>
        <form action="#" method="POST">
            <div class="mb-4">
                <label for="codes" class="block text-sm font-medium text-gray-700 mb-2">code</label>
                <input type="text" id="codes" name="codes" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="descriptions" class="block text-sm font-medium text-gray-700 mb-2">description</label>
                <input type="text" id="descriptions" name="descriptions" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="prices" class="block text-sm font-medium text-gray-700 mb-2">prix</label>
                <input type="number" id="prices" name="prices" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            

            <div class="mb-4">
                <label for="duree" class="block text-sm font-medium text-gray-700 mb-2">duree</label>
                <input type="tel" id="durations" name="durations" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="director.php" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Annuler</a>
                <button type="submit" name="trainingAdd" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Envoyer</button>
            </div>
        </form>
    </div>
</body>
</html>
