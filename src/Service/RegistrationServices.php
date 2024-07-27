<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\Level;
use App\Entity\User;
use App\Entity\Training;
use App\Controller\RegistrationController;
use App\Entity\Registration;
use App\Entity\Role;
use Core\FlashMessages\Flash;
use App\Service\UsersServices;



class RegistrationServices
{
    private \PDO $_pdo;

    public function __construct()
    {
        $connectionManager = new ConnectionManager();
        $this->_pdo = $connectionManager->getConnection();

    }


    public function getTrainingsOPen(): ?array
    {

        $reqst = "SELECT 
        t.id AS training_id,
        t.code,
        t.descriptions,
        t.durations,
        t.price,
        GROUP_CONCAT(DISTINCT l.id SEPARATOR ', ') AS idlevels,
        GROUP_CONCAT(DISTINCT l.names SEPARATOR ', ') AS level_names,
        l.availabilities
    FROM 
        trainings t
    LEFT JOIN 
        training_levels tl ON t.id = tl.training_id
    LEFT JOIN 
        levels l ON tl.level_id = l.id
    WHERE 
        t.id > :parameter AND l.availabilities =:availabilities
    AND delete_training=:deleteT
    GROUP BY 
        t.id, t.code, t.descriptions, t.durations, t.price
    ORDER BY 
        l.names ASC";



        $getTraining = $this->_pdo->prepare($reqst);
        $getTraining->bindValue(':parameter', 0);
        $getTraining->bindValue(':deleteT', 0);
        $getTraining->bindValue(':availabilities', 'ouvert');
        $getTraining->execute();

        $allTrainings = $getTraining->fetchAll(\PDO::FETCH_ASSOC);
        $trainings = [];
        foreach ($allTrainings as $al) {
            // Séparer les niveaux et les noms
            $levelIds = explode(', ', $al['idlevels']);
            $levelNames = explode(', ', $al['level_names']);
            // Créer une structure associant les IDs aux noms
            $level = array_combine($levelIds, $levelNames);

            $training = new Training([
                'id' => $al['training_id'], // Utiliser l'alias 'training_id' pour 'id'
                'level' => $level,
                'code' => $al['code'],
                'levelAvailabilities' => $al['availabilities'], // Utiliser 'availabilities' pour 'levelAvailabilities'
                'descriptions' => $al['descriptions'],
                'durations' => $al['durations'],
                'price' => $al['price'],
                'levelName' => $al['level_names'],


            ]);
            $trainings[] = $training;
        }

        return $trainings;
    }
    public function addTotableUser(array $personalInformation): int|string
    {
        //print_r($firstName);  die();


        $usersData = new User($personalInformation);
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


        $request1 = "SELECT mail, phone_number FROM users WHERE mail = :mail AND deleted=:deleted";
        $select_request1 = $this->_pdo->prepare($request1);

        $select_request1->bindParam(':mail', $mail1);
        $select_request1->bindValue(':deleted', 0);

        $select_request1->execute();

        // Récupérer le nombre de lignes renvoyées par la requête
        $rowCount = $select_request1->rowCount();
        if ($rowCount > 0) {

            return 'userfound';   //l'utilisateur existe deja

        } else {
            $saveUser = $this->_pdo->prepare("INSERT INTO Users(first_name, last_name, mail, phone_number, birth_date, photo_user, passwords, statut, created_by, role_id)
                        value(:NOM, :PRENOM, :MAIL, :TELEPHONE, :BIRTHD, :PHOT, :PWD, :STATUT ,:CREAT, :ROLEID)");

            $saveUser->bindParam(':NOM', $name1);
            $saveUser->bindParam(':PRENOM', $firstName1);
            $saveUser->bindParam(':MAIL', $mail1);
            $saveUser->bindParam(':TELEPHONE', $phone_number1);
            $saveUser->bindParam(':BIRTHD', $birth_date1);
            $saveUser->bindParam(':PHOT', $photo_user1);
            $saveUser->bindParam(':PWD', $passwords);
            $saveUser->bindValue(':STATUT', 'enregistrer');
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
                        $sql1 = "SELECT id FROM users WHERE mail = :parameter AND statut='enregistrer' AND deleted=0 ";
                        $req = $this->_pdo->prepare($sql1);

                        $req->bindParam(':parameter', $mail1);

                        if ($req->execute()) {
                            $result = $req->fetch(\PDO::FETCH_ASSOC);
                            return $result['id'];
                        } else {
                            return 'echecIdTableUser';
                        }


                    } else {
                        return 'echecMatricule';// echec matricule 

                    }

                } else {
                    return 'echecGeneratedId';// echec sur recuperation id 

                }

            } else {
                return 'requeteNonExecuter';
            }
        }


    }
    public function addToTableRegistration(array $documnetRequired, $studentIs): int|string
    {

        $studentData = new Registration($documnetRequired);

        $cniEtudiant = $studentData->getCniEtudiant();
        $birthCertificate = $studentData->getBirthCertificate();
        $entranceDegree = $studentData->getEntranceDegree();
        $nomDiplome = $studentData->getNomDiplome();
        $accademicYear = date('y');
        $createBy = $studentData->getCreateBy();

        try {
            $registration = $this->_pdo->prepare("INSERT INTO registrations(cni_student,name_of_diploma, entrance_degree, birth_cetificate, 
            created_by ,accademic_year, student_id)
                        value(:cniEtudiant, :name_of_diploma, :entrance_degree, :birth_cetificate, :created_by, :accademic_year, :student_id)");
            $registration->bindParam(':cniEtudiant', $cniEtudiant);
            $registration->bindParam(':name_of_diploma', $nomDiplome);
            $registration->bindParam(':entrance_degree', $entranceDegree);
            $registration->bindParam(':birth_cetificate', $birthCertificate);
            $registration->bindParam(':created_by', $createBy);
            $registration->bindParam(':accademic_year', $accademicYear);
            $registration->bindParam(':student_id', $studentIs);
            if ($registration->execute()) {
                $sql1 = "SELECT id FROM registrations WHERE student_id = :parameter";
                $req = $this->_pdo->prepare($sql1);
                $id = null;
                $req->bindParam(':parameter', $studentIs);

                if ($req->execute()) {
                    $result = $req->fetch(\PDO::FETCH_ASSOC);
                    $id = $result['id'];
                } else {
                    return 'echecIdTableRegistrations';
                }

            }

            return $id;
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }



    public function getRegistrationNUmberUser($idUser): ?string
    {

        $sql1 = "SELECT registration_number FROM users WHERE id = :parameter";
        $req = $this->_pdo->prepare($sql1);

        $req->bindParam(':parameter', $idUser);
        $req->execute();
        if ($req->execute()) {
            $result = $req->fetch(\PDO::FETCH_ASSOC);
            return $result['registration_number'];
        } else {
            return null;
        }

    }
    public function getCodeTrainings($idTraining): ?string
    {

        $sql1 = "SELECT code FROM trainings WHERE id = :parameter";
        $req = $this->_pdo->prepare($sql1);

        $req->bindParam(':parameter', $idTraining);
        $req->execute();
        if ($req->execute()) {
            $result = $req->fetch(\PDO::FETCH_ASSOC);
            return $result['code'];
        } else {
            return null;
        }

    }
    public function getNameLeval($idLevel): ?string
    {

        $sql1 = "SELECT names FROM levels WHERE id = :parameter";
        $req = $this->_pdo->prepare($sql1);

        $req->bindParam(':parameter', $idLevel);
        $req->execute();
        if ($req->execute()) {
            $result = $req->fetch(\PDO::FETCH_ASSOC);
            return $result['names'];
        } else {
            return null;
        }

    }
    public function registrationStudent(array $personalInformation, array $documnet, array $training, array $Level)
    {

        $idTableUsers = $this->addTotableUser($personalInformation);
        if (is_int($idTableUsers)) {

            $idTableRegist = $this->addToTableRegistration($documnet, $idTableUsers);
            if (is_int($idTableRegist)) {
                $lastRegistrationNumber = $this->getRegistrationNUmberUser($idTableUsers);
                $nouveauMAtricule = ''; /* pour stoker le matricule sous forme de chaine de carracetere concatener*/
                foreach ($training as $trainingIndex => $trainingID) {

                    foreach ($Level[$trainingIndex] as $levelIndex => $levelID) {
                        $nameLevel = $this->getNameLeval($levelID);

                        $stringNameLevel = explode('-', $nameLevel);
                        $indexLevel = $stringNameLevel[1];
                        $Matricule = explode('-', $lastRegistrationNumber);

                        $Year = $Matricule[1];
                        $numericLetter = $Matricule[2];
                        $nouveauMAtricule = $nouveauMAtricule . 'IFPLI-' . $Year . $this->getCodeTrainings($trainingID) . $indexLevel . '-' . $numericLetter . '+';

                        try {
                            // Préparer et exécuter la requête d'insertion
                            $registration = $this->_pdo->prepare(
                                "INSERT INTO registration_trainings(registration_id, training_id, level_id)
                                VALUES (:registration_id, :training_id, :level_id)"
                            );
                            $registration->bindParam(':registration_id', $idTableRegist, \PDO::PARAM_INT);
                            $registration->bindParam(':training_id', $trainingID, \PDO::PARAM_INT);
                            $registration->bindParam(':level_id', $levelID, \PDO::PARAM_INT);

                            if (!$registration->execute()) {
                                return 'echecExecutedRequest';
                            }
                        } catch (\PDOException $e) {
                            return "Erreur : " . $e->getMessage();
                        }
                    }
                }

                $updateMatricule = $this->_pdo->prepare("UPDATE Users 
                SET registration_number = :Mat
                  WHERE id = :id");
                $updateMatricule->bindParam(':id', $idTableUsers, \PDO::PARAM_STR);
                $updateMatricule->bindParam(':Mat', $nouveauMAtricule, \PDO::PARAM_STR);

                $updateMatricule->execute();
                if ($updateMatricule) {
                    // Si tout s'est bien passé
                    return 'succes';
                } else {
                    // Si tout s'est bien passé
                    return 'echecToUpdateMatricule';
                }



            } else {
                return $idTableRegist;
            }

        } else {
            return $idTableUsers;
        }

    }

    public function getAll0($limit = 10, $offset = 0)
    {
        $reqst = "SELECT
            u.id AS usersId,
            u.last_name AS UsersLastNames,
            u.first_name AS UsersFirstNames,
            u.mail AS UsersMail,
            u.phone_number AS UsersPhone,
            u.photo_user AS UsersPhoto,
            u.registration_number AS matriculeStudent,
            GROUP_CONCAT(DISTINCT t.code ORDER BY t.code SEPARATOR ', ') AS trainingsCode,
            GROUP_CONCAT(DISTINCT l.names ORDER BY l.names SEPARATOR ', ') AS levelsNames
        FROM 
            users u
            LEFT JOIN registrations r ON u.id = r.student_id
            LEFT JOIN registration_trainings rt ON r.id = rt.registration_id
            LEFT JOIN trainings t ON rt.training_id = t.id
            LEFT JOIN levels l ON rt.level_id = l.id
        WHERE 
            u.deleted = :deleteU 
        GROUP BY 
            u.id
        ORDER BY 
            u.id ASC";


        try {
            // Préparation de la requête
            $getStudent = $this->_pdo->prepare($reqst);

            // Lier les valeurs des paramètres
            // $getStudent->bindValue(':parameter', 0, \PDO::PARAM_INT);
            $getStudent->bindValue(':deleteU', 0, \PDO::PARAM_INT);

            // Exécution de la requête
            $getStudent->execute();

            // Récupération des résultats
            $allStudent = $getStudent->fetchAll(\PDO::FETCH_ASSOC);

            // Création des objets User
            $users = [];
            foreach ($allStudent as $al) {
                $user = new User([
                    '_id' => $al['usersId'],
                    '_name' => $al['UsersLastNames'],
                    '_first_name' => $al['UsersFirstNames'],
                    '_mail' => $al['UsersMail'],
                    '_phone_number' => $al['UsersPhone'],
                    '_photo_user' => $al['UsersPhoto'],
                    '_registration_number' => $al['matriculeStudent'],
                    'codeTraining' => $al['trainingsCode'],
                    'nameLevel' => $al['levelsNames'],
                ]);

                $users[] = $user;
            }

            return $users;

        } catch (\PDOException $e) {
            // Gestion des erreurs
            throw new \Exception("Erreur lors de la récupération des utilisateurs: " . $e->getMessage());
        }
    }
    
    public function getAll($page = 1, $usersPerPage = 5)
    {
        $offset = ($page - 1) * $usersPerPage;
    
        // Requête SQL pour récupérer les utilisateurs et leurs formations associées avec pagination
        $reqst = "SELECT
            u.id AS usersId,
            u.last_name AS UsersLastNames,
            u.first_name AS UsersFirstNames,
            u.mail AS UsersMail,
            u.phone_number AS UsersPhone,
            u.photo_user AS UsersPhoto,
            u.registration_number AS matriculeStudent,
            GROUP_CONCAT(
                DISTINCT CONCAT(t.code, ' - ', l.names) 
                ORDER BY t.code, l.names 
                SEPARATOR ', '
            ) AS trainingsWithLevels
        FROM 
            users u
            INNER JOIN registrations r ON u.id = r.student_id
            INNER JOIN registration_trainings rt ON r.id = rt.registration_id
            LEFT JOIN trainings t ON rt.training_id = t.id
            LEFT JOIN levels l ON rt.level_id = l.id
        WHERE 
            u.deleted = :parameter
        GROUP BY 
            u.id
        ORDER BY 
            u.id ASC
        LIMIT :limit OFFSET :offset";
    
        try {
            $getStudent = $this->_pdo->prepare($reqst);
            $getStudent->bindValue(':parameter', 0, \PDO::PARAM_INT);
            $getStudent->bindValue(':limit', $usersPerPage, \PDO::PARAM_INT);
            $getStudent->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $getStudent->execute();
    
            $allStudent = $getStudent->fetchAll(\PDO::FETCH_ASSOC);
            $users = [];
    
            foreach ($allStudent as $al) {
                $user = new User([
                    '_id' => $al['usersId'],
                    '_name' => $al['UsersLastNames'],
                    '_first_name' => $al['UsersFirstNames'],
                    '_mail' => $al['UsersMail'],
                    '_phone_number' => $al['UsersPhone'],
                    '_photo_user' => $al['UsersPhoto'],
                    '_registration_number' => $al['matriculeStudent'],
                    'trainingwithLevel' => $al['trainingsWithLevels'],
                ]);
    
                $users[] = $user;
            }
    
            return $users;
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
    public function getTotalStudents()
{
    $totalStudentsReq = $this->_pdo->query("
        SELECT COUNT(DISTINCT u.id) AS total
        FROM users u
        INNER JOIN registrations r ON u.id = r.student_id
        INNER JOIN registration_trainings rt ON r.id = rt.registration_id
        WHERE u.deleted = 0
    ");
    return $totalStudentsReq->fetchColumn();
}

    
    public function saveImageUsers(array $infoPhoto) {

        define('IMG_USERS_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR);
    

        $nom_de_mon_fichier = basename($infoPhoto["name"]);
    

        $chemin_destination = IMG_USERS_PATH . $nom_de_mon_fichier;

        if (file_exists($chemin_destination)) {
            $dateActuel = date('Y-m-d H:i:s'); 
     
            $date_sans_espacement = str_replace(' ', '', $dateActuel);
            $date_sans_double_point = str_replace(':', '', $date_sans_espacement);
            $date_sans_double_tiret = str_replace('-', '', $date_sans_double_point);
            $nom_fichier_a_sauvegarder = $date_sans_double_tiret . '_' . $nom_de_mon_fichier;
            $nouveau_chemin_destination = IMG_USERS_PATH . $nom_fichier_a_sauvegarder;
    
  
            if (move_uploaded_file($infoPhoto["tmp_name"], $nouveau_chemin_destination)) {
                return $nom_fichier_a_sauvegarder;
            } else {
                return null;
            }
        } else {
         
            if (move_uploaded_file($infoPhoto["tmp_name"], $chemin_destination)) {
                return $nom_de_mon_fichier;
            } else {
                return null;
            }
        }
    }
    public function saveDocumentUsers(array $infoPhoto) {

        if (!defined('DOCUMENT_ALL_PATH')) {
        define('DOCUMENT_ALL_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'documents' . DIRECTORY_SEPARATOR);

        }
    

        $nom_de_mon_fichier = basename($infoPhoto["name"]);
    

        $chemin_destination = DOCUMENT_ALL_PATH . $nom_de_mon_fichier;

        if (file_exists($chemin_destination)) {
            $dateActuel = date('Y-m-d H:i:s'); 
     
            $date_sans_espacement = str_replace(' ', '', $dateActuel);
            $date_sans_double_point = str_replace(':', '', $date_sans_espacement);
            $date_sans_double_tiret = str_replace('-', '', $date_sans_double_point);
            $nom_fichier_a_sauvegarder = $date_sans_double_tiret . '_' . $nom_de_mon_fichier;
            $nouveau_chemin_destination = DOCUMENT_ALL_PATH . $nom_fichier_a_sauvegarder;
    
  
            if (move_uploaded_file($infoPhoto["tmp_name"], $nouveau_chemin_destination)) {
                return $nom_fichier_a_sauvegarder;
            } else {
                return null;
            }
        } else {
         
            if (move_uploaded_file($infoPhoto["tmp_name"], $chemin_destination)) {
                return $nom_de_mon_fichier;
            } else {
                return null;
            }
        }
    }
    
    public function saveImgProjet(array $infoPhoto) {
   

        define('IMG_PROJET_PAHT', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'projet' . DIRECTORY_SEPARATOR);

        $nom_de_mon_fichier = basename($infoPhoto["name"]);
    

        $chemin_destination = IMG_PROJET_PAHT. $nom_de_mon_fichier;

        if (file_exists($chemin_destination)) {
            $dateActuel = date('Y-m-d H:i:s'); 
     
            $date_sans_espacement = str_replace(' ', '', $dateActuel);
            $date_sans_double_point = str_replace(':', '', $date_sans_espacement);
            $date_sans_double_tiret = str_replace('-', '', $date_sans_double_point);
            $nom_fichier_a_sauvegarder = $date_sans_double_tiret . '_' . $nom_de_mon_fichier;
            $nouveau_chemin_destination = IMG_PROJET_PAHT . $nom_fichier_a_sauvegarder;
    
  
            if (move_uploaded_file($infoPhoto["tmp_name"], $nouveau_chemin_destination)) {
                return $nom_fichier_a_sauvegarder;
            } else {
                return null;
            }
        } else {
         
            if (move_uploaded_file($infoPhoto["tmp_name"], $chemin_destination)) {
                return $nom_de_mon_fichier;
            } else {
                return null;
            }
        }
    }
    
        public function getNotRegisteredTrainings($userId) {
        try {
            // Requête pour obtenir toutes les formations
            $allTrainingsReq = "SELECT id, code FROM trainings";
            $getAllTrainings = $this->_pdo->prepare($allTrainingsReq);
            $getAllTrainings->execute();
            $allTrainings = $getAllTrainings->fetchAll(\PDO::FETCH_ASSOC);
    
            // Requête pour obtenir les formations auxquelles l'utilisateur est inscrit
            $userTrainingsReq = "SELECT DISTINCT t.id, t.code 
                FROM trainings t
                INNER JOIN registration_trainings rt ON t.id = rt.training_id
                INNER JOIN registrations r ON rt.registration_id = r.id
                WHERE r.student_id = :userId";
            $getUserTrainings = $this->_pdo->prepare($userTrainingsReq);
            $getUserTrainings->bindValue(':userId', $userId, \PDO::PARAM_INT);
            $getUserTrainings->execute();
            $userTrainings = $getUserTrainings->fetchAll(\PDO::FETCH_ASSOC);
    
            // Convertir les résultats en tableaux associatifs pour un accès plus facile
            $userTrainingCodes = array_column($userTrainings, 'code');
            $userTrainingIds = array_column($userTrainings, 'id');
    
            // Filtrer les formations disponibles en excluant celles auxquelles l'utilisateur est inscrit
            $notRegisteredTrainings = array_filter($allTrainings, function ($training) use ($userTrainingIds) {
                return !in_array($training['id'], $userTrainingIds);
            });
    
            return $notRegisteredTrainings;
    
        } catch (\PDOException $e) {
            // Gestion des erreurs
            return "Erreur : " . $e->getMessage();
        }
    }
    

}
