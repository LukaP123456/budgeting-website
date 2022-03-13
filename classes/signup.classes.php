<?php

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;
//
////Load Composer's autoloader
//require 'vendor/autoload.php';

class Signup extends Dbh{

//    protected function sendemail_verify($full_name,$email,$verify_token){
//        $mail = new PHPMailer(true);
//        $mail->isSMTP();                                                        //Send using SMTP
//        $mail->Host       = 'smtp.gmail.com';                                   //Set the SMTP server to send through
//        $mail->SMTPAuth   = true;                                               //Enable SMTP authentication
//        $mail->Username   = 'bobomejl123@gmail.com';                            //SMTP username
//        $mail->Password   = 'testsifrazamejl';                                  //SMTP password
//
//        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
//        $mail->Port       = 587;                                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//
//        //Recipients
//        $mail->setFrom('bobomejl123@gmail.com', "Luka Prcic");
//        $mail->addAddress($email, $full_name);                                  //Add a recipient
//
//        //Content
//        $mail->isHTML(true);                                                //Set email format to HTML
//        $mail->Subject = 'Email verification from LP Budgeting';
//
//        $email_template = "
//            <h2>You have registered with LP Budgeting</h2>
//            <h5>Verify your email address to Login with the below given link</h5>
//            <br><br>
//            <a href='http://localhost/BUDGETING_WEBSITE/includes/verify_email.php?token=$verify_token'>Click me to verify</a>
//        ";
//        $mail->Body    = $email_template;
//
//        $mail->send();
//        echo 'Message has been sent';
//
//    }

    protected function setUser( $pwd, $email,$full_name,$verify_token){
        $stmt = $this->connect()->prepare("INSERT INTO accounts(users_pwd,users_email,full_name,verify_token) values (?,?,?,?)");

        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        //The result of the execute function is true or false based on the succes of the execution
        if(!$stmt->execute(array($hashedPwd,$email,$full_name,$verify_token))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        else{
            $this->sendemail_verify($full_name,$email,$verify_token);
        }

        $stmt = null;

    }

    protected function checkUser($full_name, $email){
        $stmt = $this->connect()->prepare("SELECT full_name FROM accounts where full_name = ? OR users_email	= ?");
        //Provera da je kveri izvrsen execute vraca true kad uspe false kad ne uspe ako ne uspe ! ce obrniti i izvrsice se error handler
        //telo if-a ce se pokrenuti samo ako nesto ne uspe sa kverijem
        //!$stmt->execute(array($full_name,$email) returns true if user doesn't exist in DB
        if(!$stmt->execute(array($full_name,$email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;

    }




}