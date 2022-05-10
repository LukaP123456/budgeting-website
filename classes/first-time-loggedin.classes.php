<?php
include_once "dbh.classes.php";

class first_time_logged extends Dbh
{

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
        } else {
            echo "Didn't find the value in the database";
        }

        return $return_value;


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
