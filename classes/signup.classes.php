<?php
class Signup extends Dbh{

    protected function setUser($username, $pwd, $email){
        $stmt = $this->connect()->prepare("INSERT INTO accounts(users_uid,users_pwd,users_email) values (?,?,?)");

        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        //The result of the execute function is true or false based on the succes of the execution
        if(!$stmt->execute(array($username,$hashedPwd,$email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

    }

    protected function checkUser($username, $email){
        $stmt = $this->connect()->prepare("SELECT users_uid FROM accounts where users_uid = ? OR users_email	= ?");
        //Provera da je kveri izvrsen execute vraca true kad uspe false kad ne uspe ako ne uspe ! ce obrniti i izvrsice se error handler
        //telo if-a ce se pokrenuti samo ako nesto ne uspe sa kverijem
        if(!$stmt->execute(array($username,$email))){
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