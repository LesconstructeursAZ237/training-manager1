<?php

declare(strict_types=1);

namespace App\Service;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Database\ConnectionManager;
use App\Entity\Level;
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
            '_availability' => $availabitlity,

        ];
     
        $LevelDatas = new Level($LevelData);
        $levelGrade = $LevelDatas->getGradeLevel();
        $availabitlityL = $LevelDatas->getAvailability();

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

}