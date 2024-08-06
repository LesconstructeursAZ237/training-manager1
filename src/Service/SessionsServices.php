<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\Sessions;
use App\Controller\LevelsController;
use App\Entity\Role;
use Core\Auth\PasswordHasher;
use Core\FlashMessages\Flash;



class SessionsServices
{
    private \PDO $_pdo;


    public function __construct()
    {
        $connectionManager = new ConnectionManager();
        $this->_pdo = $connectionManager->getConnection();

    }
    public function addSessions(array $sessionsData){

        $newSessions= new Sessions($sessionsData);
        
     $accademic_year= intval($newSessions->getAccademic_year()).'/'.(intval($newSessions->getAccademic_year()) +1);
     $mois= $newSessions->getMois();
     $duree= $newSessions->getDuree();
     $date_de_debut= $newSessions->getDate_de_debut();
     $date_de_fin= $newSessions->getDate_de_fin();

     try {
        
        $saveSessions = $this->_pdo->prepare(
            "INSERT INTO sessions(accademic_year, mois, duree, date_de_debut, date_de_fin)
                VALUES (:accademic_year, :mois, :duree, :date_de_debut, :date_de_fin)"
        );
        $saveSessions->bindParam(':accademic_year', $accademic_year, \PDO::PARAM_STR);
        $saveSessions->bindParam(':mois', $mois, \PDO::PARAM_STR);
        $saveSessions->bindParam(':duree', $duree, \PDO::PARAM_INT);
        $saveSessions->bindParam(':date_de_debut', $date_de_debut, \PDO::PARAM_STR);
        $saveSessions->bindParam(':date_de_fin', $date_de_fin, \PDO::PARAM_STR);

        if ($saveSessions->execute()) {
           
            return 1;
        } 
    } catch (\PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
    }
    public function getSessions(): ? array{
        $query = "SELECT*FROM sessions WHERE statut = 0 AND deleted =0";
        $stmt =$this->_pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $allSessions = [];
        foreach ($result as $al) {
            $oneSessions = new Sessions([
                'id' => $al['id'],
                'accademic_year' => $al['accademic_year'],
                'statut' => $al['statut'],
                'created_date' => $al['created_date'],
                'mois' => $al['mois'],
                'duree' => $al['duree'],
                'date_de_debut' => $al['date_de_debut'],
                'date_de_fin' => $al['date_de_fin'],
            ]);

            $allSessions[] = $oneSessions;
        }
        return $allSessions;
    }



}