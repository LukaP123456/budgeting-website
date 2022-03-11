<?php

class SignupContr extends Signup{

    private $full_name;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $verify_token;

    public function __construct($full_name,$pwd,$pwdRepeat,$email,$verify_token){
        $this->full_name = $full_name;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->verify_token = $verify_token;

    }
    public function signupUser(){

        if ($this->emptyInput() == false){
            header("location:../index.php?error=empty_input");
            exit();
        }

        if ($this->invalid_fullname() == false){
            //Invalid full name
            header("location:../index.php?error=full_name");
            exit();
        }

        if ($this->invalidEmail() == false){
            //invalid email
            header("location:../index.php?error=email");
            exit();
        }

        if ($this->pwdMatch() == false){
            //passwords do not match
            header("location:../index.php?error=password_match");
            exit();
        }

        if ($this->email_TakenCheck() == false){
            //passwords do not match
            header("location:../index.php?error=email_taken");
            exit();
        }


        //Part that will sign up the user to the website
        $this->setUser($this->pwd,$this->email,$this->full_name,$this->verify_token);

    }




    private function emptyInput(){
        $result = null;
        if ( empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email) || empty($this->full_name)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalid_fullname(){
        $result = false;
        if (!preg_match("/^[A-Za-z _]*$/",$this->full_name))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = false;
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $result= false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function pwdMatch(){
        $result = false;
        if ($this->pwd !== $this->pwdRepeat){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function email_TakenCheck(){
        $result = false;
        if (!$this->checkUser($this->full_name,$this->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }




}
