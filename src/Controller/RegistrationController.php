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
use App\Entity\Training;
use App\Service\RegistrationServices;
use App\Service\SessionsServices;
use App\Service\UsersServices;

class RegistrationController
{
    private LevelServices $levelServices;
    private TrainingsServices $trainingsServices;
    private RegistrationServices $registrationServices;
    private UsersServices $usersServices;
    private SessionsServices $sessionsServices;

    public function __construct()
    {
        $this->levelServices = new LevelServices();
        $this->trainingsServices = new TrainingsServices();
        $this->registrationServices = new RegistrationServices();
        $this->usersServices = new UsersServices();
        $this->sessionsServices = new SessionsServices();

    }
    public function addStudent()
    {
        $trainings = $this->registrationServices->getTrainingsOPen();
        $GLOBALS['trainings'] = $trainings;

        $sessionsProject = $this->sessionsServices->getSessions();
        $GLOBALS['sessionsProject'] = $sessionsProject;

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

            $registration = $this->registrationServices->registrationStudent(intval($_POST['sessionsStudent']), $personalData, $documentData, $_POST['training'], $_POST['level']);
            if ($registration == 'succes') {

                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Ajout d\'étudiant reuissir');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;

            } else {
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Echec : ' . $registration);
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;
            }
        }
        /* change user to student */
        if (isset($_POST['btnchangeUserToStudent'])) {
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
            $idUser = $_POST['idModifieStudent'];
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

            $changeUTS = $this->registrationServices->changeUserToStudent(intval($_POST['sessionsStudent']), intval($idUser), $documentData, $_POST['training'], $_POST['level']);
            if ($changeUTS == 'succes') {

                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Ajout d\'étudiant reuissir');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;

            } else if ($changeUTS == 2) {

                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'cette utilisateur est deja inscrire');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;

            } else {
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Echec : ' . $changeUTS);
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;
            }

        }


    }
    public function updateStudent()
    {
        /* btn edit student */
        if (isset($_GET['tabInfoSdudent'])) {
            $stringData = $_GET['tabInfoSdudent'];
            $tableInfo = explode(',', $stringData);
            $_SESSION['idStudent'] = $tableInfo[0];
            $_SESSION['nomStudent'] = $tableInfo[1];
            $_SESSION['prenomStudent'] = $tableInfo[2];
            $_SESSION['emailStudent'] = $tableInfo[3];
            $_SESSION['telephoneStudent'] = $tableInfo[4];
            $_SESSION['nomDiplome'] = $tableInfo[5];
            $_SESSION['role'] = $tableInfo[6];
            $_SESSION['matricule'] = $tableInfo[7];

            $newTrainingsForStudent=$this->trainingsServices->getAvailableTrainingsForStudent(intval($tableInfo[0]));
            $_SESSION['newTrainingsForStudent']=$newTrainingsForStudent;
           
        }
       
      
        /* obtenir les roles */
        $roles = $this->registrationServices->getAllRole();
        $GLOBALS['roles'] = $roles;

     
        if(isset($_POST['btnEditStudent'])) {
            $selectedTrainings = $_POST['training'] ?? [];
    $selectedLevels = $_POST['level'] ?? [];

    // Tableau combiné des trainings avec leurs niveaux
    $trainingsWithLevels = [];

    foreach ($selectedTrainings as $trainingId) {
        if (isset($selectedLevels[$trainingId])) {
            $trainingsWithLevels[$trainingId] = $selectedLevels[$trainingId];
        }
    }

  /*   // Afficher le résultat
 
    foreach ($trainingsWithLevels as $idTraining => $idLevel) {
        echo 'id training : ' . $idTraining . ' et id du niveau: ' . $idLevel . '<br>';
    }
            die(); */
            $outputProfil = $this->registrationServices->getPhotoProfil(intval($_POST['idStud']));
            $outputDateNais = $this->registrationServices->getDateNaisUser(intval($_POST['idStud']));

            /* personnal data ad and role*/
            if (!empty($_FILES['photoEtudiant']['name'])) {

                $photoProfil = $this->registrationServices->saveImageUsers($_FILES['photoEtudiant']);

                if ($photoProfil !== null) {
                    $photoEnregistrer = $photoProfil;
                } else {
                    $photoEnregistrer = $_FILES['photoEtudiant']['name'];
                }
            } else {
                $photoEnregistrer = $outputProfil;
            }

            /* date */
            if (!empty($_POST['dateNaissance'])) {

                $newDateNais = $_POST['dateNaissance'];

            } else {
                $newDateNais = $outputDateNais;
            }
               $matricul= $this->registrationServices->splitTextWithPlus(htmlspecialchars($_POST['matrictule']));
            $newDateNais = $_POST['dateNaissance'] ?? $outputDateNais;
            $newPersonnalData = [
                '_id' => intval(htmlspecialchars($_POST['idStud'])),
                '_name' => htmlspecialchars($_POST['nom']),
                '_first_name' => htmlspecialchars($_POST['prenom']),
                '_mail' => htmlspecialchars($_POST['adressEmail']),
                '_phone_number' => $_POST['numeroTelephone'],
                '_birth_date' => $newDateNais,
                '_photo_user' => $photoEnregistrer,
                '_create_by' => htmlspecialchars($_POST['createBy']),
                '_role_id' => intval($_POST['idRole']),
                '_registration_number' => $matricul,
            ];

            /* 2nd part document part */
            $outputCNI = $this->registrationServices->getCniStudent(intval($_POST['idStud']));
            $outputActe = $this->registrationServices->getActeStudent(intval($_POST['idStud']));
            $outputDiplome = $this->registrationServices->getDiplomeStudent(intval($_POST['idStud']));
            /* cni */
            if (!empty($_FILES['cniEtudiant']['name'])) {
               
                $CNIprojetFolder = $this->registrationServices->saveDocumentUsers($_FILES['cniEtudiant']);
                
                if ($CNIprojetFolder !== null) {
                    $CNIEnregistrer = $CNIprojetFolder;
                } else {
                    $CNIEnregistrer = $_FILES['cniEtudiant']['name'];
                }
            
            } else {
                $CNIEnregistrer = $outputCNI; 
            }
           
            /* diplomwe */
            if (!empty($_FILES['entranceDegree']['name'])) {

                $DiplomeprojetFolder = $this->registrationServices->saveDocumentUsers($_FILES['entranceDegree']);

                if ($DiplomeprojetFolder !== null) {
                    $diplomeEnregistrer = $DiplomeprojetFolder;
                } else {
                    $diplomeEnregistrer = $_FILES['entranceDegree']['name'];
                }
            } else {
                $diplomeEnregistrer = $outputDiplome;
            }
            /* acte */
            if (!empty($_FILES['birthCertificate']['name'])) {

                $acteprojetFolder = $this->registrationServices->saveDocumentUsers($_FILES['birthCertificate']);

                if ($acteprojetFolder !== null) {
                    $acteEnregistrer = $acteprojetFolder;
                } else {
                    $acteEnregistrer = $_FILES['birthCertificate']['name'];
                }
            } else {
                $acteEnregistrer = $outputActe;
            }
            //echo'CNI : '.$CNIEnregistrer.'diplome : '.$diplomeEnregistrer.'acte : '.$acteEnregistrer; die();
           
          
            $documentData = [
                'cniEtudiant' => $CNIEnregistrer,
                'birthCertificate' => $acteEnregistrer,
                'entranceDegree' => $diplomeEnregistrer,
                'nomDiplome' => htmlspecialchars($_POST['nomDiplome']),
                'modifiedBy' => htmlspecialchars($_POST['createBy']),      
             
            ];
            $updatteRegistration = $this->registrationServices->updateTableRegistrations($documentData ,intval($_POST['idStud']));
            if($updatteRegistration){
                $updateNewUser=$this->usersServices->updateNewUser($newPersonnalData);
                if($updateNewUser===1){
                    $SE1 = new SessionManager();
                    if(!empty($trainingsWithLevels)){
                        $training_registration=$this->registrationServices-> addEditStudentToTraining($trainingsWithLevels,intval($_POST['idStud']) );
                     if($training_registration==='success'){
                      
                    $SE1->set('flasMessage',' succes: mise a jour reuissir!'); 
                    $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                    header("location: ./../Student/getStudent.php"); exit;
                     }
                     else{
                        $SE1->set('flasMessage',' succes: mise a jour des des formation et niveau echouée!');
                        $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                        header("location: ./../Student/getStudent.php"); exit;
                     }
                    
                    } else{
                        $SE1->set('flasMessage',' succes: mise a jour reuissir!');
                        $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                        header("location: ./../Student/getStudent.php"); exit; 
                    } 
                      
                    
                }else if($updateNewUser==2){
                    $SE1 = new SessionManager();
                    $SE1->set('flasMessage','un utilisateur a deja cette adresse email');
                    $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                    header("location: ./../Student/getStudent.php");  exit;
                }
                else{
                    $SE1 = new SessionManager();
                    $SE1->set('flasMessage',$updateNewUser);
                    $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                    header("location: ./../Student/getStudent.php");  exit;
                } 
              
            }
            else{
                
                $SE1 = new SessionManager();
                $SE1->set('flasMessage',$updatteRegistration);
                $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                header("location: ./../Student/getStudent.php");   exit;
            }
            /* 3rth part training-level */

          /*   $trainingData = [
                'level' => $_POST['level'],
                'code' => $_POST['training'],

            ]; */
        }
        /* change role user start*/
        if (isset($_POST['changerRole'])) {
            print_r($_POST);

            $newRole = $this->usersServices->setRoleUser(intval($_POST['idRole']), intval($_POST['idUser']), $_POST['modifiedRoleStudent']);
            if ($newRole === 1) {
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'Changement du role reuissir.');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;
            } else {
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', $newRole);
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Student/getStudent.php");
                exit;
            }
        }   /* change role user end*/
    }
    public function delete()
    {


        if (isset($_POST['btnDeleteUser'])) {
            $Id = intval($_POST['idStudent']);
            if (!$_POST['deletedU']) {
                $SE1 = new SessionManager();
                $SE1->set('flashMessage', 'connectrer vous!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Users/signin.php");
                exit;
            }

            $modifiedU = $_POST['deletedU'];

            $deleted = new UsersServices();
            $deletedUser = $deleted->deletedUser(intval($_POST['idStudent']), $modifiedU);
            switch ($deletedUser) {
                case 1:
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage', 'suppression reuissir!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Student/getStudent.php");
                    exit;
                case 0:
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage', 'echec de suppresion de l\'utilisateur!');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Users/directorHead.php");
                    exit;
                //autres cas
                default:
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage', 'echec!');
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
        $roles = $this->registrationServices->getAllRole();
        $GLOBALS['roles'] = $roles;
    }


}


