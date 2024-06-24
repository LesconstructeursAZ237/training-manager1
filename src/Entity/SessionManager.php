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
    public function signOut() {
        // Détruire toutes les variables de session
        $_SESSION = array();
        
        // Effacer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Détruire la session
        session_destroy();
    }
}

