<?php
include_once "dbh.classes.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require '../vendor/autoload.php';

class first_time_logged extends Dbh
{

    /**
     * @param $user_id
     * @return bool
     */
    function log_first_time($user_id): bool
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

    //Sends and email for verification

    /**
     * @param $email
     * @param $friends_email
     * @param $group_name
     * @throws \PHPMailer\PHPMailer\Exception
     */
    function sendemail_verify($email, $friends_email, $group_name)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                                        //Send using SMTP
        //$mail->Host = "smtp.mail.yahoo.com ";                                         //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                                 //Enable SMTP authentication
        $mail->Username = 'lpbudgeting456@gmail.com';                              //SMTP username
        $mail->Password = 'lpbudgetingcankareva11';                                 //SMTP password

        $mail->SMTPSecure = "tls";                                              //Enable implicit TLS encryption
        $mail->Port = 587;                                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($friends_email);
        $mail->addAddress($email);                                  //Add a recipient

        //Content
        $mail->isHTML(true);                                                            //Set email format to HTML
        $mail->Subject = 'Invite from ' . $friends_email . ' for our website LPBudgeting';

        $user_id = $_SESSION['users_id'];


        $email_template = "
            <h1>Hello! You have been invited by $friends_email to save money on our <a href='http://localhost/BUDGETING_WEBSITE/includes/invited-signup.php?email=$email&group_name=$group_name&userID=$user_id'<a>website</a></h1>
            <h3>Plese click on the link to sign up if you do not want to save money using our services please ignore this e-mail.</h3>
            <h4>Verify your email address to Login with the below given link</h4>
        ";
        $mail->Body = $email_template;

        $mail->send();
        echo 'Message has been sent';

    }

    /**
     * @param $users_email
     * @return bool
     */
    function check_user_exists($users_email): bool
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


    /**
     * @param $house_name
     * @return bool
     */
    function check_household_exists($house_name): bool
    {
        $check_stmt = $this->connect()->prepare("SELECT * FROM household WHERE household_name=?;");

        if ($check_stmt->execute(array($house_name))) {

            if ($check_stmt->rowCount() > 0) {
                //Household with the same name exists and we have to stop the user from creating a new house with the same name
                header("location:../includes/user-logged-in.php?error=house_exists");
                return false;

            }
        }

        return true;

    }

    /**
     * @param $group_name
     * @param $user_id
     * @return bool
     */
    function insert_into_household($group_name, $user_id): bool
    {

        $create_stmt = $this->connect()->prepare("BEGIN; 
            INSERT INTO household( household_name) VALUES (?);
            INSERT INTO household_accounts(user_id,house_hold_id) VALUES(?,LAST_INSERT_ID());
            COMMIT;");

        if ($create_stmt->execute(array($group_name, $user_id))) {
            if ($create_stmt->rowCount() > 0) {
                return true;

            } else {
                return false;
            }
        } else {
            return false;

        }


    }

    /**
     * @param $users_email
     * @return bool
     */
    function check_if_house_admin($users_email): bool
    {
        $check_stmt = $this->connect()->prepare("SELECT * FROM cost.accounts WHERE users_email=? AND role=1;");

        if ($check_stmt->execute(array($users_email))) {
            if ($check_stmt->rowCount() === 1) {
                return true;
            }
        }
        return false;

    }




}
