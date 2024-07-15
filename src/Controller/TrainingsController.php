<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\TrainingsServices;
use App\Service\LevelServices;
class TrainingsController
{
  private TrainingsServices $trainingsServices;
  private LevelServices $levelServices;
  
  

  public function __construct(){
      $this->trainingsServices = new TrainingsServices();
      $this->levelServices = new LevelServices();
      
  }
  
    public function addTraining(){
        $SE1 = new SessionManager();
            
        $levels = (new LevelServices())->getLevel();
        $GLOBALS['levels'] = $levels ;

        if(isset($_SESSION['flashMessage'])){
            $flashMessage = $_SESSION['flashMessage'];
            $GLOBALS['flashMessage'] = $flashMessage;
        }

        if (isset( $_SESSION['auth_user'])){
            $auth_user=($_SESSION['auth_user']);
            $GLOBALS['auth_user'] = $auth_user;
        }

        if(isset($_POST['btnAddTraining'])){
            $code = htmlspecialchars($_POST['codes']);
            $description = htmlspecialchars(trim($_POST['descriptions']));
            $prices = $_POST['prices'];
            $durations = $_POST['durations'];
            $modified = $_POST['modified'];
            if (isset($_POST['trainingAddLevel']) && is_array($_POST['trainingAddLevel'])  && !empty($_POST['trainingAddLevel'])) {
                $selectedLevels = $_POST['trainingAddLevel']; 

                $saveTaining= $this->trainingsServices->addTraining( $code, $description, $prices, $durations, $modified, $_POST['trainingAddLevel']);
               
                switch($saveTaining){
                    case 1:
                        $SE1->set('flashMessage','a jout reuisir!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/Trainings.php");
                    exit;
                    case 0:
                            
                        $SE1->set('flashMessage',' echec d\'enregistrement de formation, reéssayer!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/Trainings.php");
                    exit;
                    case 2:
                        $SE1->set('flashMessage',' la formation existe déja!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/Trainings.php");
                    exit;
                    case 5:
                        $SE1->set('flashMessage',' echec de liaisaon entre niveau et formation!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/Trainings.php");
                    exit;
                    default:
                    $SE1->set('flashMessage',' echec!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Trainings/Trainings.php");
                exit;

                        
                        

                }                            
            }else{
            
                $SE1->set('flashMessage',' echec: choix du ou des niveau(x) manquant!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Trainings/Trainings.php");

            exit;
            }
    }
      
    }

    public function getTrainings(){
        
        $trainings = $this->trainingsServices ->getTrainings(); 
        $GLOBALS['trainings'] = $trainings ;

        $listTraining = 'Listes des formations et niveaux';
        $GLOBALS['listTraining'] = $listTraining;
        
        
    }
    public function updateTraining(){
        $slt='OK BONJOUR';
        $GLOBALS['slt']=$slt;
        if(isset($_SESSION['flashMessage'])){
            $flashMessage = $_SESSION['flashMessage'];
            $GLOBALS['flashMessage'] = $flashMessage;
        }

        if(isset($_POST['name="closeLevel"']) || isset($_POST['name="openLevel"'] ))
        $levelId="";  
        $levelId = intval($this->trainingsServices ->getIdOneElement('levels','names',$_POST['levelName'])); 
        $up = new LevelServices();
        $updateLevel = $up->closeAndOpenLevel($levelId);

        if($updateLevel==1){
            $SE1 = new SessionManager();
            $SE1->set('flashMessage','mise a jour reuissir!');
            $_SESSION['flashMessage'] = $SE1->get('flashMessage');
            header("location: ./../Trainings/getTrainings.php");
        }
        else{
            $SE1 = new SessionManager();
            $SE1->set('flashMessage','mise a jour reuissir!');
            $_SESSION['flashMessage'] = $SE1->get('flashMessage');
            header("location: ./../Trainings/getTrainings.php");
        }

        
     
    }
    
}