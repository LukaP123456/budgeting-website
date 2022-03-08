<?php
class Signup extends Dbh{

    protected function setUser($uid,$pwd,$email){
        $stmt = $this->connect()->prepare("INSERT INTO users(users_uid,users_pwd,users_email) values (?,?,?)");

        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uid,$hashedPwd,$email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

    }

    protected function checkUser($uid,$email){
        $stmt = $this->connect()->prepare("SELECT users_uid FROM users where users_uid = ? OR users_email	= ?");
        //Provera da je kveri izvrsen execute vraca true kad uspe false kad ne uspe ako ne uspe ! ce obrniti i izvrsice se error handler
        //telo if-a ce se pokrenuti samo ako nesto ne uspe sa kverijem
        if(!$stmt->execute(array($uid,$email))){
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