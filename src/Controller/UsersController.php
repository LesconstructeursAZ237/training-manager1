<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\UsersServices;
use Core\Auth\Auth;
use Core\FlashMessages\Flash;
use App\Entity\User;
class UsersController
{
    private UsersServices $usersServices;

    public function __construct(){
        $this->usersServices = new UsersServices();
    }

    function index()
    {
        // User title
        $_SESSION['subpage_title'] = 'Index';
        $_SESSION['page_title'] = 'Pages';

        $dbconnection = (new UsersServices())->testDbConnection();

        $GLOBALS['dbconnection'] = $dbconnection;
    }

    public function dashboard(){
              
                $users = $this->usersServices->getAll(); 
                $GLOBALS['users'] = $users;
  
            if (isset($_SESSION['auth_user'])){
                $auth_user=($_SESSION['auth_user']);
                $GLOBALS['auth_user'] = $auth_user;
            }
          
            $auth_user = null;

            if(isset($_SESSION['auth'])){
                $auth_user= $_SESSION['auth'];
            }
            $GLOBALS['auth'] = $auth_user;
            $listUser = 'Listes des utilisateurs';
            $GLOBALS['listUser'] = $listUser;

            if(isset($_SESSION['flashMessage'])){
                $flashMessage = $_SESSION['flashMessage'];
                $GLOBALS['flashMessage'] = $flashMessage;
            }
            /* button change role  */
            if(isset($_POST['changeRole'])){
                $newRole = $_POST['dropdown'];
                $idNewRole =intval( $_POST['newId']);
                $NewRoleModified = $_POST['modified'];
                $sqlUpdateRole = new UsersServices() ;
                $resquest = $sqlUpdateRole->setNewRole($idNewRole, $newRole, $NewRoleModified) ;
                switch ($resquest) {
                    case 1:
                        echo '<script> alert("modification reuisssir");
                         window.location.href = "./../Users/dashboard.php";
                        </script>';
                        exit;
                    case 0:
                        echo '<script> alert("echec de modification");
                        window.location.href = "./../Users/dashboard.php";
                        </script>';               
                        exit;
                    //autres cas
                    default:
                    echo '<script> alert("echec");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';
                } 
            }
                /* modification registration number */
            if(isset($_POST['editMat'])){
                $newMat = $_POST['newMat'];
                $Id =intval( $_POST['indentifiantMat']);
                $newModifiedMat =$_POST['modifiedMatricule'];
                $newValue = new UsersServices() ;
                $resquestMat = $newValue->setMatricule($Id, $newMat, $newModifiedMat) ;
                switch ($resquestMat) {
                    case 1:
                        echo '<script> alert("modification reuisssir");
                         window.location.href = "./../Users/dashboard.php";
                        </script>';
                        exit;
                    case 0:
                        echo '<script> alert("echec de modification");
                        window.location.href = "./../Users/dashboard.php";
                        </script>';               
                        exit;
                    //autres cas
                    default:
                    echo '<script> alert("echec");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';
                }
                
            }
 /* modification email */
 if(isset($_POST['editEmail'])){
    $newEmail = $_POST['newEmail'];
    $Id =intval( $_POST['indentifiantEmail']);
    $modifiedEmail =$_POST['modifiedEmail'];
    $newValue = new UsersServices() ;
    $resquestMat = $newValue->editEmail($Id, $newEmail, $modifiedEmail) ;
    switch ($resquestMat) {
        case 1:
            echo '<script> alert("modification reuisssir");
             window.location.href = "./../Users/dashboard.php";
            </script>';
            exit;
        case 0:
            echo '<script> alert("echec de modification");
            window.location.href = "./../Users/dashboard.php";
            </script>';               
            exit;
        //autres cas
        default:
        echo '<script> alert("echec");
        window.location.href = "./../Users/dashboard.php";
        </script>';
    }


    
}
        /* modification phone number */
        if(isset($_POST['EditPhoneNumber'])){
            $newPhone = intval($_POST['newPhoneNumber']);
            $Id =intval( $_POST['indentifiantTelephone']);
            $modifiedPhone =$_POST['modifiedPhoneNumber'];
            $newValue = new UsersServices() ; 
            $resquestPhone = $newValue->editPhoneNumber($Id, $newPhone, $modifiedPhone) ;
            switch ($resquestPhone) {
                case 1:
                    echo '<script> alert("modification reuisssir");
                     window.location.href = "./../Users/dashboard.php";
                    </script>';
                    exit;
                case 0:
                    echo '<script> alert("echec de modification");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';               
                    exit;
                //autres cas
                default:
                echo '<script> alert("echec");
                window.location.href = "./../Users/dashboard.php";
                </script>';
            }
        }
        /* modification last_name */
        if(isset($_POST['editPrenom'])){
            $newPrenom = $_POST['newPrenom'];
            $Id =intval( $_POST['indentifiantPrenom']);
            $modifiedPrenom =$_POST['modifiedPrenom'];
            $newValue = new UsersServices() ; 
            $resquestPrenom = $newValue->editFirstName($Id, $newPrenom, $modifiedPrenom) ;
            switch ($resquestPrenom) {
                case 1:
                    echo '<script> alert("modification reuisssir");
                     window.location.href = "./../Users/dashboard.php";
                    </script>';
                    exit;
                case 0:
                    echo '<script> alert("echec de modification");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';               
                    exit;
                //autres cas
                default:
                echo '<script> alert("echec");
                window.location.href = "./../Users/dashboard.php";
                </script>';
            }
        }
        /* modification first_name */
        if(isset($_POST['editNom'])){
            $newNom = $_POST['newNom'];
            $Id =intval( $_POST['indentifiantNom']);
            $modifiedNom =$_POST['modifiedNom'];
            $newValue = new UsersServices() ; 
            $resquestNom = $newValue->editName($Id, $newNom , $modifiedNom) ;
            switch ($resquestNom) {
                case 1:
                    echo '<script> alert("modification reuisssir");
                     window.location.href = "./../Users/dashboard.php";
                    </script>';
                    exit;
                case 0:
                    echo '<script> alert("echec de modification");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';               
                    exit;
                //autres cas
                default:
                echo '<script> alert("echec");
                window.location.href = "./../Users/dashboard.php";
                </script>';
            }
        }
  
    }
    public function updateUser(){
        if (isset($_POST['btnEditUser'])) {
            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST['firstName']);
            $mail = htmlspecialchars($_POST['mail']);
            $phoneNumber = $_POST['phoneNumber'];
            $matriculeUser = htmlspecialchars($_POST['matriculeUser']);
            $idUser = htmlspecialchars($_POST['idUser']);
            $birthDate = $_POST['birthDate'];
            $photoUser = $_POST['photoUser'];
            if(!$_POST['modifiedSessionUser']){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','connecter vous!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Users/signin.php");
                exit;
            }
            $modifiedSessionUser = $_POST['modifiedSessionUser'];
            if($name=='' || $firstName=='' || $mail=='' || $phoneNumber=='' || $matriculeUser==''){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','champs vide ou non remplir');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Users/directorHead.php");
                exit;
            }
            
            $currentDate = date('Y-m-d');/* pour stocker la date de modification */
            $userData = [
            '_id' => $idUser,
            '_registration_number' => $matriculeUser,
            '_modified_by' => $modifiedSessionUser,
            '_modified_date' => $currentDate,
            '_name' => $name,
            '_first_name' => $firstName,
            '_mail' => $mail,
            '_phone_number' => $phoneNumber,
            '_birth_date' => $birthDate,
            '_photo_user' => $photoUser,
        ];
        $update = new UsersServices();
        $updateSave = $update->updateUser($userData);
        if($updateSave==1){
            $SE1 = new SessionManager();
            $SE1->set('flashMessage','mise a jour reuissir');
            $_SESSION['flashMessage'] = $SE1->get('flashMessage');
            header("location: ./../Users/directorHead.php");
            exit;
        }else{
            $SE1 = new SessionManager();
            $SE1->set('flashMessage','échec des mise a jour');
            $_SESSION['flashMessage'] = $SE1->get('flashMessage');
            header("location: ./../Users/directorHead.php");
            exit;
        }
         
        }
    }

    public function addUser()
    {

        if (isset($_POST['registration'])) {
        
            $name1 = ($_POST['name']);
            $firstName1 = ($_POST['firstName']);
            $mail1 = ($_POST['mail']);
            $phone_number1 = ($_POST['phone_number']);
            $birth_date1 = ($_POST['birth_date']);
            $photo_user1 = ($_POST['photo_user']);
            $created_by = ($_POST['modified']);
            $pwd = ($_POST['pwdUser']);
                if(!$created_by){
                    $_SESSION['flashMessage']='veuillez vous connecter!'; 
                exit;
                }

            $name = stripslashes(strip_tags(trim($name1)));
            $firstName = stripslashes(strip_tags(trim($firstName1)));
            $mail = stripslashes(strip_tags(trim($mail1)));
            $phone_number = stripslashes(strip_tags(trim($phone_number1)));
            $photo_user = stripslashes(strip_tags(trim($photo_user1)));
          
            $utilisateur = new UsersServices();
            $utilisateur1 = $utilisateur->registrationUser($name, $firstName, $mail, $phone_number, $birth_date1, $photo_user, $pwd, $created_by);

            switch ($utilisateur1) {
                case 1: 
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','Ajout d\'utilisateur reuissir');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Users/directorHead.php");
                    exit;
                case 2:
                    $SE1 = new SessionManager();
                    $SE1->set('flashMessage','echec matricul');
                    $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                    header("location: ./../Users/directorHead.php");
                    exit;
                case 20:
                    $SE1 = new SessionManager();
                    $SE1->set('flasMessage','cet utilisateur est deja ajouter');
                    $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                    header("location: ./../Users/directorHead.php");
                    exit;
                case 21:
                    $SE1 = new SessionManager();
                    $SE1->set('flasMessage','echec enregistrement premier champs');
                    $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                    header("location: ./../Users/directorHead.php");
                    exit;
                case 22:
                    $SE1 = new SessionManager();
                    $SE1->set('flasMessage','echec recuperation id: impossible d\'attribuer un matricule');
                    $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                    header("location: ./../Users/directorHead.php");
                    exit;
                /*autres cas*/
                default:
                $SE1 = new SessionManager();
                $SE1->set('flasMessage','echec!');
                $_SESSION['flasMessage'] = $SE1->get('flasMessage');
                header("location: ./../Users/directorHead.php");
            }
        }

    }
    public function delete(){

        if(isset($_POST['btnDeleteUser'])){
            $Id =intval($_POST['deleteID']);
            if(!$_POST['deletedU']){
                $SE1 = new SessionManager();
                $SE1->set('flashMessage','connectrer vous!');
                $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                header("location: ./../Users/signin.php");
            exit;
            }
      
            $modifiedU =$_POST['deletedU'];
        
            $deleted = new UsersServices() ; 
            $deletedUser = $deleted->deletedUser(intval($_POST['deleteID']),  $modifiedU) ;
            switch ($deletedUser) {
                case 1:
                    $SE1 = new SessionManager();
                        $SE1->set('flashMessage','suppression reuissir!');
                        $_SESSION['flashMessage'] = $SE1->get('flashMessage');
                        header("location: ./../Users/directorHead.php");
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
    
    public function signin()
    {
        if (isset($_POST['signin'])) {
            //print_r($_POST); die();

            $email1 = ($_POST['mail']);
            $password1 = ($_POST['password']);

            $email = stripslashes(strip_tags(trim($email1)));
            $password = stripslashes(strip_tags(trim($password1)));
            $conectUser = new UsersServices();
            $result = $conectUser->signInUser($email, $password);

                
                if ($result instanceof User) {

                    // La valeur retournée est une instance de User
                    $SE1 = new SessionManager();
                    $tab = [$result->getFirst_name(), $result->getName(), $result->getMail(), $result->getId()];
                    $SE1->set('auth_user', $tab);
                    $_SESSION['auth_user'] = $SE1->get('auth_user');                  
                    $_SESSION['ArrayAuth']= IsConnect::IfConnect(true, $_SESSION['auth_user']);            
                    header('location: directorHead.php');

                } 
                else 
                {
                    // La valeur retournée n'est pas une instance de User (probablement null)
                    switch ($result) {
                        case 0:
                         
                            header('location: signin.php');
                            $SE1 = new SessionManager();
                            $SE1->set('not_f_user', 'user not found');
                            $_SESSION['not_f_user'] = $SE1->get('not_f_user');
    
                            exit;
                        case 10:
                           
                            header('location: signin.php');
                            $SE1 = new SessionManager();
                            $SE1->set('not_f_user', 'mot de passe invalide');
                            $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                            exit;
                        case 1:
                           
                            header('location): signin.php');
                            $SE1 = new SessionManager();
                            $SE1->set('not_f_user', 'la section de connexion etudiant n\'est pas encore developper');
                            $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                            exit;
                        case 4:
                            //echo '<script> alert("visiteur");</script>';
                            header('location: signin.php');
                            $SE1 = new SessionManager();
                            $SE1->set('not_f_user', 'la section de connexion visiteur n\'est pas encore developper');
                            $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                            exit;   
                        case 101:
                       
                            header('location: signin.php');
                            $SE1 = new SessionManager();
                            $SE1->set('not_f_user', 'l\'utilisateur a été supprimer ou desactivé');
                            $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                            exit;   
                        default:
                            //echo '<script> alert("echec de connexion");</script>';
                            header('location: signin.php');
                            $SE1 = new SessionManager();
                            $SE1->set('not_f_user', 'echec de connexion');
                            $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                            exit;
                    }
                }
               
            } 
                     
    }

    // function de deconnxion 
    public function signOut()
    {

        if (isset($_POST['signout'])) {

            $sessionManager = new SessionManager();

            $sessionManager->signOut();

            // Rediriger vers la page de connexion ou une autre page
            header('Location: ./../Users/signin.php');
            exit;
        }
    }
   

}


