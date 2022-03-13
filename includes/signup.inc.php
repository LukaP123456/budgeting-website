<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


function sendemail_verify($full_name,$email,$verify_token)
{

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();                                                        //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                               //Enable SMTP authentication
    $mail->Username   = 'probamjel123456@gmail.com';                            //SMTP username
    $mail->Password   = 'probamejl123456';                                  //SMTP password

    $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
    $mail->Port       = 587;                                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('probamejl123456@gmail.com', "Luka Prcic");
    $mail->addAddress($email, $full_name);                                  //Add a recipient

    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = 'Email verification from LP Budgeting';

    $email_template = "
            <h2>You have registered with LP Budgeting</h2>
            <h5>Verify your email address to Login with the below given link</h5>
            <br><br>
            <a href='http://localhost/BUDGETING_WEBSITE/includes/verify_email.php?token=$verify_token'>Click me to verify</a>
        ";
    $mail->Body    = $email_template;

    $mail->send();
    echo 'Message has been sent';

}


if (isset($_POST['registruj']))
{
    //Grab data from the form
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    //will maybe be changed
    $verify_token = bin2hex(openssl_random_pseudo_bytes(16));

    //EMAIL TEST
    sendemail_verify($full_name,$email,$verify_token);






//    //Instantiate SignupContr class
//    include "../classes/dbh.classes.php";
//    include "../classes/signup.classes.php";
//    include "../classes/signup-contr.classes.php";
//
//    $signup = new SignupContr($full_name,$pwd,$pwdRepeat,$email,$verify_token);
//
//    //Runs error handlers and inserts the user into the database
//    $signup->signupUser();
//
//    //Povratak na glavnu stranu
//
//    header("location../index.php?error=none");


}