<?php
if (isset($_POST['submit']))
{
    //Getting data from the form
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];

    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($uid,$pwd,$pwdRepeat,$email);

    //Running error handlers and using signup

    $signup->signupUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}