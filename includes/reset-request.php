<?php

if (isset($_POST['reset-request-submit']))
{
    //Selector(token number 1) has the value of a radnom binary number converted to hexadecimal
    $selector = bin2hex( random_bytes(8));
    //token number 2
    $token = random_bytes(32);

    $url = "http://localhost/BUDGETING_WEBSITE/includes/create-new-password.php?selector=" . $selector . "&validator" . bin2hex($token );

    //Expiary date for the token
    //date("U") gives us the current date in seconds since 1970
    //1800 = 1 hour
    $expires = date("U") + 1800;

    $user_email = $_POST["email"];

    $reset = new reset_password();
    $reset->reset_user($user_email,$selector,$token,$expires);


}
else
{
    header("Location:../index.php");
}

