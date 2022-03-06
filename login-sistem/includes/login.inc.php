<?php

if (isset($_POST['submit']))
{
    //Uzimamo podatke
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];


    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $signup = new LoginContr($uid,$pwd);

    //Running error handlers and using signup

    $signup->loginUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}