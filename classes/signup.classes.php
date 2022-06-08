<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class Signup extends Dbh
{
    public function get_group_id($group_name){

        $select_stmt = $this->connect()->prepare("SELECT * FROM household WHERE household_name=?;");

        if ($select_stmt->execute(array($group_name))){
            if ($select_stmt->rowCount()>0){

                $selector = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['house_id'] = $selector[0]['household_id'];

                return true;
            }
        }

        return false;

    }



    protected function set_invited_user($pwd, $email, $full_name, $verify_token, $ip, $browser,$house_id,$inviter_id)
    {
        $stmt = $this->connect()->prepare(
            "BEGIN;
         INSERT INTO accounts(users_pwd,users_email,full_name,verify_token,role,date_time_signup,verification_expires) values (?,?,?,?,0,now(), DATE_ADD(now(), INTERVAL 12 HOUR));
         SET @users_id = LAST_INSERT_ID();
         INSERT INTO log_data(users_id,ip_adress,web_browser_OS) values(@users_id,?,?);
         INSERT INTO household_accounts(user_id,house_hold_id)values(@users_id,?);
         COMMIT;");

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //The result of the execute function is true or false based on the succes of the execution
        if (!$stmt->execute(array($hashedPwd, $email, $full_name, $verify_token, $ip, $browser,$house_id))) {
            //Throws an error message in the url if it fails setting a user
            $stmt = null;
            $_SESSION['error1'] = true;
            header("Location:../includes/invited-signup.php?email=" . $_SESSION["users_email"] . "&group_name=" . $_SESSION['group_name'] ."&userID=".$_SESSION['inviterID']."&error=stmtfailed");

            exit();
        } else {
            header("Location:../signup_success2.php?user_email=".$email);

            //Sends a verification email and show a success message if the user was set successfully
                $this->sendemail_verify($full_name, $email, $verify_token);


        }

        $stmt = null;

    }


    //Sends and email for verification
    function sendemail_verify($full_name, $email, $verify_token)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        //$mail->Host = "smtp.mail.yahoo.com ";                                         //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'lpbudgeting987@gmail.com';                              //SMTP username
        $mail->Password = 'ayaweqowerfvzosp';                                 //SMTP password

        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
        $mail->Port = 587;                                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lpbudgeting456@gmail.com', "LP Budgeting");
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


    protected function setUser($pwd, $email, $full_name, $verify_token, $ip, $browser,$img_name,$img_status)
    {

        $stmt = $this->connect()->prepare(
            "BEGIN;
         INSERT INTO accounts(users_pwd,users_email,full_name,verify_token,date_time_signup,verification_expires,img_status, img_name,PIN_expiration)
          values (?,?,?,?,now(), DATE_ADD(now(), INTERVAL 12 HOUR),?,?,DATE_ADD(now(),INTERVAL 30 MINUTE));
         INSERT INTO log_data(users_id,ip_adress,web_browser_OS)
          values(LAST_INSERT_ID(),?,?);
         COMMIT;");

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //The result of the execute function is true or false based on the succes of the execution
        if (!$stmt->execute(array($hashedPwd, $email, $full_name, $verify_token,$img_status ,$img_name, $ip,$browser,))) {
            //Throws an error message in the url if it fails setting a user
            $stmt = null;
            $_SESSION['error1'] = true;
            header("location:../index.php?error=stmtfailed");
            exit();
        } else {
            header("Location:../signup_success.php");
            //Sends a verification email and show a success message if the user was set successfully
            $this->sendemail_verify($full_name, $email, $verify_token);

            $_SESSION['email'] = $email;

        }

        $stmt = null;

    }

    protected function setAdmin($pwd, $email, $full_name, $verify_token, $ip, $browser)
    {
        $stmt = $this->connect()->prepare(
            "BEGIN;
         INSERT INTO accounts(users_pwd,users_email,full_name,verify_token,date_time_signup,role,verification_expires) values (?,?,?,?,now(),2, DATE_ADD(now(), INTERVAL 12 HOUR));
         INSERT INTO log_data(users_id,ip_adress,web_browser_OS) values(LAST_INSERT_ID(),?,?);
         COMMIT;");

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //The result of the execute function is true or false based on the succes of the execution
        if (!$stmt->execute(array($hashedPwd, $email, $full_name, $verify_token, $ip, $browser))) {
            //Throws an error message in the url if it fails setting a user
            $stmt = null;
            $_SESSION['error1'] = true;
            header("location:../includes/admin-signup.php?error=stmtfailed");
            exit();
        } else {

            header("Location:../signup_success_admin.php");
            //Sends a verification email and show a success message if the user was set successfully
            $this->sendemail_verify($full_name, $email, $verify_token);

            $_SESSION['admin_email'] = $email;

        }

        $stmt = null;

    }

    protected function checkUser($full_name, $email)
    {
        $stmt = $this->connect()->prepare("SELECT full_name FROM accounts where full_name = ? AND users_email	= ?");
        //Provera da je kveri izvrsen execute vraca true kad uspe false kad ne uspe ako ne uspe ! ce obrniti i izvrsice se error handler
        //telo if-a ce se pokrenuti samo ako nesto ne uspe sa kverijem
        //!$stmt->execute(array($full_name,$email) returns true if user doesn't exist in DB
        if (!$stmt->execute(array($full_name, $email))) {
            $stmt = null;
            $_SESSION['error1'] = true;
            header("location:../index.php?error=user_not_found");
            exit();
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;

    }

}