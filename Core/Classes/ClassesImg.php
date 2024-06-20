<?php
namespace Core\Classes;
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';
// Définition de la constante IMG_PATH
//define('IMG_PATH', './../../assets/img');

class ClassesImg
{
    // Fonction pour sélectionner et afficher les images aléatoires
    public function displayRandomImages()
    {
        // Chemin complet vers le dossier des images
        $imageFolderPath = IMG_PATH;

        // Vérifier si le dossier existe et est accessible
        if (!is_dir($imageFolderPath) || !is_readable($imageFolderPath)) {
            echo "Le dossier d'images spécifié n'existe pas ou n'est pas accessible.";
            return;
        }

        // Récupérer la liste des fichiers d'images dans le dossier
        $files = glob($imageFolderPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        // Vérifier s'il y a des fichiers d'images
        if (empty($files)) {
            echo "Aucune image trouvée dans ce dossier.";
            return;
        }

        // Mélanger les fichiers pour sélectionner aléatoirement
        shuffle($files);

        // Limiter à 5 images aléatoires ou au nombre total si moins de 5 images
        $numImagesToDisplay = min(5, count($files));

        // Afficher les balises <img> pour chaque image sélectionnée
        for ($i = 0; $i < $numImagesToDisplay; $i++) {
            $imagePath = $files[$i];
            echo '<img src="' . $imagePath . '" alt="Image ' . ($i + 1) . '" class="w-full h-full object-contain hidden">';
        }
    }
}

// Exemple d'utilisation :
$var2 = new ClassesImg();
$var2->displayRandomImages();


