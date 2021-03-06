<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/reset-password.class.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat']) && isset($_POST['submit_password'])) {
    $token = $_POST['token'];
    $email = $_POST['email'];

    if (empty($_POST['password']) && empty($_POST['password_repeat'])) {
        $_SESSION["empty-passwords"] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Warning!</strong> Please fill out the form below.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        header("Location:../includes/create-new-password.php?token=" . $token . "&email=" . $email . "&error=empty_fields");
    } else {


        if ($_POST['password'] == $_POST['password_repeat'] && !empty($_POST['password']) && !empty($_POST['password_repeat'])) {
            //passwords match
            $new_password = $_POST['password_repeat'];
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);


            $reset_password = new reset_password();
            if ($reset_password->check_user_4reset($email, $token)) {
                //If the user exists we enter the if part and insert the new password into the database
                if ($reset_password->insert_new_password($email, $new_password_hashed, $token)) {

                    if ($reset_password->delete_token($email)) {
                        //Success! We have updated the password
                        $_SESSION["password-change-success"] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Success!</strong> Your password has been successfully changed. Please close this window and login your account.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                        header("Location:../includes/create-new-password.php?token=" . $token . "&email=" . $email);
                    } else {
                        //Failed to delete the password_reset_token
                        header("Location:../index.php?error=password_reset_token_failed");
                    }


                } else {
                    //Failure! We failed to update the password
                    echo "success";
                }


            }


        } else {
            //Password do not match
            $_SESSION["password-mismatch"] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Warning!</strong> The entered passwords do not match.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            header("Location:../includes/create-new-password.php?token=" . $token . "&email=" . $email . "&error=passwords-mismatch");
        }

    }
}
