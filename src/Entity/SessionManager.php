<?php
// Commencez la session au début de votre script
namespace App\Entity;


class SessionManager {
    // Définir une variable de session
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Obtenir une variable de session
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Supprimer une variable de session
    public function delete($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Détruire toutes les variables de session
    public function destroy() {
        session_destroy();
    }
}

/* / Exemple d'utilisation de la classe SessionManager
$session = new SessionManager();

// Définir une variable de session
$session->set('username', 'JohnDoe');

// Obtenir une variable de session
$username = $session->get('username');
echo 'Username: ' . $username; // Affichera 'Username: JohnDoe'

// Supprimer une variable de session
$session->delete('username');

// Vérifier que la variable de session a été supprimée
$username = $session->get('username');
echo 'Username after delete: ' . $username; // Affichera 'Username after delete: ' (null)

// Détruire la session (et toutes les variables de session)
$session->destroy(); */

