<?php
if (isset($_POST['submit']))
{
    //Grab data from the form
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];

    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($username,$pwd,$pwdRepeat,$email);

    //Running error handlers and using signup

    $signup->signupUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}