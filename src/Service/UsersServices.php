<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\User;
use App\Entity\Role;
use Core\Auth\PasswordHasher;
use Core\FlashMessages\Flash;



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
            '_create_by' => $created_by,
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
        $passwords = password_hash($passwords1, PASSWORD_DEFAULT);
        $role1 = $usersData->getRole_id(); //role = 1 pour etudiant 

        global $var_retour;


        $request1 = "SELECT mail, phone_number FROM users WHERE mail = :mail AND deleted=:deleted";
        $select_request1 = $this->_pdo->prepare($request1);

        $select_request1->bindParam(':mail', $mail1);
        $select_request1->bindValue(':deleted', 0);

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
        $request = "SELECT u.*, r.name
                FROM users u
                LEFT JOIN roles r ON u.role_id = r.id
                WHERE u.statut = :statut AND deleted = :deleted
                ORDER BY u.first_name ASC";
        $request1 = $this->_pdo->prepare($request);
        $request1->bindValue(':statut', 'afficher');
        $request1->bindValue(':deleted', 0);
        $request1->execute();
        $data = $request1->fetchAll(\PDO::FETCH_ASSOC);

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
            $user->setRole($userData['name']);
            $users[] = $user;
        }

        return $users;
    }



    public function  SignInUser(string $mail, string $passwords)
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
                    $ID = intval($values[0]);
                    switch ($role_id) {
                        case 1:
                            return 1;//student
                        case 2:                  
                            return $this->getById($ID);                  
                        case 3:                         
                            return $this->getById($ID);//directeur
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
    /**
     * Cette méthode modifie le role d'un utilisateur dans la base de données.
     * 
     * @return int tableau d'objets User.
     */
    public function setNewRole(int $id, string $newRole, string $newModified): int
    {
        function getNewValueRoleId(string $chaine): int
        {
            switch ($chaine) {
                case 'visitor':
                    return 4;
                case 'student':
                    return 1;
                case 'secretary':
                    return 2;
                default:
                    return 4;
            }
        }

        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $roleId = getNewValueRoleId($newRole);
        $userData = [
            '_id' => $id,
            '_role_id' => $roleId,
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];

        $userNewRole = new User($userData);

        $checkId = $userNewRole->getId();
        $InputRole = $userNewRole->getRole_id();
        $newModified = $userNewRole->getModified_by();
        $newCurrentDate = $userNewRole->getModified_date();
        /*   check if it is the same role */
        $request1 = "SELECT * FROM users WHERE id = :ID AND role_id =:role_id";

        $select_request4 = $this->_pdo->prepare($request1); // Préparer la requête

        $select_request4->bindParam(':ID', $checkId, \PDO::PARAM_STR);
        $select_request4->bindParam(':role_id', $InputRole, \PDO::PARAM_STR);

        $select_request4->execute();
        global $retourVal;
        $rowCount = $select_request4->rowCount();
        if ($rowCount > 0) {
            $retourVal = 1;
        }
        $request2 = "SELECT role_id FROM users WHERE id = :ID ";

        $select_request2 = $this->_pdo->prepare($request2); // Préparer la requête

        $select_request2->bindParam(':ID', $checkId, \PDO::PARAM_STR);

        $select_request2->execute();


        while ($row1 = $select_request2->fetch(\PDO::FETCH_ASSOC)) {
            $table1 = $row1;
            // utiliser les éléments du tableau
            $values = array_values($table1);
            /* check if role is director */
            if (isset($values[0])) {
                $val = $values[0];
                if ($val == 3) {
                    $retourVal = 0;
                } else {
                    
                    $saveNewRole = $this->_pdo->prepare("UPDATE Users 
                                              SET role_id = :role_id,
                                                    modifie_by = :modifie_by, 
                                                    modifie_date = :modifie_date
                                                WHERE id = :id");
                    $saveNewRole->bindParam(':id', $checkId, \PDO::PARAM_STR);
                    $saveNewRole->bindParam(':role_id', $InputRole, \PDO::PARAM_STR); 
                    $saveNewRole->bindParam(':modifie_by', $newModified, \PDO::PARAM_STR); 
                    $saveNewRole->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
                    $saveNewRole->execute();
                    if ($saveNewRole) {
                        $retourVal = 1;
                    } else {
                        $retourVal = 0;
                    }
                }


            } else {
                $retourVal = 0;
            }
        }

        return $retourVal;

    }
    /* edit registration number */
    public function setMatricule(int $id, string $newMat, string $newModified): int
    {
     

        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_id' => $id,
            '_registration_number' => $newMat,
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];
        $newMat = new User($userData);
            global $retourVal;
        $checkId = $newMat->getId(); /*echo $checkId; die(); IFPLI-24-0027 IFPLI-24-0027*/
        $InputMat = $newMat->getRegistration_number();// echo $InputMat; die();
        $newModifiedMat = $newMat->getModified_by();
        $newCurrentDate = $newMat->getModified_date();
        $saveNewMat = $this->_pdo->prepare("UPDATE Users 
        SET registration_number = :registration_number,
              modifie_by = :modifie_by, 
              modifie_date = :modifie_date
          WHERE id = :id");
            $saveNewMat->bindParam(':id', $checkId, \PDO::PARAM_STR);
            $saveNewMat->bindParam(':registration_number', $InputMat, \PDO::PARAM_STR); 
            $saveNewMat->bindParam(':modifie_by', $newModifiedMat, \PDO::PARAM_STR); 
            $saveNewMat->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
            $saveNewMat->execute();
                if ($saveNewMat) {
                $retourVal = 1;
                } else {
                $retourVal = 0;
                }
                return $retourVal;
    }

    /* edit email */
    public function editEmail(int $id, string $newMail, string $newModified): int
    {
     
      
        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_id' => $id,
            '_mail' => $newMail,
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];
        $newMail = new User($userData);
            global $retourVal;
        $checkId = $newMail->getId(); 
        $InputMail = $newMail->getMail(); 
        $newModifiedMail = $newMail->getModified_by();
        $newCurrentDate = $newMail->getModified_date();
        $saveNewMail = $this->_pdo->prepare("UPDATE Users 
        SET mail = :mail,
              modifie_by = :modifie_by, 
              modifie_date = :modifie_date
          WHERE id = :id");
            $saveNewMail->bindParam(':id', $checkId, \PDO::PARAM_STR);
            $saveNewMail->bindParam(':mail', $InputMail, \PDO::PARAM_STR); 
            $saveNewMail->bindParam(':modifie_by', $newModifiedMail, \PDO::PARAM_STR); 
            $saveNewMail->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
            $saveNewMail->execute();
                if ($saveNewMail) {
                $retourVal = 1;
                } else {
                $retourVal = 0;
                }
                return $retourVal;
    }
    /* edit phone number */
    public function editPhoneNumber(int $id, int $newPhone, string $newModified): int
    {
         
        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_id' => $id,
            '_phone_number' => $newPhone,
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];
        $newPhoneNumber = new User($userData);
            global $retourVal;
        $checkId = $newPhoneNumber->getId(); 
        $InputPhoneNumber = $newPhoneNumber->getPhone_number(); 
        $newModifiedPhone = $newPhoneNumber->getModified_by();
        $newCurrentDate = $newPhoneNumber->getModified_date();
        $saveNewPhone = $this->_pdo->prepare("UPDATE Users 
        SET phone_number = :phone_number,
              modifie_by = :modifie_by, 
              modifie_date = :modifie_date
          WHERE id = :id");
            $saveNewPhone->bindParam(':id', $checkId, \PDO::PARAM_STR);
            $saveNewPhone->bindParam(':phone_number', $InputPhoneNumber, \PDO::PARAM_STR); 
            $saveNewPhone->bindParam(':modifie_by', $newModifiedPhone, \PDO::PARAM_STR); 
            $saveNewPhone->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
            $saveNewPhone->execute();
                if ($saveNewPhone) {
                $retourVal = 1;
                } else {
                $retourVal = 0;
                }
                return $retourVal;
    }
    /* edit last_name */
    public function editFirstName(int $id, string $newPrenom, string $newModified): int
    {
         
        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_id' => $id,
            '_first_name' => $newPrenom,
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];
        $newPrenom = new User($userData);
            global $retourVal;
        $checkId = $newPrenom->getId(); 
        $InputPrenom = $newPrenom->getFirst_name(); 
        $newModifiedPrenom = $newPrenom->getModified_by();
        $newCurrentDate = $newPrenom->getModified_date();
        $saveNewPrenom = $this->_pdo->prepare("UPDATE Users 
        SET last_name = :last_name,
              modifie_by = :modifie_by, 
              modifie_date = :modifie_date
          WHERE id = :id");
            $saveNewPrenom ->bindParam(':id', $checkId, \PDO::PARAM_STR);
            $saveNewPrenom->bindParam(':last_name', $InputPrenom, \PDO::PARAM_STR); 
            $saveNewPrenom->bindParam(':modifie_by', $newModifiedPrenom, \PDO::PARAM_STR); 
            $saveNewPrenom->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
            $saveNewPrenom->execute();
                if ($saveNewPrenom) {
                $retourVal = 1;
                } else {
                $retourVal = 0;
                }
                return $retourVal;
    }
    /* edit first_name */
    public function editName(int $id, string $newNom, string $newModified): int
    {
         
        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_id' => $id,
            '_name' => $newNom,
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];
        $newNom = new User($userData);
            global $retourVal;
        $checkId = $newNom->getId(); 
        $InputNom = $newNom->getName(); 
        $newModifiedNom = $newNom->getModified_by();
        $newCurrentDate = $newNom->getModified_date();
        $saveNewNom = $this->_pdo->prepare("UPDATE Users 
        SET first_name = :first_name,
              modifie_by = :modifie_by, 
              modifie_date = :modifie_date
          WHERE id = :id");
            $saveNewNom ->bindParam(':id', $checkId, \PDO::PARAM_STR);
            $saveNewNom->bindParam(':first_name', $InputNom, \PDO::PARAM_STR); 
            $saveNewNom->bindParam(':modifie_by', $newModifiedNom, \PDO::PARAM_STR); 
            $saveNewNom->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
            $saveNewNom->execute();
                if ($saveNewNom) {
                $retourVal = 1;
                } else {
                $retourVal = 0;
                }
                return $retourVal;
    }

    /* delete user */
    public function deletedUser(int $id,  string $modified): int{

        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_id' => $id,
            '_modified_by' => $modified,
            '_modified_date' => $currentDate,
        ];
        $Deletet = new User($userData);
            global $retourVal;
        
                $checkId = $Deletet->getId(); 
                $Modified = $Deletet->getModified_by();
                $newCurrentDate = $Deletet->getModified_date();
        
                $saveDeletedUser  = $this->_pdo->prepare("UPDATE Users 
                SET statut = :statut,
                    deleted = :deleted,
                      modifie_by = :modifie_by, 
                      modifie_date = :modifie_date
                  WHERE id = :id");
                    $saveDeletedUser ->bindParam(':id', $checkId, \PDO::PARAM_STR);
                    $saveDeletedUser->bindValue(':statut', 'non', \PDO::PARAM_STR); 
                    $saveDeletedUser->bindValue(':deleted', 1, \PDO::PARAM_STR); 
                    $saveDeletedUser->bindParam(':modifie_by', $Modified, \PDO::PARAM_STR); 
                    $saveDeletedUser->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR); 
                    $saveDeletedUser->execute();
                        if ($saveDeletedUser) {
                        $retourVal = 1;
                        } else {
                        $retourVal = 0;
                        }
           
            return $retourVal;
    }

    public function getById($id): ?User
    {
        $result = [];

        $sql = "SELECT users.*, roles.*
                FROM users
                INNER JOIN roles ON users.role_id = roles.id
                WHERE users.id = :id AND users.deleted = :deleted";
        try {
            $query = $this->_pdo->prepare($sql);
            $query->bindParam(':id', $id, \PDO::PARAM_INT); // Si l'ID est un entier
            $query->bindValue(':deleted', 0, \PDO::PARAM_INT); // Si deleted est un entier
            $query->execute();
        
            $result = $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("SQL Exception: " . $e->getMessage(), 1);
        }
        
        if (empty($result)) {
            return null;
        }
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
    }
    public function delete(int $id): bool
    {

        return true;
    }

   
}

/* $userService = new UsersServices();

// Appeler la méthode getById avec un ID spécifique
$userA = $userService->getById(24);

if ($userA!== null) {
    // Afficher les valeurs de l'utilisateur
    echo "ID: " . $userA->getRole_id() . "<br>";
    echo "Name: " . $userA->getRole() . "<br>";
    echo "Name: " . $userA->getRegistration_number() . "<br>";
    echo "Email: " . $userA->getMail() . "<br>";
} else {
    // Gérer le cas où l'utilisateur n'est pas trouvé
    echo "Utilisateur non trouvé.";
} */

