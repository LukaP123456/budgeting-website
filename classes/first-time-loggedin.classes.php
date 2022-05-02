<?php
include_once "dbh.classes.php";

class first_time_logged extends Dbh
{

    function check_if_first_log($email)
    {
        $check_stmt = $this->connect()->prepare("SELECT first_login from accounts WHERE users_email=?;");
        $return_value = false;

        if ($check_stmt->execute(array($email))) {
            $first_login_value = $check_stmt->fetchAll(PDO::FETCH_ASSOC);
            $first_login = $first_login_value[0]["first_login"];

            if ($first_login === null) {
                //First time logging in for the user
                $return_value = true;
            } else {
                //Not the first time logging in for the user
                $return_value = false;
            }
        }
        else{
            echo "Didn't find the value in the database";
        }

        return $return_value;


    }


}
