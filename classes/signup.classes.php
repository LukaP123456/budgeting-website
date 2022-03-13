<?php
session_start();

class Signup extends Dbh{

    protected function setUser( $pwd, $email,$full_name,$verify_token){
        $stmt = $this->connect()->prepare("INSERT INTO accounts(users_pwd,users_email,full_name,verify_token) values (?,?,?,?)");

        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

        //The result of the execute function is true or false based on the succes of the execution
        if(!$stmt->execute(array($hashedPwd,$email,$full_name,$verify_token))){
            //Throws an error message in the url if it fails setting a user
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        else{
            //Sends a verification email and show a success message if the user was set successfully
            $this->sendemail_verify($full_name,$email,$verify_token);

            $_SESSION['email'] = $email ;

            header("Location:../login_success.php");
        }

        $stmt = null;

    }

    protected function checkUser($full_name, $email){
        $stmt = $this->connect()->prepare("SELECT full_name FROM accounts where full_name = ? OR users_email	= ?");
        //Provera da je kveri izvrsen execute vraca true kad uspe false kad ne uspe ako ne uspe ! ce obrniti i izvrsice se error handler
        //telo if-a ce se pokrenuti samo ako nesto ne uspe sa kverijem
        //!$stmt->execute(array($full_name,$email) returns true if user doesn't exist in DB
        if(!$stmt->execute(array($full_name,$email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;

    }




}