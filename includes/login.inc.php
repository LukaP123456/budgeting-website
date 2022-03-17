<?php

if (isset($_POST['submit']))
{
    if (!empty(trim($_POST["email"])) && !empty(trim($_POST["password"])) )
    {
        //Uzimamo podatke
        $email = $_POST["email"];
        $password = $_POST["password"];
    }
    else
    {
        $_SESSION['status'] = "All fields are mandatory!";
        header("Location:./includes/login-modal.php");
    }



    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $signup = new LoginContr($email,$password);

    //Running error handlers and using signup

    $signup->loginUser();

    //Povratak na glavnu stranu

    header("location../index.php?error=none");


}