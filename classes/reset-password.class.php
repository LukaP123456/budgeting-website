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

    public function reset_user_password($email, $password_token,$expiration_date){
        $url = "http://localhost/BUDGETING_WEBSITE/includes/create-new-password.php?token=" . $password_token;

        $stmt_check = $this->connect()->prepare( "SELECT * FROM cost.accounts where users_email=? AND verify_status=1 LIMIT 1;");

        if ($stmt_check->execute($email))
        {
            $user = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
            $fullname = $user["full_name"];


            $insert_stmt = $this->connect()->prepare("UPDATE accounts set password_reset_expires=? WHERE users_email=$email");
            if (!$insert_stmt->execute($expiration_date))
            {
                //There was an error with updating the table with the expiration date
                echo "error";
            }
            else{
                //We successfully inserted the expiration date into the database and so we are sending the email
                echo "success";
                $this->sendemail_verify($fullname,$email,$url);
            }
        }
        else
        {
            //Error the entered email doesn't exist
            echo "error";
        }


    }





}