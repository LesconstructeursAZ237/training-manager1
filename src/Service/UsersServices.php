<?php

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



    public function registrationUser(string $name, string $firstName, string $mail, string $phone_number, $birth_date, string $photo_user, string $pwd, $created_by): int
    {
        //print_r($firstName);  die();

        $userData = [
            '_name' => $name,
            '_first_name' => $firstName,
            '_mail' => $mail,
            '_passwords' => $pwd,
            '_phone_number' => $phone_number,
            '_birth_date' => $birth_date,
            '_photo_user' => $photo_user,
            '_created_by' => $created_by,
        ];


        $usersData = new User($userData);
        $name1 = $usersData->getName();
        $firstName1 = $usersData->getFirst_name();
        $mail1 = $usersData->getMail();
        $phone_number1 = $usersData->getPhone_number();
        $birth_date1 = $usersData->getbirth_date();
        $photo_user1 = $usersData->getPhoto_user();
        $passwords1 = $usersData->getMail();
        $created_by = $usersData->getCreate_by();
        // print_r($created_by );  die();
        $passwords = password_hash($passwords1, PASSWORD_DEFAULT);
        $role1 = $usersData->getRole_id(); //role = 1 pour etudiant 

        global $var_retour;


        $request1 = "SELECT mail, phone_number FROM users WHERE mail = :mail";
        $select_request1 = $this->_pdo->prepare($request1);

        $select_request1->bindParam(':mail', $mail1);

        $select_request1->execute();

        // Récupérer le nombre de lignes renvoyées par la requête
        $rowCount = $select_request1->rowCount();
        if ($rowCount > 0) {

            return 20;   //l'utilisateur existe deja

        } else {
            $saveUser = $this->_pdo->prepare("INSERT INTO Users(first_name, last_name, mail, phone_number, birth_date, photo_user, passwords, created_by, role_id)
                        value(:NOM, :PRENOM, :MAIL, :TELEPHONE, :BIRTHD, :PHOT, :PWD, :CREAT, :ROLEID)");

            $saveUser->bindParam(':NOM', $name1);
            $saveUser->bindParam(':PRENOM', $firstName1);
            $saveUser->bindParam(':MAIL', $mail1);
            $saveUser->bindParam(':TELEPHONE', $phone_number1);
            $saveUser->bindParam(':BIRTHD', $birth_date1);
            $saveUser->bindParam(':PHOT', $photo_user1);
            $saveUser->bindParam(':PWD', $passwords);
            $saveUser->bindParam(':CREAT', $created_by);
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
                if ($rowCount1 > 0) {
                    $result3 = $select_request2->fetchAll();
                    foreach ($result3 as $row3) {
                        $val0 = $row3['id'];
                        //$val1 = substr($val0, -4);

                    }
                }
                if ($rowCount1 > 0) {
                    $final_value_id = strval($val0);// convertir en chaine de carracte

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

                    $saveRegistNumber = $this->_pdo->prepare("UPDATE Users 
                                          SET registration_number = :REG 
                                          WHERE mail = :mail AND phone_number = :phone"); // requete pour enregistrer le matricule

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

    /**
     * Cette méthode sélectionne tous les utilisateurs de la base de données.
     * 
     * @return User[] Un tableau d'objets User.
     */
    public function getAll(): array
    {
        $request1 = "SELECT * FROM users WHERE statut = :statut";
        $select_request1 = $this->_pdo->prepare($request1);
        $select_request1->bindValue(':statut', 'afficher');
        $select_request1->execute();
        $data = $select_request1->fetchAll(\PDO::FETCH_ASSOC); // FETCH_ASSOC pour obtenir un tableau associatif

        $users = [];
        foreach ($data as $userData) {
            $user = new User();
            $user->setId($userData['id']);
            $user->setBirth_date($userData['birth_date']);
            $user->setPhoto_user($userData['photo_user']);
            $user->setPassword($userData['passwords']);
            $user->setFirst_name($userData['first_name']);
            $user->setName($userData['last_name']);
            $user->setMail($userData['mail']);
            $user->setPhone_number($userData['phone_number']);
            $user->setRegistration_number($userData['registration_number']);
            $users[] = $user;
        }

        return $users;
    }



    public function SignInUser(string $mail, string $passwords)
    {
        $userData = [
            '_mail' => $mail,
            '_passwords' => $passwords,
        ];


        $user1 = new User($userData);

        $intput_pass = $user1->getPasswords();
        $mail1 = $user1->getMail();

        $request1 = "SELECT * FROM users WHERE mail = :mail";

        $select_request4 = $this->_pdo->prepare($request1); // Préparer la requête

        $select_request4->bindParam(':mail', $mail1, \PDO::PARAM_STR);

        $select_request4->execute();

        $rowCount = $select_request4->rowCount();
        //print_r($rowCount); die();
        if ($rowCount > 0) {

            while ($row = $select_request4->fetch(\PDO::FETCH_ASSOC)) {
                $table = $row;
                // utiliser les éléments du tableau
                $values = array_values($table);

                if (isset($values[7])) {
                    $outPoutPassword = $values[7];
                }
                if (isset($values[15])) {
                    $role_id = $values[15];
                }
                if (password_verify($intput_pass, $outPoutPassword)) {
                    //'Mot de passe valide !';
                    switch ($role_id) {
                        case 1:
                            return 1;//student
                        case 2:
                            return $values;//secretaire
                        case 3:
                            return $values;//directeur
                        case 4:
                            return 4;
                        //autres cas
                        default:
                            return 4;// visiteur           
                    }

                } else {
                    return 10;//'Mot de passe invalide.';
                }

            }
        } else {
            return 0; // user not found
        }
    }

}

/*  $users = (new UsersServices())->sellectAllUser();
foreach ($users as $user): ?>
    <div>
        <p>Nom complet: <?= htmlspecialchars($user->getFirst_name() . ' ' . $user->getName()) ?></p>
        <p>Email: <?= htmlspecialchars($user->getMail()) ?></p>
        <p>Numéro de téléphone: <?= ($user->getPhone_number()) ?></p>
        <p>Numéro d'inscription: <?= htmlspecialchars($user->getRegistration_number()) ?></p>
        <hr>
    </div>
<?php endforeach; ?> */

