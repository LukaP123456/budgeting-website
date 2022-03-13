<?php

class Verify extends Dbh{


    public function verify_token($token){

        if (isset($token))
        {
            //Querry which checks if there is a token inside a database
            $stmt = $this->connect()->prepare("SELECT verify_token FROM accounts WHERE verify_token = '?' LIMIT 1");

            //If there is a token in the database we enter the if statement

            if (!$stmt->execute(array($token)))
            {
                //Check whether the query executed
                if ($stmt->rowCount() == 0){
                    $token_value = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo $token_value[0]["verify_token"];

                }
            }

        }
        else
        {
            $_SESSION['status'] = "Not allowed";
            header("Location: index.php");
        }
    }



}