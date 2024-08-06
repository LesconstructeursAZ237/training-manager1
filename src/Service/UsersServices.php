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



    public function registrationUser(string $name, string $firstName, string $mail, string $phone_number, $birth_date, string $photo_user, string $pwd, $created_by): int|string
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
        $passwords1 = $usersData->getPasswords();
        $created_by = $usersData->getCreate_by();
        $passwords = password_hash($passwords1, PASSWORD_DEFAULT);
        $role1 = $usersData->getRole_id(); //role = 1 pour etudiant 

        global $var_retour;


        $request1 = "SELECT mail FROM users WHERE mail = :mail AND deleted=:deleted";
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
                    return 1;

            } else {
                $var_retour = 'echec d\'insertion de l\'utilisateur';//echec d'eregistrement premier champs  
            }
        }
        return $var_retour;

    }
    // function insert img into img 

   public function saveImage(array $infoPhoto, $chemin) {
        // Utiliser le nom de fichier original
        $nom_de_mon_fichier = basename($infoPhoto["name"]);
        // Construire le chemin complet du fichier de destination
        $chemin_destination = $chemin . $nom_de_mon_fichier;
    
        // Vérifier si le fichier de destination existe déjà
        if (file_exists($chemin_destination)) {
            $dateActuel = date('Y-m-d H:i:s'); 
            // Concaterner la date au nom du fichier pour créer un nouveau nom unique
            $date_sans_espacement = str_replace(' ', '', $dateActuel);
            $date_sans_double_point = str_replace(':', '', $date_sans_espacement);
            $date_sans_double_tiret = str_replace('-', '', $date_sans_double_point);
            $nom_fichier_a_sauvegarder = $date_sans_double_tiret . '_' . $nom_de_mon_fichier;
            $nouveau_chemin_destination = $chemin . $nom_fichier_a_sauvegarder;
    
            // Déplacer le fichier téléchargé vers le nouveau chemin de destination
            if (move_uploaded_file($infoPhoto["tmp_name"], $nouveau_chemin_destination)) {
                return $nom_fichier_a_sauvegarder;
            } else {
                return 'notUploadToNewPath';
            }
        } else {
            // Déplacer le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($infoPhoto["tmp_name"], $chemin_destination)) {
                return $nom_de_mon_fichier;
            } else {
                return 'notUploadToPath';
            }
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
        $request1->bindValue(':statut', 'ajouter');
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
            $user->setRole_id($userData['role_id']);
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

        $request1 = "SELECT * FROM users WHERE mail = :mail AND deleted = :deleted";

        $select_request4 = $this->_pdo->prepare($request1); // Préparer la requête

        $select_request4->bindParam(':mail', $mail1, \PDO::PARAM_STR);
        $select_request4->bindValue(':deleted', 0, \PDO::PARAM_STR);

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
    public function setRoleUser(int $idRole,int $idUser, string $newModified): int|string
    {/*   check if it is director role */
        if ($idRole === 3) {
            return 0;
        }

        $currentDate = date('Y-m-d');/* pour stocker la date de modification */
        $userData = [
            '_role_id' => $idRole,
            '_id' => $idUser, 
            '_modified_by' => $newModified,
            '_modified_date' => $currentDate,
        ];
      
        $userNewRole = new User($userData);

        $idUser = $userNewRole->getId();
        $InputRole = $userNewRole->getRole_id();
        $newModified = $userNewRole->getModified_by();
        $newCurrentDate = $userNewRole->getModified_date();

        /* if user is allready retrated */
        try {
            $sql = "SELECT * FROM registrations WHERE student_id = :userId";
            $userRegistrate = $this->_pdo->prepare($sql);
            $userRegistrate->bindParam(':userId', $idUser, \PDO::PARAM_STR);
            
            if ($userRegistrate->execute()) {
                /* Vérifier si des résultats ont été trouvés*/
                if ($userRegistrate->fetch(\PDO::FETCH_ASSOC)) {
                    
                    $saveNewRole = $this->_pdo->prepare("UPDATE Users 
                                              SET role_id = :role_id,
                                                    modifie_by = :modifie_by, 
                                                    modifie_date = :modifie_date
                                                WHERE id = :id");
                    $saveNewRole->bindParam(':id', $idUser, \PDO::PARAM_STR);
                    $saveNewRole->bindParam(':role_id', $InputRole, \PDO::PARAM_STR);
                    $saveNewRole->bindParam(':modifie_by', $newModified, \PDO::PARAM_STR);
                    $saveNewRole->bindParam(':modifie_date', $newCurrentDate, \PDO::PARAM_STR);
                    $saveNewRole->execute();
                    if ($saveNewRole) {
                        return 1;
                    } else {
                        return 'erreur de mise a jour';
                    }
                } else {
                    
                  return 'aucun resultat trouver';
                }
            } else {
         
                return 'echec d\'execution de la requete';
            }
        } catch (\PDOException $e) {
           return "Erreur : " . $e->getMessage();
        }
        


    }
    public function verifieUniqueEmail($idUser, $email) : bool{
        $request1 = "SELECT mail FROM users WHERE mail = :mail AND deleted=:deleted AND id!=:id";
        $select_request1 = $this->_pdo->prepare($request1);
    
        $select_request1->bindParam(':mail', $email);
        $select_request1->bindValue(':deleted', 0);
        $select_request1->bindParam(':id', $idUser);
    
        $select_request1->execute();
    
        /*Récupérer le nombre de lignes renvoyées par la requête*/
        $rowCount = $select_request1->rowCount();
        if ($rowCount >0) {
    
            return true;   /* un utilisateur a deja cette adresse email*/
    
        }
        return false; 
    }
   
    public function updateNewUser(array $data): int{
        $updatval = new User($data);
        $tPhoto=$updatval->getPhoto_user();
        $tDate=$updatval->getBirth_date();
        $roleId=intval($updatval->getRole_id()); 
        $mail = $updatval->getMail();
        $id = $updatval->getId();
        $nom = $updatval->getName();
        $prenom = $updatval->getFirst_name();
        $telephone = $updatval->getPhone_number();
        $modified = $updatval->getCreate_by();
        $matricule = $updatval->getRegistration_number();
        $mofdifiedDate = date('y-m-d');

  
        if($this->verifieUniqueEmail($id, $mail)){
            return 2; 
        }

        $updatval1 = $this->_pdo->prepare("UPDATE Users 
            SET   last_name = :last_name,
                  first_name = :first_name, 
                  mail = :mail, 
                  phone_number = :phone_number, 
                  registration_number = :registration_number, 
                  modifie_by = :modifie_by, 
                  modifie_date = :modifie_date,
                  birth_date = :birth_date,
                  birth_date = :birth_date,
                  photo_user = :photo_user,
                  role_id = :role_id
              WHERE id = :id AND deleted=0");
               $updatval1->bindParam(':id', $id, \PDO::PARAM_INT);
               $updatval1->bindParam(':first_name', $prenom, \PDO::PARAM_STR);
               $updatval1->bindParam(':last_name', $nom, \PDO::PARAM_STR);
               $updatval1->bindParam(':mail', $mail, \PDO::PARAM_STR);
               $updatval1->bindParam(':phone_number', $telephone, \PDO::PARAM_STR);
               $updatval1->bindParam(':registration_number', $matricule, \PDO::PARAM_STR);
               $updatval1->bindParam(':modifie_by', $modified, \PDO::PARAM_STR);
               $updatval1->bindParam(':modifie_date', $mofdifiedDate, \PDO::PARAM_STR);
               $updatval1->bindParam(':role_id', $roleId, \PDO::PARAM_INT);
               $updatval1->bindParam(':birth_date', $tDate, \PDO::PARAM_STR);
               $updatval1->bindParam(':photo_user', $tPhoto, \PDO::PARAM_STR);
   
            if ($updatval1->execute()) {
                return 1;
            } else {
                return 0;
            }

  
    }
    public function updateUser(array $userData): int
    {
        $updatval = new User($userData);
            $testPhoto=$updatval->getPhoto_user();
            $testDate=$updatval->getBirth_date();
            $roleId=intval($updatval->getRole_id()); 
            $mail1 = $updatval->getMail();
            $id = $updatval->getId();
        $request1 = "SELECT mail FROM users WHERE mail = :mail AND deleted=:deleted AND id!=:id";
        $select_request1 = $this->_pdo->prepare($request1);

        $select_request1->bindParam(':mail', $mail1);
        $select_request1->bindValue(':deleted', 0);
        $select_request1->bindParam(':id', $id);

        $select_request1->execute();

        /*Récupérer le nombre de lignes renvoyées par la requête*/
        $rowCount = $select_request1->rowCount();
        if ($rowCount >0) {

            return 20;   /* un utilisateur a deja cette adresse email*/

        } 

        if (($testPhoto=='') && ($testDate=='')) {
        
            $updatval1 = $this->_pdo->prepare("UPDATE Users 
            SET   last_name = :last_name,
                  first_name = :first_name, 
                  mail = :mail, 
                  phone_number = :phone_number, 
                  registration_number = :registration_number, 
                  modifie_by = :modifie_by, 
                  modifie_date = :modifie_date,
                  role_id = :role_id
              WHERE id = :id");
               
               $Fname = $updatval->getFirst_name();
               $name = $updatval->getName();
               $mail = $updatval->getMail();
               $phone = $updatval->getPhone_number();
               $matricule = $updatval->getRegistration_number();
               $modifieBy = $updatval->getModified_by();
               $modifiedDate = $updatval->getModified_date();
               $updatval1->bindParam(':id', $id, \PDO::PARAM_STR);
               $updatval1->bindParam(':first_name', $Fname, \PDO::PARAM_STR);$id = $updatval->getId();
               $updatval1->bindParam(':last_name', $name, \PDO::PARAM_STR);
               $updatval1->bindParam(':mail', $mail, \PDO::PARAM_STR);
               $updatval1->bindParam(':phone_number', $phone, \PDO::PARAM_STR);
               $updatval1->bindParam(':registration_number', $matricule, \PDO::PARAM_STR);
               $updatval1->bindParam(':modifie_by', $modifieBy, \PDO::PARAM_STR);
               $updatval1->bindParam(':modifie_date', $modifiedDate, \PDO::PARAM_STR);
               $updatval1->bindParam(':role_id', $roleId, \PDO::PARAM_STR);
   
            if ($updatval1->execute()) {
                return 1;
            } else {
                return 0;
            }
        } else if ($testPhoto!='') {
        
                $updatval2 = $this->_pdo->prepare("UPDATE Users 
                SET   last_name = :last_name,
                      first_name = :first_name, 
                      mail = :mail, 
                      phone_number = :phone_number, 
                      registration_number = :registration_number, 
                      modifie_by = :modifie_by, 
                      photo_user = :photo_user, 
                      modifie_date = :modifie_date,
                      role_id = :role_id
                  WHERE id = :id");
                    $id = $updatval->getId();
                    $Fname = $updatval->getFirst_name();
                    $name = $updatval->getName();
                    $mail = $updatval->getMail();
                    $phone = $updatval->getPhone_number();
                    $matricule = $updatval->getRegistration_number();
                    $modifieBy = $updatval->getModified_by();
                    $modifiedDate = $updatval->getModified_date();
                    $phot = $updatval->getPhoto_user();
                    $updatval2->bindParam(':id', $id, \PDO::PARAM_STR);
                    $updatval2->bindParam(':first_name', $Fname, \PDO::PARAM_STR);
                    $updatval2->bindParam(':last_name', $name, \PDO::PARAM_STR);
                    $updatval2->bindParam(':mail', $mail, \PDO::PARAM_STR);
                    $updatval2->bindParam(':phone_number', $phone, \PDO::PARAM_STR);
                    $updatval2->bindParam(':registration_number', $matricule, \PDO::PARAM_STR);
                    $updatval2->bindParam(':modifie_by', $modifieBy, \PDO::PARAM_STR);
                    $updatval2->bindParam(':modifie_date', $modifiedDate, \PDO::PARAM_STR);
                    $updatval2->bindParam(':photo_user', $phot, \PDO::PARAM_STR);
                    $updatval2->bindParam(':role_id', $roleId, \PDO::PARAM_STR);
          
            if ($updatval2->execute()) {
                return 1;
            } else {
                return 0;
            }
        } else if ($testDate!='') {
          
                $updatval3 = $this->_pdo->prepare("UPDATE Users 
                SET   last_name = :last_name,
                      first_name = :first_name, 
                      mail = :mail, 
                      phone_number = :phone_number, 
                      registration_number = :registration_number, 
                      modifie_by = :modifie_by, 
                      birth_date = :birth_date, 
                      modifie_date = :modifie_date,
                      role_id = :role_id
                  WHERE id = :id");
                    $id = $updatval->getId();
                    $Fname = $updatval->getFirst_name();
                    $name = $updatval->getName();
                    $mail = $updatval->getMail();
                    $phone = $updatval->getPhone_number();
                    $matricule = $updatval->getRegistration_number();
                    $modifieBy = $updatval->getModified_by();
                    $modifiedDate = $updatval->getModified_date();
                    $birthDate = $updatval->getBirth_date();
                    $updatval3->bindParam(':id', $id, \PDO::PARAM_STR);
                    $updatval3->bindParam(':first_name', $Fname, \PDO::PARAM_STR);
                    $updatval3->bindParam(':last_name', $name, \PDO::PARAM_STR);
                    $updatval3->bindParam(':mail', $mail, \PDO::PARAM_STR);
                    $updatval3->bindParam(':phone_number', $phone, \PDO::PARAM_STR);
                    $updatval3->bindParam(':registration_number', $matricule, \PDO::PARAM_STR);
                    $updatval3->bindParam(':modifie_by', $modifieBy, \PDO::PARAM_STR);
                    $updatval3->bindParam(':modifie_date', $modifiedDate, \PDO::PARAM_STR);
                    $updatval3->bindParam(':birth_date', $birthDate, \PDO::PARAM_STR);
                    $updatval3->bindParam(':role_id', $roleId, \PDO::PARAM_STR);
            if ($updatval3->execute()) {
                return 1;
            } else {
                return 0;
            }
        } else {
           
                $updatval4 = $this->_pdo->prepare("UPDATE Users 
                SET   last_name = :last_name,
                      first_name = :first_name, 
                      mail = :mail, 
                      phone_number = :phone_number, 
                      registration_number = :registration_number, 
                      modifie_by = :modifie_by, 
                      birth_date = :birth_date, 
                      photo_user = :photo_user, 
                      modifie_date = :modifie_date,
                      role_id = :role_id
                  WHERE id = :id");
                   
            $id = $updatval->getId();
            $Fname = $updatval->getFirst_name();
            $name = $updatval->getName();
            $mail = $updatval->getMail();
            $phone = $updatval->getPhone_number();
            $matricule = $updatval->getRegistration_number();
            $modifieBy = $updatval->getModified_by();
            $modifiedDate = $updatval->getModified_date();
            $birthDate = $updatval->getBirth_date();
            $phot = $updatval->getPhoto_user();
            $updatval4->bindParam(':id', $id, \PDO::PARAM_STR);
            $updatval4->bindParam(':first_name', $Fname, \PDO::PARAM_STR);
            $updatval4->bindParam(':last_name', $name, \PDO::PARAM_STR);
            $updatval4->bindParam(':mail', $mail, \PDO::PARAM_STR);
            $updatval4->bindParam(':phone_number', $phone, \PDO::PARAM_STR);
            $updatval4->bindParam(':registration_number', $matricule, \PDO::PARAM_STR);
            $updatval4->bindParam(':modifie_by', $modifieBy, \PDO::PARAM_STR);
            $updatval4->bindParam(':modifie_date', $modifiedDate, \PDO::PARAM_STR);
            $updatval4->bindParam(':birth_date', $birthDate, \PDO::PARAM_STR);
            $updatval4->bindParam(':photo_user', $phot, \PDO::PARAM_STR);
        

            if ($updatval4->execute()) {
                return 1;
            } else {
                return 0;
            }

        }


    }
  
 
  
  

    /* delete user */
    public function deletedUser(int $id, string $modified): int
    {

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

        $saveDeletedUser = $this->_pdo->prepare("UPDATE Users 
                    SET deleted = :deleted,
                      modifie_by = :modifie_by, 
                      modifie_date = :modifie_date
                  WHERE id = :id");
        $saveDeletedUser->bindParam(':id', $checkId, \PDO::PARAM_STR);
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



