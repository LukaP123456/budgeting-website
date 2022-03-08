<?php

class SignupContr extends Signup{

    private $username;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($username,$pwd,$pwdRepeat,$email){

        $this->username = $username;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;

    }
    public function signupUser(){

        if ($this->emptyInput() == false){
            header("location:../index.php?error=emptyinput");
            exit();
        }

        if ($this->invalid_username() == false){
            //Invalid username
            header("location:../index.php?error=username");
            exit();
        }

        if ($this->invalidEmail() == false){
            //invalid email
            header("location:../index.php?error=email");
            exit();
        }

        if ($this->pwdMatch() == false){
            //passwords do not match
            header("location:../index.php?error=passwordmatch");
            exit();
        }

        if ($this->username_TakenCheck() == false){
            //username or email taken
            header("location:../index.php?error=useroremailtaken");
            exit();
        }
        //Part that will sign up the user to the website
        $this->setUser($this->username,$this->pwd,$this->email);

    }




    private function emptyInput(){
        $result = null;
        if (empty($this->username) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }


    private function invalid_username(){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/",$this->username)){
            $result = false;
        }
        else{
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

    private function username_TakenCheck(){
        $result = false;
        if (!$this->checkUser($this->username,$this->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }




}
