<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\Level;
use App\Controller\LevelsController;
use App\Entity\Role;
use Core\Auth\PasswordHasher;
use Core\FlashMessages\Flash;



class LevelServices
{
    private \PDO $_pdo;


    public function __construct()
    {
        $connectionManager = new ConnectionManager();
        $this->_pdo = $connectionManager->getConnection();

    }
    public function addLevel($grade, $availabitlity): int
    {
        $LevelData = [
            '_gradeLevel' => $grade,
            '_availabilities' => $availabitlity,

        ];
     
        $LevelDatas = new Level($LevelData);
        $levelGrade = $LevelDatas->getGradeLevel();
        $availabitlityL = $LevelDatas->getAvailabilities();

        $sql = $this->_pdo->prepare("SELECT * FROM levels WHERE names =:names");
        $sql->bindParam(':names', $levelGrade);

        $sql->execute();

        $result = $sql->rowCount();

        if ($result > 0) {
            return 2;
        }
        else
        {
            $saveLevel = $this->_pdo->prepare("INSERT INTO levels( names, availabilities)
            value(:NAMES, :AV)");
    
            $saveLevel->bindParam(':NAMES', $levelGrade);
            $saveLevel->bindParam(':AV', $availabitlityL);
    
            if ($saveLevel->execute()) {
                return 1;
            }
            else
            {
               return 0;
            }

        }   
      

    }
    public function getLevel(): ? array
    {
        $sql = $this->_pdo->prepare("SELECT * FROM levels WHERE id > :id    ORDER BY names ASC");
        $sql->bindValue(':id', 0);

        $sql->execute();
        $allLevels = $sql->fetchAll(\PDO::FETCH_ASSOC);
        $levels = [];
        foreach ($allLevels as $levelData) {
            $level = new Level([
                '_id' => $levelData['id'],
                '_gradeLevel' => $levelData['names'],           
                '_availabilities' => $levelData['availabilities']
            ]);
            $levels[] = $level; 
        }
        return $levels;
    }
    public function closeAndOpenLevel($Id){

        $LevelData = [
            '_id' => $Id

        ];
        $LevelDatas = new Level($LevelData);
        $checkId = intval($LevelDatas->getId());
        $sql1 = "SELECT availabilities FROM levels WHERE id= :paramet ";
        $req = $this->_pdo->prepare($sql1);

        $req->bindParam(':paramet', $checkId);
        $req->execute();

        $result = $req->fetch(\PDO::FETCH_ASSOC);
        $defaultAvailabilities = $result['availabilities'];
            if($defaultAvailabilities=='ouvert'){
                $updateL = $this->_pdo->prepare("UPDATE levels 
                SET availabilities = :availabilities             
                WHERE id = :id");
                  $updateL->bindParam(':id', $checkId, \PDO::PARAM_STR);
                  $updateL->bindValue(':availabilities', 'fermer', \PDO::PARAM_STR);
                  if($updateL->execute()){
                    return 1;
                }
                else{
                    return 0;
                } 
            }
            else{
                $updateL = $this->_pdo->prepare("UPDATE levels 
                SET availabilities = :availabilities             
                WHERE id = :id");
                  $updateL->bindParam(':id', $checkId, \PDO::PARAM_STR);
                  $updateL->bindValue(':availabilities', 'ouvert', \PDO::PARAM_STR);
                  if($updateL->execute()){
                    return 1;
                }
                else{
                    return 0;
                }
            }

    }

    

}
