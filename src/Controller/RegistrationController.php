<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\LevelServices;
use App\Service\TrainingsServices;
use App\Controller\UsersController;
use Core\Auth\Auth;
use Core\FlashMessages\Flash;
use App\Entity\Level;
use App\Service\RegistrationServices;
use App\Service\UsersServices;

class RegistrationController
{
    private LevelServices $levelServices;
    private TrainingsServices $trainingsServices;
    private RegistrationServices $registrationServices;
    private UsersServices $usersServices;

    public function __construct()
    {
        $this->levelServices = new LevelServices();
        $this->trainingsServices = new TrainingsServices();
        $this->registrationServices = new RegistrationServices();
        $this->usersServices = new UsersServices();

    }
    public function addStudent()
    {
        $trainings = $this->registrationServices->getTrainingsOPen();
        $GLOBALS['trainings'] = $trainings;

        if (isset($_POST['btnAddStudent'])) {
            /* partie 1 */
            if (!$_POST['createBy']) {
                header("location: ./../Users/signin.php");
                exit;

            }

            $savePhoto = $this->registrationServices->saveImageUsers($_FILES['photoEtudiant']);
            if ($savePhoto !== null) {
                $photoEnregistrer = $savePhoto;
            } else {
                $photoEnregistrer = stripslashes(strip_tags(trim($_FILES['photoEtudiant'])));
            }

            $personalData = [
                '_name' => htmlspecialchars($_POST['nom']),
                '_first_name' => htmlspecialchars($_POST['prenom']),
                '_mail' => htmlspecialchars($_POST['adressEmail']),
                '_phone_number' => $_POST['numeroTelephone'],
                '_passwords' => htmlspecialchars($_POST['pwdStudent']),
                '_birth_date' => $_POST['dateNaissance'],
                '_photo_user' => $photoEnregistrer,
                '_create_by' => htmlspecialchars($_POST['createBy']),
                '_role_id' => 1,
            ];

            /* partie 2  */
            /* CNI */
            $saveCNI = $this->registrationServices->saveDocumentUsers($_FILES['cniEtudiant']);
            if ($saveCNI !== null) {
                $CNIEnregistrer = $saveCNI;
            } else {
                $CNIEnregistrer = stripslashes(strip_tags(trim($_FILES['cniEtudiant'])));
            }
            /* ACTE DE NAISSANCE */
            $ActNaissance = $this->registrationServices->saveDocumentUsers($_FILES['birthCertificate']);
            if ($ActNaissance !== null) {
                $ActNaissanceSave = $ActNaissance;
            } else {
                $ActNaissanceSave = stripslashes(strip_tags(trim($_FILES['birthCertificate'])));
            }
            /* DIPLOME */

            $diplome = $this->registrationServices->saveDocumentUsers($_FILES['entranceDegree']);
            if ($diplome !== null) {
                $diplomeSave = $diplome;
            } else {
                $diplomeSave = stripslashes(strip_tags(trim($_FILES['entranceDegree'])));
            }
            $documentData = [
                'cniEtudiant' => $CNIEnregistrer,
                'birthCertificate' => $ActNaissanceSave,
                'entranceDegree' => $diplomeSave,
                'nomDiplome' => htmlspecialchars($_POST['nomDiplome']),
                'createBy' => htmlspecialchars($_POST['createBy']),
            ];

            /* partie 3 */
            $trainingData = [
                'level' => $_POST['level'],
                'code' => $_POST['training'],

            ];

            $registration = $this->registrationServices->registrationStudent($personalData, $documentData, $_POST['training'], $_POST['level']);
            if ($registration == 'succes') {
    
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Ajout d\'étudiant reuissir');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;

            } else {
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Echec : '.$registration);
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;
            }
        }


    }
    public function updateStudent(){

        /* change role user start*/
        if(isset($_POST['changerRole'])){
            print_r ($_POST);
          
            $newRole = $this->usersServices->setRoleUser(intval($_POST['idRole']),intval($_POST['idUser']),$_POST['modifiedRoleStudent']);
            if($newRole===1){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Changement du role reuissir.');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;
            }
            else{
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', $newRole);
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit; 
            }
        }   /* change role user end*/
    }
    public function delete(){

        
        if(isset($_POST['btnDeleteUser'])){
            $Id =intval($_POST['idStudent']);
            if(!$_POST['deletedU']){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','connectrer vous!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Users/signin.php");
            exit;
            }
      
            $modifiedU =$_POST['deletedU'];
        
            $deleted = new UsersServices() ; 
            $deletedUser = $deleted->deletedUser(intval($_POST['idStudent']),  $modifiedU) ;
            switch ($deletedUser) {
                case 1:
                    $SE1 = new SessionManager();
                        $SE1->set('flashMessage','suppression reuissir!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Student/getStudent.php");
                    exit;
                case 0:
                    $SE1 = new SessionManager();
                        $SE1->set('flashMessage','echec de suppresion de l\'utilisateur!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Users/directorHead.php");              
                    exit;
                //autres cas
                default:
                $SE1 = new SessionManager();
                        $SE1->set('flashMessage','echec!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Users/directorHead.php");
            }
        }
    }
    public function getStudent()
    {

        /*  $students = $this->registrationServices->getAll();
         $GLOBALS['students'] = $students;*/
        $studentsList = 'Liste des étudiants';
        $GLOBALS['studentsList'] = $studentsList;

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $GLOBALS['page'] = $page;


        $numberOfStudentPerPage = 5;

        $totalStudents = $this->registrationServices->getTotalStudents();

        $totalPages = ceil($totalStudents / $numberOfStudentPerPage);
        $GLOBALS['totalPages'] = $totalPages;

        $students = $this->registrationServices->getAll($page, $numberOfStudentPerPage);
        $GLOBALS['students'] = $students;

        /* obtenir les roles */
        $roles=$this->registrationServices->getAllRole();
        $GLOBALS['roles'] = $roles;
    }
    public function update()
    {

    }

}


