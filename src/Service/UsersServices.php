<?php

/**
 * PHP Skeleton app
 * Minimum structure for native PHP web apps development
 * 
 * @copyright Copyright (c) Silevester D. (https://github.com/SilverD3)
 * @link      https://github.com/devacademia/php-skeleton-ap PHP Skeleton App
 * @since     v1.0 (2024)
 */

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\User;

class UsersServices
{
    private \PDO $_pdo;

    public function __construct()
    {
        $connectionManager = new ConnectionManager();
        $this->_pdo = $connectionManager->getConnection();
    }

    public function testDbConnection(): string
    {
        $connectionManager = new ConnectionManager();
        $this->_pdo = $connectionManager->getConnection();
        if ($this->_pdo) {
            return "<div class='alert alert-success'> Connexion to database <span class='fw-bold'>" . $connectionManager->getDatabase() . " </span> is established.</div>";
        } else {
            return "<div class='alert alert-danger'> Cannot connect to database. Reason : <span class='fw-bold'> " . $connectionManager->getError() . "</div>";
        }
    }



    public function registrationUser(string $name, string $firstName, string $mail, string $phone_number, $birth_date, string $photo_user, string $pwd): int
    {
        //print_r($firstName);  die();

        $user1 = new User($name, $firstName, $mail, $phone_number, $birth_date, $photo_user, $pwd);
        $name1 = $user1->getMail();
        $firstName1 = $user1->getPhone_number();
        $mail1 = $user1->getMail();
        $phone_number1 = $user1->getPhone_number();
        $birth_date1 = $user1->getbirth_date();
        $photo_user1 = $user1->getPhoto_user();
        $passwords1 = $user1->getMail();
        $passwords = password_hash($passwords1, PASSWORD_DEFAULT);
        $role1 = $user1->getRole_id(); //role = 1 pour etudiant 

        global $var_retour;


        $request1 = "SELECT mail, phone_number FROM users WHERE mail = :mail AND phone_number = :phone";
        $select_request1 = $this->_pdo->prepare($request1);

        $select_request1->bindParam(':mail', $mail1);
        $select_request1->bindParam(':phone', $phone_number1);

        $select_request1->execute();

        // Récupérer le nombre de lignes renvoyées par la requête
        $rowCount = $select_request1->rowCount();
        if ($rowCount > 0) {

            return 20;   //l'utilisateur existe deja

        } else {
            $saveUser = $this->_pdo->prepare("INSERT INTO Users(first_name, last_name, mail, phone_number, birth_date, photo_user, passwords, role_id)
                        value(:NOM, :PRENOM, :MAIL, :TELEPHONE, :BIRTHD, :PHOT, :PWD, :ROLEID)");

            $saveUser->bindParam(':NOM', $name1);
            $saveUser->bindParam(':PRENOM', $firstName1);
            $saveUser->bindParam(':MAIL', $mail1);
            $saveUser->bindParam(':TELEPHONE', $phone_number1);
            $saveUser->bindParam(':BIRTHD', $birth_date1);
            $saveUser->bindParam(':PHOT', $photo_user1);
            $saveUser->bindParam(':PWD', $passwords);
            $saveUser->bindParam(':ROLEID', $role1);   //role = 1 pour etudiant  
            //$role1= 1; 
            // $saveUser->execute();
            if ($saveUser->execute()) {
                $request2 = "SELECT id FROM users WHERE mail = :mail AND phone_number = :phone";
                $select_request2 = $this->_pdo->prepare($request2);

                $select_request2->bindParam(':mail', $mail1);
                $select_request2->bindParam(':phone', $phone_number1);

                $value_id = $select_request2->execute();
              // Récupérer le nombre de lignes renvoyées par la requête
                $rowCount1 = $select_request2->rowCount();
                    if($rowCount1 > 0)
                    {
                        $result3 = $select_request2->fetchAll();
                        foreach($result3 as $row3){
                        $val0 = $row3['id'];
                        //$val1 = substr($val0, -4);

                        }
                    }
                if ($rowCount1 > 0) {
                    $final_value_id = strval($val0 );// convertir en chaine de carracte

                    $L = strlen($final_value_id);
                    global $L1;
                    switch ($L) {
                        case 1:
                            $L1 = '000' . $final_value_id;
                            break;
                        case 2:
                            $L1 = '00' . $final_value_id;
                            break;
                        case 3:
                            $L1 = '0' . $final_value_id;
                            break;
                        case 4:
                            $L1 = $final_value_id;
                            break;
                        case $L > 4:
                            $L1 = substr($final_value_id, -4);
                            break;
                        // autre cas
                        // autre cas
                        default:
                            $L1 = substr($final_value_id, -4);
                            break;
                    }
                    $actual_year1 = strval(date("Y")); // l'annee en cours
                    $actual_year2 = substr($actual_year1, -2); // extraire les 2 derniere chiffres de l'annee en cours
                    $registration_number10 = 'IFPLI' . '-' . $actual_year2 . '-' . $L1; // concatenation pour obtenir le matricule

              /*       // find and existing registration number
                                    $request3 = "SELECT mail, phone_number FROM users WHERE registration_number= :REG1";
                $select_request3 = $this->_pdo->prepare($request3);

                $select_request3->bindParam(':REG1', $registration_number10);
                $result3 = $select_request3->execute();

                // Récupérer le nombre de lignes renvoyées par la requête
                $rowCount1 = $select_request3->rowCount();
                if($rowCount1 > 0){
                    $result3 = $select_request3->fetchAll();
                    foreach($result3 as $row3){
                        $val0 = $row3['registration_number'];
                        $val1 = substr($val0, -4);


                    }
                } */

                    $saveRegistNumber = $this->_pdo->prepare("UPDATE Users 
                                          SET registration_number = :REG 
                                          WHERE mail = :mail AND phone_number = :phone");

                    $saveRegistNumber->bindParam(':REG', $registration_number10);
                    $saveRegistNumber->bindParam(':mail', $mail1);
                    $saveRegistNumber->bindParam(':phone', $phone_number1);

                    $saveRegistNumber->execute();
                    if ($saveRegistNumber) {
                        return 1; // enregistrement success

                    } else {
                        return 2;// echec matricule 

                    }

                } else {
                    return 22;// echec sur recuperation id 

                }

            } else {
                $var_retour = 21;//echec d'eregistrement premier champs  
            }
        }
        return $var_retour;

    }
    // function insert img into img 
    function saveImg($fileName, $destinationPath)
    {
        // Construire le chemin complet du fichier source
        $sourcePath = __DIR__ . '/' . $fileName;

        // Construire le chemin complet de destination
        $destinationPath = rtrim($destinationPath, '/') . '/' . $fileName;

        // Vérifier si le fichier source existe
        if (!file_exists($sourcePath)) {
            echo "Le fichier source n'existe pas.";
        }

        // Déplacer le fichier vers le chemin de destination
        if (rename($sourcePath, $destinationPath)) {
            echo "Fichier déplacé avec succès.";
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }
    }



    public function SignInUser(string $mail, string $passwords)
    {
        if ($this->_pdo) {
            try {

                // Instancier la classe SignIn
                $user1 = new User($mail, $passwords, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                $mail1 = $user1->getMail();
                $phone_number1 = $user1->getPassword();

                $request1 = "SELECT mail, phone_number FROM users WHERE mail = :mail AND phone_number = :phone";
                $select_request1 = $this->_pdo->prepare($request1); // Préparer la requête

                // Utiliser les méthodes getMail() et getPhone_number() de la classe User
                $select_request1->bindParam(':mail', $mail1, \PDO::PARAM_STR);
                $select_request1->bindParam(':phone', $phone_number1, \PDO::PARAM_STR);

                $select_request1->execute();
                // Récupérer le nombre de lignes renvoyées par la requête
                $rowCount = $select_request1->rowCount();
                $GLOBALS['resultat'] = $rowCount;
            } catch (\PDOException $e) {
                $GLOBALS['resultat'] = 0;
            }
        } else {
            $GLOBALS['resultat'] = 0;
        }

        $GLOBALS['resultat'];
    }
}
//(new UsersServices())->registrationUser('fabrice','0255', 'uh', '852');
