<?php
include_once "dbh.classes.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class first_time_logged extends Dbh
{

    //Sends and email for verification
    function sendemail_verify($email, $verify_token,$friends_email)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        //$mail->Host = "smtp.mail.yahoo.com ";                                         //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'lpbudgeting456@gmail.com';                              //SMTP username
        $mail->Password = 'lpbudgetinggunduliceva63';                                 //SMTP password

        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
        $mail->Port = 587;                                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('LP_BUDGETING@gmail.com', "LP Budgeting");
        $mail->addAddress($email);                                  //Add a recipient

        //Content
        $mail->isHTML(true);                                                            //Set email format to HTML
        $mail->Subject = 'Email verification from LP Budgeting';

        $date_time = date("d-m-Y H:i:s");

        $email_template = "
            <h1>Hello! You have been invited by $email to save money on our <a href='../index.php' > website</a></h1>
            <h3>Plese click on the link below to sign up if you do not want to save money using our services please ignore this e-mail.</h3>
            <h4>Verify your email address to Login with the below given link</h4>
            <br><br>
            <h1><a href='http://localhost/BUDGETING_WEBSITE/includes/verify_email.php?token=$verify_token&email=$email'>Click me to verify</a></h1>
        ";
        $mail->Body = $email_template;

        $mail->send();
        echo 'Message has been sent';

    }

    function check_user_exists($users_email)
    {
        $return_value = false;

        $check_stmt = $this->connect()->prepare("SELECT * from cost.accounts WHERE users_email=? AND verify_status = 1;");

        if ($check_stmt->execute(array($users_email))) {
            if ($check_stmt->rowCount() > 0) {
                $return_value = true;
            } else {
                $return_value = false;
            }

        }

        return $return_value;

    }

    function create_household($group_name, $user_id)
    {

        $create_stmt = $this->connect()->prepare("BEGIN; 
            INSERT INTO household( household_name) VALUES (?);
            INSERT INTO household_accounts(user_id,house_hold_id) VALUES(?,LAST_INSERT_ID());
            COMMIT;");

        if ($create_stmt->execute(array($group_name,$user_id ))) {
            if ($create_stmt->rowCount() > 0) {
                return true;

            } else {
                return false;
            }
        } else {
            return false;

        }


    }


    function log_first_time($user_id)
    {

        $select_stmt = $this->connect()->prepare("SELECT * FROM household_accounts WHERE user_id=?");

        if ($select_stmt->execute(array($user_id))) {

            if ($select_stmt->rowCount() > 0) {
                $selector = $select_stmt->fetchAll(PDO::FETCH_ASSOC);

                $house_id = $selector[0]["house_hold_id"];
                $_SESSION['house_id'] = $selector[0]["house_hold_id"];

                $check_stmt = $this->connect()->prepare("SELECT * from household_accounts WHERE user_id = ? AND house_hold_id = ?;");

                if ($check_stmt->execute(array($user_id, $house_id))) {
                    if ($check_stmt->rowCount() > 0) {
                        return true;
                    } else {
                        return false;
                    }

                } else {
                    return false;
                }


            } else {
                return false;
            }


        } else {
            return false;
        }


    }


}
