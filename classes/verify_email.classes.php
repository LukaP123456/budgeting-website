<?php
require_once "dbh.classes.php";
class Verify extends Dbh{


    public function verify_token($token){

        if (isset($token))
        {
            //Querry which checks if there is a token inside a database
            $stmt = $this->connect()->prepare("SELECT verify_token FROM accounts WHERE verify_token = ? LIMIT 1");

            //If there is a token in the database we enter the if statement
            if (!$stmt->execute(array($token)))
            {
                $stmt = null;
                echo "Statement didnt execute";
                exit();

            }

            if ($stmt->rowCount() == 0 ){
                $stmt = null;
                echo "Token doesn't exist";
                exit();
            }

            $token_value = $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump($token_value);

        }
        else
        {
            $_SESSION['status'] = "Not allowed";
            header("Location: index.php");
        }
    }



}


