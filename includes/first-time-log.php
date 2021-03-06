<?php
session_start();
require_once "../classes/first-time-loggedin.classes.php";
require_once "../classes/insert-get-class.php";

if (isset($_POST['submit']) or isset($_POST['reset-request-submit'])) {

    $first_time_log = new first_time_logged();
    $users_email = $_SESSION["users_email"];
    $group_name = $_POST['group-name'];

    $_SESSION['group-name'] = $_POST['group-name'];


    if (!isset($_POST['alone-box'])) {
        $friends_email = $_POST['email-friend'];

        $first_time_log->sendemail_verify($friends_email,$users_email , $group_name);
    }

    $users_id = $_SESSION['users_id'];

    if ($first_time_log->check_user_exists($users_email)) {
        //user exists and is verified in the database so we can continue and make a household

        if ($first_time_log->check_household_exists($group_name)) {

            if (!$first_time_log->insert_into_household($group_name, $users_id)) {
                header("location:../includes/user-logged-in.php?error=none");
            }
        }

    } else {
        //User doesn't exist so we will show an error message
        header("location:../includes/user-logged-in.php?error=user_exists");
    }

} else {
    echo "error";
}

