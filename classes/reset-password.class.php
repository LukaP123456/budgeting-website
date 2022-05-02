<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class reset_password extends Dbh
{

    function sendemail_verify($full_name, $email, $url)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'lpbudgeting456@gmail.com';                              //SMTP username
        $mail->Password = 'lpbudgetinggunduliceva63';                                   //SMTP password

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

    public function reset_user_password($email, $password_token)
    {
        $url = "http://localhost/BUDGETING_WEBSITE/includes/create-new-password.php?token=" . $password_token . "&email=" . $email;

        $stmt_check = $this->connect()->prepare("SELECT users_email FROM accounts where users_email=? AND verify_status=1 LIMIT 1;");

        if ($stmt_check->execute(array($email))) {

            if (!$stmt_check->rowCount() == 0) {
                $user = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
                $fullname = $user["full_name"];


                $insert_stmt = $this->connect()->prepare("UPDATE accounts set  password_reset_token=?  WHERE users_email=?");
                if (!$insert_stmt->execute(array($password_token,$email))) {
                    header("Location:../includes/reset-password-form.php?error=email_notindb");

                } else {

                    //We successfully inserted the expiration date into the database and so we are sending the email
                    echo "success";
                    $_SESSION["email"] = $email;

                    $this->sendemail_verify($fullname, $email, $url);
                    header("Location:../includes/reset-password-success.php");
                }

            } else {
                //Error the entered email doesn't exist or isn't verified
                header("Location:../includes/reset-password-form.php?error=email_notindb");
            }


        } else {
            echo "Sql error";

        }


    }


    public function check_user_4reset($email, $reset_token): bool
    {

        $stmt_check = $this->connect()->prepare("SELECT * FROM cost.accounts WHERE users_email = ? AND password_reset_token = ? AND verify_status=1;");
        $return_value = false;

        if ($stmt_check->execute(array($email, $reset_token))) {
            //User exists
            $return_value = true;
        } else {
            //User doesn't exist
            $return_value = false;
        }

        return $return_value;


    }

    public function insert_new_password($email, $new_password): bool
    {

        $stmt_insert = $this->connect()->prepare("UPDATE accounts set users_pwd=? WHERE users_email=?;");

        if ($stmt_insert->execute(array($new_password, $email))) {
            //We successfully inserted the new password;
            return true;
        } else {
            //Failed to insert new password
            return false;
        }

    }

    public function delete_token($email)
    {
        $delete_stmt = $this->connect()->prepare("UPDATE accounts set password_reset_token=NULL WHERE users_email=?;");

        if ($delete_stmt->execute(array($email))) {
            //We deleted the password_reset_token successfully
            return true;

        } else {
            //Failed to delete the token
            return false;
        }

    }


}