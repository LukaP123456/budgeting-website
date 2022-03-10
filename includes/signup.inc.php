<?php
if (isset($_POST['registruj']))
{
    //Grab data from the form
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];

    //Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($full_name,$pwd,$pwdRepeat,$email);



    //modifikuj ceck_username kod signupUser umesto toga check email

    $signup->signupUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}