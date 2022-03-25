<?php
session_start();
include_once "classes/resend.classes.php";

if (isset($_POST['resend_email_verify_btn']))
{
    if (!empty(trim($_POST['email'])))
    {
        $email = $_POST['email'];

        $resend = new resend();

        if ($resend->checkUser($email))
        {
            echo "success";
        }
        else
        {
            $_SESSION['status-message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Email is not registered please sign up with this email 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            header("location: resend-email-verification.php");
            exit();
        }


    }
    else
    {
        //No email address has been written.
        $_SESSION['status-message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please fill in the form and we will resend you the verification link. 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        header("Location: resend-email-verification.php");
        exit();
    }


}








































