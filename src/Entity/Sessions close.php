<?php


// src/Services/Sessions.php

require_once 'config/Database.php';

class Sessions {
    // Empêcher l'instanciation directe
    private function __construct() {}

    // Empêcher la duplication de l'objet
    private function __clone() {}

    // Empêcher la désérialisation de l'objet
    private function __wakeup() {}

    // Méthode statique pour vérifier la durée restante d'une session
    public static function getNotTerminatedSessionIds() {
        $conn = Database::getConnection();
        $query = "SELECT id FROM sessions WHERE statut = 0";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $result;
    }
    public static function getRemainingDuration($sessionId) {
        $conn = Database::getConnection();
        $query = "SELECT date_de_debut, mois, statut FROM sessions WHERE id = :sessionId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($result['statut'] == 1) {
                return "La session est déjà terminée.";
            } else {
                // Calculer la date de fin de la session
                $startDate = new DateTime($result['date_de_debut']);
                $durationMonths = (int)$result['mois'];
                // Cloner l'objet startDate pour ne pas le modifier directement
                $endDate = (clone $startDate)->modify("+$durationMonths months");

                // Calculer la durée restante à partir de maintenant
                $currentDate = new DateTime();
                if ($currentDate > $endDate) {
                    return "La session devrait être terminée.";
                }

                $remainingDuration = $currentDate->diff($endDate);
                return $remainingDuration->format('%m mois, %d jours restants');
            }
        } else {
            return "La session n'existe pas.";
        }
    }
    
    /* Verifier qu'il reste moins de deux mois */
function isLessThanTwoMonthsRemaining($startDate, $durationMonths) {
    // Créer des objets DateTime
    $currentDate = new DateTime();
    $startDate = new DateTime($startDate);

    // Calculer la date de fin
    $endDate = (clone $startDate)->modify("+$durationMonths months");

    // Calculer la différence entre la date actuelle et la date de fin
    $remainingDuration = $currentDate->diff($endDate);

    // Vérifier si la durée restante est inférieure à deux mois
    if ($remainingDuration->y == 0 && $remainingDuration->m < 2) {
        return true; // Moins de deux mois restants
    }
    
    return false; // Deux mois ou plus restants
}

// Exemple d'utilisation
$startDate = '2024-01-01';
$durationMonths = 10; // Durée de la session en mois

if (isLessThanTwoMonthsRemaining($startDate, $durationMonths)) {
    echo "Il reste moins de deux mois.";
} else {
    echo "Il reste deux mois ou plus.";
}
?>

}
?>
