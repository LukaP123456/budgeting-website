<?php
if (isset($_POST['registruj']))
{
    //Grab data from the form
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    $full_name = $_POST["full-name"];

    //Check if the email exists
    $check_email_query="SELECT * FROM accounts where users_email = '$email' LIMIT 1";

    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($username,$pwd,$pwdRepeat,$email,$full_name);

    //Running error handlers and using signup

    $signup->signupUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}