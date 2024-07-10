<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\LevelServices;
use Core\Auth\Auth;
use Core\FlashMessages\Flash;
use App\Entity\User;

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
                    $level = (new LevelServices())->addLevel($grade, $availabitlity);
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
    if(isset($_POST['btnGetLevle'])){
        
    }
 }
}
