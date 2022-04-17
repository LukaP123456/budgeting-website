<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/reset-password.class.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat']) && isset($_POST['submit_password']))
{
   if ($_POST['password'] == $_POST['password_repeat'])
   {
       //passwords match
       $email = $_POST['email'];
       $new_password = $_POST['password_repeat'];
       $new_password_hashed = password_hash($new_password,PASSWORD_DEFAULT);
       $token = $_POST['token'];

       $reset_password = new reset_password();
        if ($reset_password->check_user_4reset($email,$token))
        {
            //If the user exists we enter the if part and insert the new password into the database
            if ($reset_password->insert_new_password( $email,$new_password_hashed,$token))
            {
                //Success! We have updated the password
                echo "success";
            }
            else
            {
                //Failure! We failed to update the password
                echo "success";
            }


        }


   }
   else
   {
       //Password do not match
       header("Location:../create_bew_password?error=passwords-mismatch.php");
   }

}