<?php
if (isset($_POST['login-submit'])) {
    //Uzimamo podatke
    $email = $_POST["login-email"];
    $password = $_POST["login-password"];


    //Instanciranje klase SignupContr
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $signup = new LoginContr($email, $password);

    //Running error handlers and using signup

    $signup->loginUser();

    //Povratak na glavnu stranu

    header("location: ../index.php?error=none");


}
