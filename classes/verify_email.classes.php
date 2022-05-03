<?php
include_once "dbh.classes.php";

class Verify extends Dbh
{
//Function which checks if the token is in the database
    public function verify_token($token,$email)
    {

        if (isset($token)) {
            //Query which checks if there is a token inside a database
            $stmt = $this->connect()->prepare("SELECT verify_token,verify_status FROM accounts WHERE verify_token = ? LIMIT 1");

            //If there is a token in the database we enter the if statement
            if ($stmt->execute(array($token))) {
                //Query has executed without an issue and we are fetching the verify_status field
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["verify_status"] == 0) {
                    //If the verify_status field is 0 or if the user is not verified we will execute the update_stmt query and change the verification status to 1
                    $clicked_token = $row["verify_status"];
                    $update_stmt = $this->connect()->prepare("UPDATE accounts SET verify_status=1 WHERE verify_token=$clicked_token AND users_email=?");

                    if ($update_stmt->execute(array($email))) {

                        header("Location: ../index.php");
                        exit();
                        //}


                    } else {
                        header("Location: ../index.php?error=token_not_delete");
                        exit();
                    }


                }
            }

            if ($stmt->rowCount() == 0) {
                $_SESSION['error1'] = true;
                header("location:../index.php?error=token_failed");
            }


        }
    }


}



