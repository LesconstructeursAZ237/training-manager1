<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\TrainingsServices;
class TrainingsController
{
    public function registrationTraining()
    {

        if (isset($_POST['trainingAdd'])) {
            //print_r($_POST); die();

            $code1 = ($_POST['codes']);
            $description1 = ($_POST['descriptions']);
            $prices1 = ($_POST['prices']);
            $durations1 = ($_POST['durations']);
            $codes = stripslashes(strip_tags(trim($code1)));
            $description = stripslashes(strip_tags(trim($description1)));
            $prices  = stripslashes(strip_tags(trim($prices1 )));
            $durations = stripslashes(strip_tags(trim($durations1)));
           /*  if(isset($_SESSION['role_id']) == 3 ) {
                $tab_SS= array ($_SESSION['role_id']);*/

                $training = new TrainingsServices();
                $training_result = $training->registrationTraining($codes, $description, $prices, $durations);

                switch ($training_result) {
                    case 1:
                        echo '<script> alert("enregistrement reuisssir");</script>';
                        exit;
                    case 11:
                        echo '<script> alert("echec d\'enregistrement");</script>';
                        exit;
                    case 10:
                        echo '<script> alert("cet formation exicte deja");</script>';
                        exit;
                    //autres cas
                    default:
                        echo "echec";
                }
            /*  }
            else
            {
                header('location: signin.php');  
            }*/
            }
        
       else
        {
           // header('location: ../src/View/trainings.php');  
        }  
    
    }
}