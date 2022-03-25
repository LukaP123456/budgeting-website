<?php
include_once "dbh.classes.php";
class Verify extends Dbh{

    public function verify_token($token){

        if (isset($token))
        {
            //TODO:Resiti problem sa ponovnim slanjem verify tokena jer sada kveri ispod trazi token kojeg nema u bazi
            //Querry which checks if there is a token inside a database
            $stmt = $this->connect()->prepare("SELECT verify_token,verify_status FROM accounts WHERE verify_token = ? LIMIT 1");

            //If there is a token in the database we enter the if statement
            if ($stmt->execute(array($token)))
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["verify_status"] == "0")
                {
                    $clicked_token = $row["verify_status"];
                    $update_stmt = $this->connect()->prepare("UPDATE accounts SET verify_status=1 WHERE verify_token=$clicked_token");

                    if ($update_stmt->execute())
                    {
                        header("Location: ../index.php");
                        exit();
                    }


                }
            }

            if ($stmt->rowCount() == 0 )
            {
                $stmt = null;
                echo "Token doesn't exist";
                exit();
            }


            }
        }




    }



