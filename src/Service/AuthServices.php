<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DS . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\User;
use App\Entity\Role;
use Core\Auth\PasswordHasher;

class AuthServices
{
    public function signIn(string $email, string $password): ?User
    {
        $connectionManager = new ConnectionManager();
        $result = [];

        $userData = [
            '_mail' => $email,
            '_passwords' => $password,
        ];


        $user1 = new User($userData);

        $intput_pass = $user1->getPasswords();
        $mail1 = $user1->getMail();

        $connectionManager = new ConnectionManager();
        $sql = "SELECT * FROM users WHERE mail = :mail";
    
        try {
            $query = $connectionManager->getConnection()->prepare($sql);
            $query->bindParam(':mail', $email, \PDO::PARAM_STR);
            $query->execute();
    
            $result = $query->fetch(\PDO::FETCH_ASSOC);
    
            if (empty($result)) {
                return null; // Aucun utilisateur trouvé avec cet email
            }
    
            // Vérification du mot de passe
            if (password_verify($password, $result['passwords'])) {
                // Création de l'objet User et configuration des propriétés
                $user = new User();
                $user->setId($result['id']);
                $user->setBirth_date($result['birth_date']);
                $user->setPhoto_user($result['photo_user']);
                $user->setPassword($result['passwords']);
                $user->setFirst_name($result['first_name']);
                $user->setName($result['last_name']);
                $user->setMail($result['mail']);
                $user->setPhone_number($result['phone_number']);
                $user->setRegistration_number($result['registration_number']);
                $user->setRole($result['name']);
                $user->setRole_id($result['role_id']);
    
                return $user;
            } else {
                return null; // Mot de passe incorrect
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erreur SQL : " . $e->getMessage());
        }
       
    }
  
     
}
