<?php

if (isset($_POST['submit']))
{
    //Uzimamo podatke
    $username = $_POST["username"];
    $password = $_POST["password"];


    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $signup = new LoginContr($username,$password);

    //Running error handlers and using signup

    $signup->loginUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}