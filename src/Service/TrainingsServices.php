<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

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
    public function getIdOneElement($tableName, $columName, $close)
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
            $saveTraining->bindParam(':MODIFIED', $useID );

            if ($saveTraining->execute()) {

                foreach($selectedLevels as $oneLevel){
                    $addTainingToLevel = $this->AddTrainingToLevel($code1,$oneLevel);                   
                }
                if($addTainingToLevel == 1){
                    return 1; /* Done or succes */      
                }
                else{
                    return 5;
                }

               
            } else {
                return 0; /* failed */
            }

        }

    }
    public function getTrainings(): ? array{
               
                 $reqst = "SELECT t.*, l.*, tl.*
                  FROM trainings t
                  LEFT JOIN training_levels tl ON t.id = tl.training_id
                  LEFT JOIN levels l ON tl.level_id = l.id
                  WHERE t.id > :parameter 
                  ORDER BY t.code ASC ";

                    $getTraining = $this->_pdo->prepare($reqst);
                    $getTraining->bindValue(':parameter',0);
                    $getTraining->execute();

            $allTrainings = $getTraining->fetchAll(\PDO::FETCH_ASSOC);
        $trainings = [];
        foreach ($allTrainings as $al) {
            $training = new Training([
                'id' => $al['id'],
                'code' => $al['code'],           
                'price' => $al['price'],
                'durations' => $al['durations'],
                'descriptions' => $al['descriptions'],
                'levelName' => $al['names'],
                'levelAvailabilities' => $al['availabilities'],             

            ]);
            $trainings[] = $training; 
        }

        return $trainings;
    }
  

}
