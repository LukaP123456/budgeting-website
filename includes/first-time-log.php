<?php
session_start();
require_once "../classes/first-time-loggedin.classes.php";

if (isset($_POST['submit'])) {

    $first_time_log = new first_time_logged();

    if (!isset($_POST['alone-box'])) {
        $friends_email = $_POST['email-friend'];

       // $first_time_log->sendemail_verify();
    }

    $group_name = $_POST['group-name'];
    $users_email = $_SESSION["users_email"];

    $users_id = $_SESSION['users_id'];



    if ($first_time_log->check_user_exists($users_email)) {
        //user exists and is verified in the database so we can continue and make a household

        if (!$first_time_log->create_household($group_name, $users_id)) {
            echo "success";
        }

    } else {
        //User doesn't exist so we will show an error message
        header("location:../index.php?error=first_time_log_no_user");
    }


}

