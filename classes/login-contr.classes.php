<?php

class LoginContr extends Login {

    private $email;
    private $pwd;


    public function __construct($email,$pwd){

        $this->email = $email;
        $this->pwd = $pwd;

    }
    public function loginUser(){

        if ($this->emptyInput() == false){
            header("location:../index.php?error=emptyinput");
//            $_SESSION['status'] = "All fields are mandatory!";
//            header("Location:./includes/login-modal.php");
            exit();
        }


        if ($this->invalidEmail() == false){
            //invalid email
            header("location:../index.php?error=email");
            exit();
        }


        $this->getUser($this->email,$this->pwd);

    }


    private function emptyInput(){
        $result = null;
        if (empty($this->email) || empty($this->pwd)){
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









}
