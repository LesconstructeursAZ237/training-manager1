<?php


declare(strict_types=1);

namespace App\Controller;

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
            $mail= stripslashes(strip_tags(trim($mail1)));
            $phone_number = stripslashes(strip_tags(trim($phone_number1)));
           // $birth_date = stripslashes(strip_tags(trim($birth_date1)));
            $photo_user= stripslashes(strip_tags(trim($photo_user1 )));
            $pwd = $mail;   
            $utilisateur = new UsersServices();
            $utilisateur1 = $utilisateur->registrationUser($name, $firstName, $mail, $phone_number, $birth_date1, $photo_user, $pwd);
            switch ($utilisateur1) {
              /*   case 0:
                    $_SESSION['message'] = 'L\'utilisateur existe déja.';
                    // Écrire et fermer la session
                    session_write_close();
                    echo'<script> alert("cet utilisateur exicte deja");</script>';
                    break; */
                case 1:
                    echo'<script> alert("enregistrement reuisssir");</script>';
                    exit; 
                case 2:
                    echo'<script> alert("echec matricul");</script>';
                    exit;
                case 20:
                        echo'<script> alert("cet utilisateur exicte deja");</script>';
                    exit;
                case 21:
                        echo'<script> alert("echec enregistrement premier champs");</script>';
                        exit;
                case 22:
                        echo'<script> alert("echec recuperation id");</script>';
                        exit;
                //autres cas
                default:
                    echo "echec";
            }

            /*  public function signUp()  {
                 $GLOBALS["message"] = "It's working";
             }
             } */
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
              /*  public function signUp()  {
                  $GLOBALS["message"] = "It's working";
              } */
              } 
        }
    }






