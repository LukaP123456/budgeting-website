<?php
include_once "classes/dbh.classes.php";

class resend extends Dbh {

    //TODO: napraviti da radi resend verify link na sledeci nacin:Pobati jos jednom PDO::FETCH_ASSOC ako ne radi onda napraviti funkciju koja selektuje sve iz baze na osnovu mejla i de je verify
    //status = 1. Napraviti if ako vrati istinu nasao je profil koji je vec verifikovan sto znaci da ne mora slati link ponovo, napraviti session sa porukom da se samo treba ulogovati da se ne mora
    //slati link ponovo itd
    //


    public function checkVerify($email){
        $stmt = $this->connect()->prepare("SELECT * FROM accounts WHERE users_email=?  LIMIT 1");

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







}

