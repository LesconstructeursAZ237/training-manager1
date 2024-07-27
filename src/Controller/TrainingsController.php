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
            if(!$_POST['modified'] || empty($_POST['modified'])){
                $_SESSION['flashMessage']='veuillez vous connecter pour ajouter une formations!';
                    header("location: ./../Users/signin.php");
                    exit;
            }
            if(empty($code) || empty($description) || empty($prices) || empty($durations)){
                $_SESSION['flashMessage']='échec de chargement des données, réessayer!';
                    header("location: ./../Trainings/addTrainings.php");
                    exit;
            }
            $modified = $_POST['modified']; 
            if (isset($_POST['trainingAddLevel']) && is_array($_POST['trainingAddLevel'])  && !empty($_POST['trainingAddLevel'])) {
                $selectedLevels = $_POST['trainingAddLevel']; 

                $saveTaining= $this->trainingsServices->addTraining( $code, $description, $prices, $durations, $modified, $_POST['trainingAddLevel']);
               
                switch($saveTaining){
                    case 1:
                        $SE1->set('flashMessage','a jout reuisir!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/addTrainings.php");
                    exit;
                    case 0:
                            
                        $SE1->set('flashMessage',' echec d\'enregistrement de formation, reéssayer!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/addTrainings.php");
                    exit;
                    case 2:
                        $SE1->set('flashMessage',' la formation existe déja!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/addTrainings.php");
                    exit;
                    case 5:
                        $SE1->set('flashMessage',' echec de liaisaon entre niveau et formation!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Trainings/addTrainings.php");
                    exit;
                    default:
                    $SE1->set('flashMessage',' echec!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Trainings/addTrainings.php");
                exit;

                        
                        

                }                            
            }else{
            
                $SE1->set('flashMessage',' echec: choix du ou des niveau(x) manquant!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Trainings/addTrainings.php");

            exit;
            }
    }
      
    }

    public function getTrainings(){
        
        $trainings = $this->trainingsServices ->getTrainings(); 
        $GLOBALS['trainings'] = $trainings ;

        $listTraining = 'Listes des formations.';
        $GLOBALS['listTraining'] = $listTraining;

        
    }
    public function updateTraining(){

        $trainings = $this->trainingsServices ->getTrainings(); 
        $GLOBALS['trainings'] = $trainings ;

        if(isset($_SESSION['flashMessage'])){
            $flashMessage = $_SESSION['flashMessage'];
            $GLOBALS['flashMessage'] = $flashMessage;
        }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if (isset($_POST['btnUpdateTraining'])) {
                if(!$_POST['modifiedVAL']){
                    header("location: ./../Users/signin.php");
                exit;
                }
                $data=[
                    'id' => $_POST['TrainingID'], 
                  'code'=> $_POST['newCodes'], 
                   'descriptions'=>$_POST['newDescriptions'],
                   'price'=>$_POST['newPrices'],
                   'durations'=>$_POST['newduree'],
                   'modified'=>$_POST['modifiedVAL'],
                ];
                $tabLevel='';
            if(isset($_POST['LevelsNotInTraining']) ){
                $trainings = $this->trainingsServices ->update($data, $_POST['LevelsNotInTraining']); 
                if($trainings==1){
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','mise a jour reuissir!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Trainings/getTrainings.php");
                    exit;   
                }
                else{
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','échec de modification!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Trainings/getTrainings.php");
                    exit;  
                }
            }else{
                                
           $trainings = $this->trainingsServices ->update($data); 
                if($trainings==1){
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','mise a jour reuissir!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Trainings/getTrainings.php");
                    exit;   
                }
                else{
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','échec de modification!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Trainings/getTrainings.php");
                    exit;  
                }
            } 
             }
        
            }
            if (isset($_POST['btnModifier'])) {
            
                $idTraining = $_POST['idSelectModifiedTraining'];
                $arrayTrainintg=explode(',', $idTraining);
                $_SESSION['arrayTrainintg'] = $arrayTrainintg;
                header("location: ./../Trainings/updateTrainings.php");

                $LevelsNotInTraining = $this->trainingsServices->getLevelsNotInTraining(intval($arrayTrainintg[0]));
                
                if (!empty($LevelsNotInTraining)) {
                    $_SESSION['LevelsNotInTraining'] = $LevelsNotInTraining; 
                }     
               
            }
     
   
}

              
          
    public function delete(){

        if(isset($_POST['btnDeleteTraining'])){

            if(!$_POST['modifiedVAL']){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','connectert vous!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Users/signin.php");
                exit;
            }
            $data=[
                'id' => $_POST['idTraining'], 
              'code'=> $_POST['codeTraing'], 
               'modified'=>$_POST['modifiedVAL'],
            ];
           
            $deleteTraining = $this->trainingsServices->delete($data);
            if($deleteTraining==1){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','mise a jour reuissir!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Trainings/getTrainings.php");
                exit;   
            }
            else{
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','échec de suppression!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Trainings/getTrainings.php");
                exit;  
            }
             
        
        }
    }
    
}