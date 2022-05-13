<?php

class SignupContr extends Signup
{

    private $full_name;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $verify_token;
    private $ip;
    private $browser;
    private $house_id;

    public function __construct()
    {


    }

    public static function create() {
        return new self();
    }

    public function set_house_id($house_id) {
        $this->house_id = $house_id;
        return $this;
    }

    public function set_full_name($full_name) {
        $this->full_name = $full_name;
        return $this;
    }

    public function set_pwd($pwd) {
        $this->pwd = $pwd;
        return $this;
    }

    public function set_pwd_repeat($pwdRepeat) {
        $this->pwdRepeat = $pwdRepeat;
        return $this;
    }

    public function set_email($email) {
        $this->email = $email;
        return $this;
    }

    public function set_verify_token($verify_token) {
        $this->verify_token = $verify_token;
        return $this;
    }

    public function set_ip($ip) {
        $this->ip = $ip;
        return $this;
    }

    public function set_browser($browser) {
        $this->browser = $browser;
        return $this;
    }







    public function signupUser()
    {

        if ($this->emptyInput() == false) {
            $_SESSION['error1'] = true;
            header("location:../index.php?error=empty_input");
            exit();
        }

        if ($this->invalid_fullname() == false) {
            //Invalid full name
            $_SESSION['error1'] = true;
            header("location:../index.php?error=full_name");
            exit();
        }

        if ($this->invalidEmail() == false) {
            //invalid email
            $_SESSION['error1'] = true;
            header("location:../index.php?error=invalidemail");
            exit();
        }

        if ($this->pwdMatch() == false) {
            //passwords do not match
            $_SESSION['error1'] = true;
            header("location:../index.php?error=password_match");
            exit();
        }

        if ($this->email_TakenCheck() == false) {
            //passwords do not match
            $_SESSION['error1'] = true;
            header("location:../index.php?error=email_taken");
            exit();
        }


        //Part that will sign up the user to the website
        $this->setUser($this->pwd, $this->email, $this->full_name, $this->verify_token, $this->ip, $this->browser);


    }

    public function signup_user_invite()
    {

        if ($this->emptyInput() == false) {
            $_SESSION['error1'] = true;
            header("location:../index.php?error=empty_input");
            exit();
        }

        if ($this->invalid_fullname() == false) {
            //Invalid full name
            $_SESSION['error1'] = true;
            header("location:../index.php?error=full_name");
            exit();
        }

        if ($this->invalidEmail() == false) {
            //invalid email
            $_SESSION['error1'] = true;
            header("location:../index.php?error=invalidemail");
            exit();
        }

        if ($this->pwdMatch() == false) {
            //passwords do not match
            $_SESSION['error1'] = true;
            header("location:../index.php?error=password_match");
            exit();
        }

        if ($this->email_TakenCheck() == false) {
            //passwords do not match
            $_SESSION['error1'] = true;
            header("location:../index.php?error=email_taken");
            exit();
        }


        //Part that will sign up the user to the website
        $this->set_invited_user($this->pwd, $this->email, $this->full_name, $this->verify_token, $this->ip, $this->browser,$this->house_id);


    }




    private function emptyInput()
    {
        $result = null;
        if (empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email) || empty($this->full_name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalid_fullname()
    {
        $result = false;
        if (!preg_match("/^[A-Za-z _]*$/", $this->full_name)) {
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

    private function pwdMatch()
    {
        $result = false;
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function email_TakenCheck()
    {
        $result = false;
        if (!$this->checkUser($this->full_name, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


}
