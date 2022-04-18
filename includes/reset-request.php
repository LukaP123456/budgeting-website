<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/reset-password.class.php";

if(!empty($_POST['email']))
{
    if (isset($_POST['reset-request-submit']))
    {
        //Selector(token number 1) has the value of a radnom binary number converted to hexadecimal
        //We use selector to verify that we are selecting the correct user
        $token = password_hash(bin2hex(random_bytes(32)), PASSWORD_DEFAULT) ;

        //Expiary date for the token
        //date("U") gives us the current date in seconds since 1970
        //1800 = 1 hour
        $expires = date('U') + 1800;
        echo $expires;

        $user_email = $_POST["email"];

        $reset = new reset_password();
        $reset->reset_user_password($user_email,$token,$expires);


    }
    else
    {
        header("Location:../index.php");
    }
}
else
{
    $_SESSION['error-message-resend'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please fill in the form and we will resend you the verification link. 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"; ;

    header("Location:../includes/reset-password-form.php?error=empty_email");
}



