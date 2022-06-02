<?php
include_once "classes/dbh.classes.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';

class resend extends Dbh
{

    function sendemail_verify($full_name, $email, $verify_token)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = '26120060@vts.su.ac.rs';                              //SMTP username
        $mail->Password = '0204001820014';                                 //SMTP password

        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
        $mail->Port = 587;                                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('LP_BUDGETING@gmail.com', "LP Budgeting");
        $mail->addAddress($email, $full_name);                                  //Add a recipient

        //Content
        $mail->isHTML(true);                                                            //Set email format to HTML
        $mail->Subject = 'Email verification from LP Budgeting';

        $date_time = date("d-m-Y H:i:s");

        $email_template = "
            <h1>Click the link below to verify your account with LP Budgeting</h1>
            <h3>Hello $full_name you have registered with LP Budgeting on $date_time with your email account $email</h3>
            <h4>Verify your email address to Login with the below given link</h4>
            <br><br>
            <h1><a href='http://localhost/BUDGETING_WEBSITE/includes/verify_email.php?token=$verify_token&email=$email'>Click me to verify</a></h1>
        ";
        $mail->Body = $email_template;

        $mail->send();
        echo 'Message has been sent';

    }

    public function checkUser($email)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM accounts WHERE users_email=? LIMIT 1");

        if (!$stmt->execute(array($email))) {
            $resultCheck2 = false;
            return $resultCheck2;
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result["verify_status"] == 0) {
                $name = $result["full_name"];
                $email_db = $result["users_email"];
                $verify_token = $result["verify_token"];

                $this->sendemail_verify($name, $email_db, $verify_token);
                $_SESSION['resend-success'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Verification e-mail link has been sent to your email address(" . $email_db . ")
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                header("location: resend-email-verification.php?error=none");
                exit();
            } else {
                $stmt = null;
                header("location: resend-email-verification.php?error=email_verified");
                exit();

            }

        } else {
            $stmt = null;
            header("location: resend-email-verification.php?error=email_unregistered");
            exit();

        }

    }


}

