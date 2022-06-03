<?php

include_once "dbh.classes.php";

class Login extends Dbh
{

    protected function getUser($email, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT users_pwd from accounts where  users_email = ? AND verify_status = 1;");

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location:../index.php?error=usernotfound");
            exit();
        }


        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
        $pwdHashed2 = $pwdHashed[0]["users_pwd"];

        if ($checkPwd == false) {
            $stmt = null;
            $_SESSION['error2'] = true;
            header("location:../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare("SELECT * from accounts where users_email = ? AND users_pwd = ? AND verify_status = 1 LIMIT 1");

            if (!$stmt->execute(array($email, $pwdHashed2))) {
                $stmt = null;
                $_SESSION['error2'] = true;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION['error2'] = true;
                header("location:../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["email"] = $user[0]["users_email"];
            $_SESSION["users_email"] = $user[0]["users_email"];
            $_SESSION["users_id"] = $user[0]["users_id"];//TODO:Problem ovde pocinje kada var_dumpujem sve vrednosti vrati iste one koje su u bazi tj sve je ok

            var_dump($_SESSION["users_id"]);
            var_dump($_SESSION["users_email"]);
            var_dump($_SESSION["email"]);


            $stmt = null;

            $_SESSION['authenticated'] = true;
            header("Location: ../includes/user-logged-in.php");


        }


        $stmt = null;

    }


}