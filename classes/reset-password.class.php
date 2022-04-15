<?php


class reset_password extends Dbh{

    public function reset_user($email, $password_token, $password_selector, $password_expires){
        $stmt = $this->connect()->prepare("DELETE FROM password_reset WHERE password_reset_email=?;");

        if (!$stmt->execute($email))
        {
            echo "There was an error";
        }
        else
        {
            $hashed_token = password_hash($password_token,PASSWORD_DEFAULT) ;
            $insert_stmt = "INSERT INTO password_reset(password_reset_email,password_reset_selector,password_reset_token,password_reset_expires) VALUES (?,?,?,?);";

           if (!$insert_stmt->execute($email,$password_selector,$hashed_token,$password_expires))
            {
                echo "There was an error";
            }
            else
            {
                echo "Success";
            }
        }

    }



}