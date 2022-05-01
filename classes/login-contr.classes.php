<?php
session_start();

class LoginContr extends Login
{
    private $email;
    private $pwd;

    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            //empty input
            $_SESSION['error2'] = true;
            header("location:../index.php?error=emptyinput");
            exit();
        }


        if ($this->invalidEmail() == false) {
            //invalid email
            $_SESSION['error2'] = true;
            header("location:../index.php?error=email");
            exit();
        }
        $this->getUser($this->email, $this->pwd);

    }

    private function emptyInput()
    {
        $result = null;
        if (empty($this->email) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


}
