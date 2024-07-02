<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\UsersServices;

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
      
            if (isset($_POST['get_all'])) {
                //print_r($_POST); die();
                $users = $this->usersServices->getAll(); 
                $GLOBALS['users'] = $users;
               
            }
           /*  $auth_user=['ok bonjour bonjour','145bonjour01', 'ok 9865'];
            $GLOBALS['auth_user'] = $auth_user;
 */
            $auth_user = null;

            if(isset($_SESSION['auth'])){
                $auth_user= $_SESSION['auth'];
            }
            $GLOBALS['auth'] = $auth_user;

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

    public function registration()
    {

        if (isset($_POST['registration'])) {
            //print_r($_POST); die();

            $name1 = ($_POST['name']);
            $firstName1 = ($_POST['firstName']);
            $mail1 = ($_POST['mail']);
            $phone_number1 = ($_POST['phone_number']);
            $birth_date1 = ($_POST['birth_date']);
            $photo_user1 = ($_POST['photo_user']);
            $created_by = ($_POST['modified']);
            //$created_by= $modified1[0].' '.$modified1[1]; //print_r($_POST); die();

            $name = stripslashes(strip_tags(trim($name1)));
            $firstName = stripslashes(strip_tags(trim($firstName1)));
            $mail = stripslashes(strip_tags(trim($mail1)));
            $phone_number = stripslashes(strip_tags(trim($phone_number1)));
            $photo_user = stripslashes(strip_tags(trim($photo_user1)));
            $pwd = $mail;
            //print_r( $created_by); die();
            $utilisateur = new UsersServices();
            $utilisateur1 = $utilisateur->registrationUser($name, $firstName, $mail, $phone_number, $birth_date1, $photo_user, $pwd, $created_by);

            switch ($utilisateur1) {
                case 1:
                    echo '<script> alert("enregistrement reuisssir");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';
                    exit;
                case 2:
                    echo '<script> alert("echec matricul");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';
                    exit;
                case 20:
                    echo '<script> alert("cet utilisateur exicte deja");
                    window.location.href = "./../Users/dashboard.php";
                    </script>';
                    exit;
                case 21:
                    echo '<script> alert("echec enregistrement premier champs");
                    window.location.href = "./../Users/registration.php";
                    </script>';
                    exit;
                case 22:
                    echo '<script> alert("echec recuperation id");
                    window.location.href = "./../registration.php";
                    </script>';
                    exit;
                //autres cas
                default:
                echo '<script> alert("echec");
                window.location.href = "./../Users/registration.php";
                </script>';
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

                switch ($result) {
                    case 0:
                        /*echo '<script> alert("user not found");</script>'; */
                        header('location: signin.php');
                        $SE1 = new SessionManager();
                        $SE1->set('not_f_user', 'user not found');
                        $_SESSION['not_f_user'] = $SE1->get('not_f_user');

                        exit;
                    case 10:
                        //echo '<script> alert("mot de passe invalide");</script>';
                        header('location: signin.php');
                        $SE1 = new SessionManager();
                        $SE1->set('not_f_user', 'mot de passe invalide');
                        $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                        exit;
                    case 1:
                        //echo '<script> alert("student");</script>';
                        header('location: signin.php');
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
                    case is_array($result):
                    
                        $auth =[ $result[1], $result[2],  $result[3]];
                        $_SESSION['auth'] = $auth;
                        
                        header('location: dashboard.php');
                        //$GLOBALS['auth'] = $auth;                     
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


