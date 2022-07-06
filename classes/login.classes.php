<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

include_once "dbh.classes.php";

class Login extends Dbh
{


    protected function getUser($email, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT users_pwd from accounts where  users_email = ? AND verify_status = 1 AND role !=2;");

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location:../index.php?error=usernotfound");
            exit();
        }


        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
        $pwdHashed2 = $pwdHashed[0]["users_pwd"];

        if ($checkPwd == false) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location:../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare("SELECT * from accounts where users_email = ? AND users_pwd = ? AND verify_status = 1 LIMIT 1");

            if (!$stmt->execute(array($email, $pwdHashed2))) {
                $stmt = null;
                $_SESSION['error2'] = true;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION['error2'] = true;
                header("location:../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["email"] = $user[0]["users_email"];
            $_SESSION["users_email"] = $user[0]["users_email"];
            $_SESSION["users_id"] = $user[0]["users_id"];
            $_SESSION["user_name"]  = $user[0]["full_name"];

            $stmt = null;

            $_SESSION['authenticated'] = true;

            //PIN DEO OVDE KRECE

            if ($user[0]['2FA_status'] === "1"){

                $user_id = $user[0]['users_id'];

                $pin =$this->randomNumber(5);

                $update_stmt =$this->connect()->prepare( "UPDATE accounts set PIN=? where users_id=?");

                if ($update_stmt->execute(array($pin,$user_id))){

                    $full_name = $user[0]['full_name'];
                    $users_email = $user[0]['users_email'];

                    setcookie("pin", $pin, time() + (10 * 365 * 24 * 60 * 60), "/", "");


                    $this->sendemail_PIN($full_name, $users_email, $pin);
                    header("Location: ../includes/pin_verification.php");
                    die();
                }


            }else{
                header("Location: ../includes/user-logged-in.php");
            }

        }


        $stmt = null;

    }

    function randomNumber($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    //Sends and email for verification
    function sendemail_PIN($full_name, $email, $pin)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        //$mail->Host = "smtp.mail.yahoo.com ";                                         //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'email@email.com';                              //SMTP username
        $mail->Password = 'someemailpassword';                                   //SMTP password

        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
        $mail->Port = 587;                                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lpbudgeting456@gmail.com', "LP Budgeting");
        $mail->addAddress($email, $full_name);                                  //Add a recipient

        //Content
        $mail->isHTML(true);                                                            //Set email format to HTML
        $mail->Subject = 'Two factor authentication PIN';

        $date_time = date("d-m-Y H:i:s");

        $email_template = "
            <h3>Hello $full_name you have registered with LP Budgeting on $date_time with your email account $email</h3>
            <h1>Your PIN is: $pin Please enter it into the pin form.</h1>
            <br><br>

        ";
        $mail->Body = $email_template;

        $mail->send();
        echo 'Message has been sent';

    }


    protected function getAdmin($email, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT users_pwd from accounts where  users_email = ? AND verify_status = 1 AND role=2;");

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location: ../includes/admin-login.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location:../includes/admin-login.php?error=usernotfound");
            exit();
        }


        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
        $pwdHashed2 = $pwdHashed[0]["users_pwd"];

        if ($checkPwd == false) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location:../includes/admin-login.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare("SELECT * from accounts where users_email = ? AND users_pwd = ? AND verify_status = 1 LIMIT 1");

            if (!$stmt->execute(array($email, $pwdHashed2))) {
                $stmt = null;
                $_SESSION['error2'] = true;
                header("location: ../includes/admin-login.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION['error2'] = true;
                header("location:../includes/admin-login.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["email"] = $user[0]["users_email"];
            $_SESSION["users_email"] = $user[0]["users_email"];
            $_SESSION["users_id"] = $user[0]["users_id"];

            $stmt = null;

            $_SESSION['authenticated'] = true;
            header("Location: ../includes/admin-logged-in.php");
        }

        $stmt = null;
    }
}