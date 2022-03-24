<?php
session_start();
require_once "classes/resend.classes.php";

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
                        Email is not registered please sign up with this email ".$email."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
            header("location: resend-email-verification.php");
            exit();
        }


    }
    else
    {
        //No email address has been written.
        $_SESSION['status-message'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
        header("Location: resend-email-verification.php");
        exit();
    }




}








































