<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';

class reset_password extends Dbh{

    function sendemail_verify($full_name, $email,$url)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'lpbudgeting@gmail.com';                              //SMTP username
        $mail->Password = 'supertajnasifra123';                                 //SMTP password

        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
        $mail->Port = 587;                                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('LP_BUDGETING@gmail.com', "LP Budgeting");
        $mail->addAddress($email, $full_name);                                  //Add a recipient

        //Content
        $mail->isHTML(true);                                                            //Set email format to HTML
        $mail->Subject = 'Reset your password for LP Budgeting';

        $email_template = "
            <h1>We received a password reset request.</h1>
            <p>The link to reset your password is below if you did not make this request you can ignore this email.</p>
            <hr>
            <p>Here is your password reset link</p><br>
            <h1><a href='$url'>Click me to reset your password</a></h1>
        ";
        $mail->Body = $email_template;

        $mail->send();
        echo 'Message has been sent';

    }

    public function reset_user_password($email, $password_token, $password_selector, $password_expires){
        $stmt_check = $this->connect()->prepare( "SELECT * FROM cost.accounts where users_email=? LIMIT 1;");
        $hashed_token = password_hash($password_token,PASSWORD_DEFAULT);


        if ($stmt_check->execute($email))
        {
            //We have the entered email in the database now we will delete the old password
            $user = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
            $fullname = $user["full_name"];



            $stmt_delete = $this->connect()->prepare("UPDATE `accounts` SET `users_pwd` = '' WHERE `accounts`.`users_email` =?;");
            if ($stmt_delete->execute($email))
            {
                //We deleted the old password now we have to change it into the new value which we will get from the reset-form.php page and insert password_reset_token into the database
                $stmt_insert = "INSERT INTO accounts(password_reset_token,password_reset_expires) VALUES (?,?);";
                if ($stmt_insert->execute($hashed_token,$password_expires))
                {
                    //We inserted the reset token into the database and the time it has before it is invalid
                    $this->sendemail_verify($fullname,$email,$hashed_token);

                }


            }


        }
        else
        {
            //Error the entered email doesn't exist
            echo "error";
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $stmt = $this->connect()->prepare("UPDATE `accounts` SET `users_pwd` = '' and verify_token = '' WHERE `accounts`.`users_email` =?;");

        if (!$stmt->execute($email))
        {
            echo "There was an error";
            exit();
        }
        else
        {

            $insert_stmt = "INSERT INTO accounts(verify_token,users_pwd,) VALUES (?,?,?,?);";

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