<?php

if (isset($_POST['login-submit'])) {
    //Uzimamo podatke
    $email = $_POST["login-email"];
    $password = $_POST["login-password"];

    var_dump($email);
    var_dump($password);

    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $signup = new LoginContr($email, $password);

    //Running error handlers and using signup

    $signup->loginUserAdmin();
}
