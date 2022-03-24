<?php
require_once "classes/dbh.classes.php";

class resend extends Dbh {

    public function checkVerify($email){
        $stmt = $this->connect()->prepare("SELECT * FROM accounts WHERE users_email=? LIMIT 1");

        if(!$stmt->execute(array($email)))
        {
            $stmt = null;
            header("location: ../resend-email-verification.php");
            exit();
        }
        else
        {
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($user[0]["verify_status"] == 1){
                $_SESSION['status-message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        This email is already verified please login your account
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                header("location: ../resend-email-verification.php");
                exit();
            }
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0)
        {
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;


    }



    public function checkUser($email){
        $stmt = $this->connect()->prepare("SELECT * FROM accounts WHERE users_email=? AND verify_status =0 LIMIT 1");

        if (!$stmt->execute(array($email))){
            $stmt = null;
            $_SESSION['status-message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Email is already verified
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
            header("location: ../resend-email-verification.php");
            exit();
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0)
        {
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;
    }


    public function email_resend($email)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM accounts where users_email = ? AND verify_status = 0 LIMIT 1");
        if ($stmt->execute(array($email))) {

            $_SESSION['staus-message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Success! An email with a verification link has been resent.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
            header("Location: resend-email-verification.php");
            exit();
        } else {
            $stmt = null;
            $_SESSION['staus-message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please enter your email
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
            exit();
        }
    }




}

