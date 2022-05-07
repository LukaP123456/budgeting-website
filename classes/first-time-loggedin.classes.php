<?php
include_once "dbh.classes.php";

class first_time_logged extends Dbh
{

    function check_user_exists($users_email){
        $return_value = false;

        $check_stmt = $this->connect()->prepare( "SELECT * from cost.accounts WHERE users_email=? AND verify_status = 1;");

        if ($check_stmt->execute(array($users_email))){
            if ($check_stmt->rowCount() > 0){
                $return_value = true;
            }
            else{
                $return_value = false;
            }

        }

        return $return_value;

    }

    function create_household($friend_email,$group_name,$alone){

        //TODO: Porblem sa bazom. Trenutno tabele u bazi koje mi ovde trebaju nemaju autoincrement ukljucen na primary key tj na id, ne mogu ukljuciti auto increment dok ne postavim neku kateogirju u bazu

        $create_stmt = $this->connect()->prepare("");




    }


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

    function log_first_time($email){
        $change_stmt = $this->connect()->prepare("UPDATE accounts set first_login=1 WHERE users_email=? AND first_login IS NULL; ");

        $change_stmt->execute(array($email));

    }




}
