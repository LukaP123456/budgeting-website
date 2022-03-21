<?php
require_once "classes/signup.classes.php";
require_once "classes/dbh.classes.php";

if (isset($_POST['resend_email_verify_btn']))
{
    if (!empty(trim($_POST['email'])))
    {
        $email = $_POST['email'];
        $resend = new Signup();
        $resend->email_resend($email);
    }
    else
    {
        $_SESSION['status-message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please enter your email
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
        header("Location: resend-email-verification.php");
        exit();
    }




}








































