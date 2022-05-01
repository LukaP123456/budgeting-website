<?php
session_start();
include_once "classes/resend.classes.php";

if (isset($_POST['resend_email_verify_btn'])) {
    if (!empty(trim($_POST['email']))) {
        $email = $_POST['email'];

        $resend = new resend();

        if ($resend->checkUser($email)) {
            //Success!
            header("location: resend-email-verification.php?error=none");
        } else {
            //Email is not registered in the database
            header("location: resend-email-verification.php?error=email_unregistered");
            exit();
        }


    } else {
        //No email address has been written.
        header("Location: resend-email-verification.php?error=empty_input");
        exit();
    }


}








































