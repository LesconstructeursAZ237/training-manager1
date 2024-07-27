<?php
session_start();

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->dashboard();

/**
 * @var array<\App\Entity\User> $users
 * @var array<\App\Controller\UsersController> $auth_user  
 * @var string<\App\Controller\UsersController> $flasMessage  
 * @var array<\App\Entity\User> $auth
 */

// Inclure le fichier FPDF
require_once './tcPDF/fpdf.php'; // Assurez-vous que le chemin est correct

// Créer une instance de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Définir la police pour le titre
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Liste des Utilisateurs', 0, 1, 'C');

// Définir les couleurs pour les en-têtes
$pdf->SetFillColor(200, 220, 255); // Couleur de fond des en-têtes (bleu clair)
$pdf->SetTextColor(0, 0, 0); // Couleur du texte des en-têtes (noir)

// Définir la police pour les en-têtes de table
$pdf->SetFont('Arial', 'B', 12);
$cellWidths = [30, 40, 40, 40, 60, 50, 50];
$headers = ['Photo', 'Nom', 'Prenom', 'Telephone', 'Matricule'];

// Ajouter les en-têtes
foreach ($headers as $i => $header) {
    $pdf->Cell($cellWidths[$i], 10, $header, 1, 0, 'C', true);
}
$pdf->Ln();

// Définir la police pour les données de la table
$pdf->SetFont('Arial', '', 10); // Taille de police réduite pour s'adapter

// Définir les couleurs pour les données
$pdf->SetFillColor(255, 255, 255); // Couleur de fond des cellules de données (blanc)
$pdf->SetTextColor(0, 0, 0); // Couleur du texte des cellules de données (noir)

// Ajouter les données
foreach ($users as $user) {
    // Exemple pour colorer la cellule du prénom
    $pdf->Cell($cellWidths[0], 10, 'Image URL', 1, 0, 'C', true); // Placeholder pour image
    $pdf->Cell($cellWidths[1], 10, htmlspecialchars($user->getFirst_name()), 1, 0, 'C', true);
    
    // Appliquer une couleur de fond spécifique à la cellule du nom
    $pdf->SetFillColor(255, 255, 204); // Couleur de fond spécifique (jaune pâle)
    $pdf->Cell($cellWidths[2], 10, htmlspecialchars($user->getName()), 1, 0, 'C', true);
    
    $pdf->SetFillColor(255, 255, 255); // Revenir à la couleur de fond blanche pour les autres cellules
    $pdf->Cell($cellWidths[3], 10, $user->getPhone_number(), 1, 0, 'C', true);
    $pdf->Cell($cellWidths[4], 10, htmlspecialchars($user->getRegistration_number()), 1, 0, 'C', true);
    
    $pdf->Ln();
}

// Sortie du fichier PDF (téléchargement)
$pdf->Output('liste_utilisateurs.pdf', 'D');
?>
