<?php
//variable de session pour retour de message
session_start(); // debut


require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->dashboard();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des ulilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    
                       
                  
    <div class="container mx-auto p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tableau des Utilisateurs</h2>
        <button> <a href=""class="bg-blue-500 font-bold p-4 hover:bg-gray-200" name="obtainAllUser">Voir les utilisateurs</a></button>
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">nom</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">prenom</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">E-mail</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Téléphone</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Matricule</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  /*   if ($_SESSION['tabUser']->num_rows > 0) {
                        while($row = $_SESSION['tabUser']->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . $row["last_name"] . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . $row["fist_name"] . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . $row["email"] . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . $row["phone"] . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . $row["registration_number"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='py-2 px-4 border-b border-gray-200 text-center'>".$_SESSION['not_f_user']."</td></tr>";
                    } */
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
