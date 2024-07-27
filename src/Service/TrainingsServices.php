<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Entity\Level;
use Core\Database\ConnectionManager;
use App\Entity\Training;


class TrainingsServices
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
    public function getIdOneElement($tableName, $columName, $close): ?int
    {

        $sql1 = "SELECT id FROM $tableName WHERE $columName = :parameter ";
        $req = $this->_pdo->prepare($sql1);

        $req->bindParam(':parameter', $close);
        $req->execute();
        $result = $req->fetch(\PDO::FETCH_ASSOC);
        return $result['id'];
    }
    public function AddTrainingToLevel(string $codeT, string $levelName): int
    {

        $trainingData = [
            'code' => $codeT,
            'level' => $levelName,
        ];

        $trainingDatas = new Training($trainingData);
        $code = $trainingDatas->getCode();
        $levelNam = $trainingDatas->getLevel();

        /* found id new training */

        $idTraining = $this->getIdOneElement('trainings', 'code', $code);
        /* find id level */
        $idLevel = $this->getIdOneElement('levels', 'names', $levelNam);
        /* table traning_levels */
        $saveTrainingAndLevel = $this->_pdo->prepare("INSERT INTO training_levels(training_id, level_id)
            value(:IDTRAINING, :IDLEVEL)");

        $saveTrainingAndLevel->bindParam(':IDTRAINING', $idTraining);
        $saveTrainingAndLevel->bindParam(':IDLEVEL', $idLevel);

        if ($saveTrainingAndLevel->execute()) {
            return 1; /* succes */
        } else {
            return 0; /* !insert values of table training_levels: failed operation! */
        }
    }
    public function addTraining(string $codes, string $descriptions, $prices, $durations, string $modified, array $selectedLevels): int
    {
        //print_r($firstName);  die();

        $trainingData = [
            'code' => $codes,
            'descriptions' => $descriptions,
            'price' => $prices,
            'durations' => $durations,
            'modified' => $modified,
        ];
        $trainingDatas = new Training($trainingData);
        $code1 = $trainingDatas->getCode();
        $descriptions1 = $trainingDatas->getDescriptions();
        $prices1 = $trainingDatas->getPrice();
        $durations1 = $trainingDatas->getDurations();
        $modified1 = $trainingDatas->getModified();

        $sql = "SELECT code FROM trainings WHERE code = :CODE ";
        $request = $this->_pdo->prepare($sql);

        $request->bindParam(':CODE', $code1);

        $request->execute();
        /* Récupérer le nombre de lignes renvoyées par la requête*/
        $rowCount = $request->rowCount();
        if ($rowCount > 0) {

            return 2;   /*formation existe deja existe deja*/
        } else {


            $idUserModified = "SELECT id FROM users WHERE mail = :parameter AND deleted =0 AND statut = 'non' AND role_id =3 ";
            $reqt = $this->_pdo->prepare($idUserModified);

            $reqt->bindParam(':parameter', $modified1);
            $reqt->execute();
            $result = $reqt->fetch(\PDO::FETCH_ASSOC);
            $useID = $result['id'];

            $saveTraining = $this->_pdo->prepare("INSERT INTO trainings(code, descriptions, price, durations, modified)
            value(:CODE, :DESCRIPT, :PRICE, :DURATIONS, :MODIFIED)");

            $saveTraining->bindParam(':CODE', $code1);
            $saveTraining->bindParam(':DESCRIPT', $descriptions1);
            $saveTraining->bindParam(':PRICE', $prices1);
            $saveTraining->bindParam(':DURATIONS', $durations1);
            $saveTraining->bindParam(':MODIFIED', $useID);

            if ($saveTraining->execute()) {

                foreach ($selectedLevels as $oneLevel) {
                    $addTainingToLevel = $this->AddTrainingToLevel($code1, $oneLevel);
                }
                if ($addTainingToLevel == 1) {
                    return 1; /* Done or succes */
                } else {
                    return 5;
                }


            } else {
                return 0; /* failed */
            }

        }

    }
    public function getTrainings(): ?array
    {

        $reqst = "SELECT 
        t.id AS training_id,
        t.code,
        t.descriptions,
        t.durations,
        t.price,
        GROUP_CONCAT(DISTINCT l.names SEPARATOR ', ') AS levels,
        l.availabilities
    FROM 
        trainings t
    LEFT JOIN 
        training_levels tl ON t.id = tl.training_id
    LEFT JOIN 
        levels l ON tl.level_id = l.id
    WHERE 
        t.id > :parameter
    AND delete_training=:deleteT
    GROUP BY 
        t.id, t.code, t.descriptions, t.durations, t.price
    ORDER BY 
        l.names ASC";



        $getTraining = $this->_pdo->prepare($reqst);
        $getTraining->bindValue(':parameter', 0);
        $getTraining->bindValue(':deleteT', 0);
        $getTraining->execute();

        $allTrainings = $getTraining->fetchAll(\PDO::FETCH_ASSOC);
        $trainings = [];
        foreach ($allTrainings as $al) {
            $training = new Training([
                'id' => $al['training_id'], // Utiliser l'alias 'training_id' pour 'id'
                'levelName' => $al['levels'], // Utiliser l'alias 'levels' pour 'levelName'
                'code' => $al['code'],
                'levelAvailabilities' => $al['availabilities'], // Utiliser 'availabilities' pour 'levelAvailabilities'
                'descriptions' => $al['descriptions'],
                'durations' => $al['durations'],
                'price' => $al['price'],

            ]);
            $trainings[] = $training;
        }

        return $trainings;
    }

    public function delete(array $data): int
    {
        $trainingDatas = new Training($data);

        $deleteTraining = $this->_pdo->prepare("
        UPDATE trainings 
        SET delete_training = :deleteT,
            modified_by = :modified_by
        WHERE id = :id AND code = :code
    ");


        $modified = $trainingDatas->getModified();
        $idTraining = $trainingDatas->getId();
        $codeT = $trainingDatas->getCode();


        $deleteTraining->bindValue(':deleteT', 1, \PDO::PARAM_INT);
        $deleteTraining->bindParam(':modified_by', $modified, \PDO::PARAM_STR);
        $deleteTraining->bindParam(':id', $idTraining, \PDO::PARAM_STR);
        $deleteTraining->bindParam(':code', $codeT, \PDO::PARAM_STR);


        if ($deleteTraining->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update(array $data, array $tabLevel=null): int
    {
        
if(empty($tabLevel)){
    
    $trainingDatas = new Training($data);

    $code = $trainingDatas->getCode();
    $descript = $trainingDatas->getDescriptions();
    $dure = intval($trainingDatas->getDurations());
    $price = $trainingDatas->getPrice();
    $modified = $trainingDatas->getModified();
    $id = intval($trainingDatas->getId());

    // print_r($trainingDatas);  die();

    $update = $this->_pdo->prepare("
        UPDATE trainings 
            SET code = :code,
            durations = :durations,
            price = :price,
            descriptions = :descriptions,
            modified_by = :modified_by
            WHERE id = :id
    ");


    $update->bindParam(':id', $id, \PDO::PARAM_INT);
    $update->bindParam(':code', $code, \PDO::PARAM_STR);
    $update->bindParam(':price', $price, \PDO::PARAM_STR);
    $update->bindParam(':durations', $dure, \PDO::PARAM_INT);
    $update->bindParam(':descriptions', $descript, \PDO::PARAM_STR);
    $update->bindParam(':modified_by', $modified, \PDO::PARAM_STR);

    $update->execute();
    if ($update) {
        return 1;
    } else {
        return 0;
    }
}else{
    $trainingDatas = new Training($data);

    $code = $trainingDatas->getCode();
    $descript = $trainingDatas->getDescriptions();
    $dure = intval($trainingDatas->getDurations());
    $price = $trainingDatas->getPrice();
    $modified = $trainingDatas->getModified();
    $id = intval($trainingDatas->getId());

    

    $update = $this->_pdo->prepare("
        UPDATE trainings 
            SET code = :code,
            durations = :durations,
            price = :price,
            descriptions = :descriptions,
            modified_by = :modified_by
            WHERE id = :id
    ");


    $update->bindParam(':id', $id, \PDO::PARAM_INT);
    $update->bindParam(':code', $code, \PDO::PARAM_STR);
    $update->bindParam(':price', $price, \PDO::PARAM_STR);
    $update->bindParam(':durations', $dure, \PDO::PARAM_INT);
    $update->bindParam(':descriptions', $descript, \PDO::PARAM_STR);
    $update->bindParam(':modified_by', $modified, \PDO::PARAM_STR);

    $update->execute();
    if ($update) {
        foreach ($tabLevel as $oneLevel) {
            
            $addTainingToLevel = $this->AddTrainingToLevel($code, $oneLevel);
        }
        if ($addTainingToLevel == 1) {
            return 1; /* Done or succes */
        } else {
            return 0;
        }
        
    } else {
        return 0;
    }
}

    }
    /*fonction pour sélectionner les niveaux qui ne sont pas associés au training spécifié*/
    public function getLevelsNotInTraining(int $trainingId): ?array
    {
        /* 1. Exécution de la première requête pour obtenir les level_id*/

        $sql1 = "SELECT tl.level_id
         FROM training_levels tl
         WHERE tl.training_id = :training_id";

        $st1 = $this->_pdo->prepare($sql1);
        $st1->bindValue(':training_id', $trainingId, \PDO::PARAM_INT);
        $st1->execute();
        $resultat = $st1->fetchAll(\PDO::FETCH_ASSOC);
           
        /* 2. Convertir les résultats en un tableau de valeurs*/
        $levelIds = [];
        foreach ($resultat as $row) {
            $levelIds[] = (int) $row['level_id'];
        }

        /* 3. Convertir le tableau en une chaîne de caractères compatible avec SQL*/
        if (empty($levelIds)) {
            // Si le tableau est vide, définissez une valeur qui ne correspondra à aucun ID
            return NULL;
        } else {
            $levelIdsString = implode(', ', $levelIds);
            /* 4. Utiliser cette chaîne de caractères dans la clause NOT IN de la deuxième requête*/
            $req = "SELECT l.*
                FROM levels l
                WHERE l.id NOT IN ($levelIdsString)
                ORDER BY l.names ASC";

            try {
                /* Préparer et exécuter la requête*/
                $st2 = $this->_pdo->prepare($req);
                $st2->execute();

                // Récupérer les résultats
                $levelsNotInTraining = $st2->fetchAll(\PDO::FETCH_ASSOC);
                $dataLevelsNotInTraining = [];
                foreach ($levelsNotInTraining as $lev) {
                    $level = [
                        '_id' => $lev['id'],
                        '_gradeLevel' => $lev['names'],
                        '_availabilities' => $lev['availabilities'],
                    ];
                    $dataLevelsNotInTraining[] = $level;
                }
                return $dataLevelsNotInTraining;

            } catch (\PDOException $e) {
                // Gérer les erreurs
                die("Erreur lors de la récupération des niveaux : " . $e->getMessage());
            }
        }



    }


}
