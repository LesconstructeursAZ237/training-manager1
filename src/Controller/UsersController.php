<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\SessionManager;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\UsersServices;

class UsersController
{


    function index()
    {
        // User title
        $_SESSION['subpage_title'] = 'Index';
        $_SESSION['page_title'] = 'Pages';

        $dbconnection = (new UsersServices())->testDbConnection();

        $GLOBALS['dbconnection'] = $dbconnection;
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
            $photo_user1 = ($_POST['photo_user']); //print_r($_POST); die();

            $name = stripslashes(strip_tags(trim($name1)));
            $firstName = stripslashes(strip_tags(trim($firstName1)));
            $mail = stripslashes(strip_tags(trim($mail1)));
            $phone_number = stripslashes(strip_tags(trim($phone_number1)));
            $photo_user = stripslashes(strip_tags(trim($photo_user1)));
            $pwd = $mail;
            $utilisateur = new UsersServices();
            $utilisateur1 = $utilisateur->registrationUser($name, $firstName, $mail, $phone_number, $birth_date1, $photo_user, $pwd);

            switch ($utilisateur1) {
                case 1:
                    echo '<script> alert("enregistrement reuisssir");</script>';
                    exit;
                case 2:
                    echo '<script> alert("echec matricul");</script>';
                    exit;
                case 20:
                    echo '<script> alert("cet utilisateur exicte deja");</script>';
                    exit;
                case 21:
                    echo '<script> alert("echec enregistrement premier champs");</script>';
                    exit;
                case 22:
                    echo '<script> alert("echec recuperation id");</script>';
                    exit;
                //autres cas
                default:
                    echo "echec";
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
            $ressult99 = $conectUser->signInUser($email, $password);

            if (count($ressult99) == 1) {
                $test1 = $ressult99[0];

                switch ($ressult99[0]) {
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
                        $SE1->set('not_f_user', 'student');
                        $_SESSION['not_f_user'] = $SE1->get('not_f_user');
                        exit;
                    case 4:
                        //echo '<script> alert("visiteur");</script>';
                        header('location: signin.php');
                        $SE1 = new SessionManager();
                        $SE1->set('not_f_user', 'visiteur');
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
            } else if
            (count($ressult99) == 5) {
                echo '<script>
                         
                alert("director"); 
               </script>';
                header('location: director.php');
                $SE1 = new SessionManager();
                $SE1->set('nom', $ressult99[0]);
                $SE1->set('prenom', $ressult99[1]);
                $SE1->set('mail', $ressult99[2]);
                $SE1->set('telephone', $ressult99[3]);
                $SE1->set('role_id', $ressult99[4]);
                $_SESSION['nom'] = $SE1->get('nom');
                $_SESSION['prenom'] = $SE1->get('prenom');
                $_SESSION['mail'] = $SE1->get('mail');
                $_SESSION['telephone'] = $SE1->get('telephone');
                $_SESSION['role_id'] = $SE1->get('role_id');
            } else {
                //echo '<script> alert("echec de connexion");</script>';
                header('location: signin.php');
                $SE1 = new SessionManager();
                $SE1->set('not_f_user', 'echec de connexion');
                $_SESSION['not_f_user'] = $SE1->get('not_f_user');
            }

        }
    }
    // function de deconnxion 
    public function signOut(){

        if (isset($_POST['signout'])) {

            $sessionManager = new SessionManager();
        
            $sessionManager->signOut();
            
            // Rediriger vers la page de connexion ou une autre page
            header('Location: ./../Users/signin.php');
            exit;
        }

    }
}
/*  public function signUp()  {
    $GLOBALS["message"] = "It's working";
} */




