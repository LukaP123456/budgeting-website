<?php
if (isset($_POST['registruj']))
{
    //Grab data from the form
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    //will maybe be changed
    $verify_token = bin2hex(openssl_random_pseudo_bytes(16));

    //Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($full_name,$pwd,$pwdRepeat,$email,$verify_token);

    //Runs error handlers and inserts the user into the database
    $signup->signupUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}