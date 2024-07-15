<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\LevelServices;
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
    {

        if (isset($_SESSION['flashMessage'])) {
            $flashMessage = $_SESSION['flashMessage'];
            $GLOBALS['flashMessage'] = $flashMessage;
        }

        if (isset($_POST['btnAddLevel'])) {
            function gradeNotNull(string $DefaultGrad, int $personalizeGrad): ?string
            {
                if (($DefaultGrad == 'notvalue') && ($personalizeGrad == '')) {
                    return null;
                } else if ($DefaultGrad != 'notvalue') {
                    return $DefaultGrad;
                } else if (($personalizeGrad < 6) && ($personalizeGrad >= 1)) {
                    return 'between';
                } else if ($personalizeGrad < 0) {
                    return 'lessThan0';
                } else if ($personalizeGrad == 0) {
                    return 'zero';
                } else {
                    return 'Niveau-' . $personalizeGrad;
                }

            }

            if (intval($_POST['gradePersonalize']) > 99) {
                header('location: addLevels.php');
                $_SESSION['flashMessage'] = 'taille du grade personalisé est incorect!';
                exit;
            }else
            {
                $grade = gradeNotNull(htmlspecialchars($_POST['grade']), intval($_POST['gradePersonalize']));
                if($grade =='zero'){
                    header('location: addLevels.php');
                    $_SESSION['flashMessage'] = 'impossible d\'ajouter un grade zéro!';
                    exit;
                }
                else if($grade =='lessThan0'){
                    header('location: addLevels.php');
                    $_SESSION['flashMessage'] = 'impossible d\'ajouter un niveau negatif!';
                    exit;
                }
                else if($grade =='between'){
                    header('location: addLevels.php');
                    $_SESSION['flashMessage'] = 'le grade : Niveau-' . intval($_POST['gradePersonalize']) . ' existe déja!';
                    exit;
                }
                else if($grade ===null){
                    header('location: addLevels.php');
                    $_SESSION['flashMessage'] = 'le grade ne peut pas etre nulle';
                    exit;
                }
                else
                {
                    $availabitlity = htmlspecialchars($_POST['availability']);
                    $level =  $this->levelServices->addLevel($grade, $availabitlity);
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
    header('Content-Type: application/json');

    $response = array();
    
    if (isset($_POST['ajax']) && $_POST['ajax'] == 1) {
        if (isset($_POST['id']) && isset($_POST['othervar'])) {
            $level_id = intval($_POST['id']);
            $actualDisponibility = $_POST['othervar'];
            sleep(2);
            
            $updateLevel =  $this->levelServices->closeAndOpenLevel($level_id);

            if ($updateLevel) {
                /*  mises à jour effectuer */
                $response = array(
                    'message' => 'succes',
                    'data' => array(
                        'id' => $level_id,
                        'name' => $actualDisponibility,
                        'description' => 'description du niveau',
                        'succes' => 'mise a jour réussir',
                        'error' => 'Échec de la mise à jour' 
                    )
                );
            
            } else {
                  /*  mises à jour echouer */
                  $response = array(
                    'message' => 'error',
                    'data' => array(
                        'id' => $level_id,
                        'name' => $actualDisponibility,
                        'description' => 'description du niveau',
                        'succes' => 'mise a jour réussir',
                        'error' => 'Échec de la mise à jour' 
                    )
                );
            }
        } else {
            /* En cas d'absence d'ID ou d'autre variable */
            $response = array(
                'message' => 'invalidparameters',
                'data' => array(
                    'succes' => 'mise a jour réussir',
                    'invalidparameters' => 'absence d\'id ou autres parametres' 
                )
            );
        }
    } else {
        /* Gérer les requêtes non-AJAX si nécessaire */
          $response = array(
            'message' => 'invalidrequest',
            'data' => array(
                'succes' => 'mise a jour réussir',
                'invalidrequest' => 'Requête non autorisée' 
            )
        );
    }
    
    echo json_encode($response);
    

 }
}


