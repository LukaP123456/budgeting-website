<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';

class reset_password extends Dbh{

    function sendemail_verify($full_name, $email, $verify_token)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'lpbudgeting@gmail.com';                          //SMTP username
        $mail->Password = 'supertajnasifra123';                                    //SMTP password

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
            <h1><a href='http://localhost/BUDGETING_WEBSITE/includes/verify_email.php?token=$verify_token'>Click me to verify</a></h1>
        ";
        $mail->Body = $email_template;

        $mail->send();
        echo 'Message has been sent';

    }

    public function reset_user($email, $password_token, $password_selector, $password_expires){
        $stmt = $this->connect()->prepare("DELETE FROM password_reset WHERE password_reset_email=?;");

        if (!$stmt->execute($email))
        {
            echo "There was an error";
        }
        else
        {
            $hashed_token = password_hash($password_token,PASSWORD_DEFAULT) ;
            $insert_stmt = "INSERT INTO password_reset(password_reset_email,password_reset_selector,password_reset_token,password_reset_expires) VALUES (?,?,?,?);";

           if (!$insert_stmt->execute($email,$password_selector,$hashed_token,$password_expires))
            {
                echo "There was an error";
            }
            else
            {
                //TODO:prepraviti da reset_user funkcija uzima podatke iz baze na osnovu email-a i iskorisiti accounts tabelu
                //TODO:za ponovno resetovanje sifre ne koristiti jos jednu posebnu tabelu.
                $this->sendemail_verify($email);
            }
        }

    }



}