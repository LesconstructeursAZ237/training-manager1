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

    public function registrationTraining(string $codes, string $descriptions, $prices, $durations, array $modified=null): int
    {
        //print_r($firstName);  die();

        $user1 = new Training('', $codes, $descriptions, $prices, $durations, $modified);
        $code1 = $user1->getCode();
        $descriptions1 = $user1->getDescription();
        $prices1 = $user1->getPrice();
        $durations1 = $user1->getDurations();
        $modified1 = $user1->getModified();

        global $var_retour;


        $request1 = "SELECT code FROM trainings WHERE code = :CODE ";
        $select_request1 = $this->_pdo->prepare($request1);

        $select_request1->bindParam(':CODE', $code1);

        $select_request1->execute();
        // Récupérer le nombre de lignes renvoyées par la requête
        $rowCount = $select_request1->rowCount();
        if ($rowCount > 0) {

            return 10;   //formation existe deja existe deja
        } else {
            $saveTraining = $this->_pdo->prepare("INSERT INTO trainings(code, descriptions, price, durations)
            value(:CODE, :DESCRIPT, :PRICE, :DURATIONS)");

            $saveTraining->bindParam(':CODE', $code1);
            $saveTraining->bindParam(':DESCRIPT', $descriptions1);
            $saveTraining->bindParam(':PRICE', $prices1);
            $saveTraining->bindParam(':DURATIONS', $durations1);

            $saveTraining->execute();
            if($saveTraining->execute()){
                return 1;
            }
            else{
                return 11;
            }

        }
    }

}