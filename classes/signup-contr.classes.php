<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class SignupContr extends Signup
{

    private $full_name;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $verify_token;

    public function __construct($full_name, $pwd, $pwdRepeat, $email, $verify_token)
    {
        $this->full_name = $full_name;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->verify_token = $verify_token;

    }



    public function signupUser()
    {

        if ($this->emptyInput() == false) {
            $_SESSION['error1'] = true;
            header("location:../index.php?error=empty_input");
            exit();
        }

        if ($this->invalid_fullname() == false) {
            //Invalid full name
            $_SESSION['error1'] = true;
            header("location:../index.php?error=full_name");
            exit();
        }

        if ($this->invalidEmail() == false) {
            //invalid email
            $_SESSION['error1'] = true;
            header("location:../index.php?error=invalidemail");
            exit();
        }

        if ($this->pwdMatch() == false) {
            //passwords do not match
            $_SESSION['error1'] = true;
            header("location:../index.php?error=password_match");
            exit();
        }

        if ($this->email_TakenCheck() == false) {
            //passwords do not match
            $_SESSION['error1'] = true;
            header("location:../index.php?error=email_taken");
            exit();
        }


        //Part that will sign up the user to the website
        $this->setUser($this->pwd, $this->email, $this->full_name, $this->verify_token);


    }


    private function emptyInput()
    {
        $result = null;
        if (empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email) || empty($this->full_name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalid_fullname()
    {
        $result = false;
        if (!preg_match("/^[A-Za-z _]*$/", $this->full_name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result = false;
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function email_TakenCheck()
    {
        $result = false;
        if (!$this->checkUser($this->full_name, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Sends and email for verifivation
    function sendemail_verify($full_name, $email, $verify_token)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'probamjel123456@gmail.com';                          //SMTP username
        $mail->Password = 'probamejl123456';                                    //SMTP password

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


}
