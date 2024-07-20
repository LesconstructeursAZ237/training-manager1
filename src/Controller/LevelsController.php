<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\LevelServices;
use App\Controller\UsersController;
use Core\Auth\Auth;
use Core\FlashMessages\Flash;
use App\Entity\Level;

class LevelsController
{
    private LevelServices $levelServices;
    public function __construct()
    {
        $this->levelServices = new LevelServices();
    }
    public function addLevel()
    {   /* existing level */
        $levels = $this->levelServices ->getLevel(); 
        $GLOBALS['levels'] = $levels ;

        if (isset($_SESSION['flashMessage'])) {
            $flashMessage = $_SESSION['flashMessage'];
            $GLOBALS['flashMessage'] = $flashMessage;
        }

        if (isset($_POST['btnAddLevel'])) {
         
                $nameLevel= htmlspecialchars($_POST['NamLevel']);           
                $availabitlity = htmlspecialchars($_POST['availability']);
                if(strlen($nameLevel) !=8){
                    header('location: addLevels.php');
                    $_SESSION['flashMessage'] = 'format ou taille du niveau incorect!';
                    exit; 
                }
                    $level =  $this->levelServices->addLevel($nameLevel, $availabitlity);
                        if ($level == 1) {
                            header('location: addLevels.php');
                            $_SESSION['flashMessage'] = 'ajout reussir!';
                            exit;
                        } 
                        else if ($level == 2) {
                            header('location: addLevels.php');
                            $_SESSION['flashMessage'] = 'ce niveau est deja ajouter et est disponible, vous pouvez modifier!';
                            exit;  
                        }
                        else{
                            header('location: addLevels.php');
                            $_SESSION['flashMessage'] = 'échec ajout du niveau!';
                            exit;
                        }
        }
    }
 public function getLevel(){

    $levels = $this->levelServices ->getLevel(); 
    $GLOBALS['levels'] = $levels ;

    $listLevel = 'Listes des niveaux';
    $GLOBALS['listLevel'] = $listLevel;
    
    if(isset($_SESSION['flashMessage'])){
        $flashMessage = $_SESSION['flashMessage'];
        $GLOBALS['flashMessage'] = $flashMessage;
    }
   
    
  
 }
 public function update(){
    
    if(isset($_SESSION['flashMessage'])){
        $flashMessage = $_SESSION['flashMessage'];
        $GLOBALS['flashMessage'] = $flashMessage;
    }

        if (isset($_POST['btnCloseLevel']) || isset($_POST['btnOpenLevel'])) {
            $level_id = intval($_POST['idUpdateLevel']);
                  /*  echo $level_id; die(); */
            $updateLevel =  $this->levelServices->closeAndOpenLevel($level_id);

            if ($updateLevel==1) {
               
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','mise a jour reuissir!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Level/getLevels.php");
            }

    

        }
    
}

}


