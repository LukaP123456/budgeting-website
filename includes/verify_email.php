<?php
session_start();
require_once "../classes/verify_email.classes.php";

//Check if the token is passed thorugh the URL
if (isset($_GET['token'])) {
    //If the token is set varibale token gets that value
    echo $token = $_GET['token'];

    $email = $_GET['email'];
    //Instantiate the class Verify so i can gain acces to the database and check if I have tke passed token in it

    $verify = new Verify();
    $verify->verify_token($token,$email);


}


