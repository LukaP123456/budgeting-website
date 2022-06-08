<?php
session_start();
require_once "../classes/first-time-loggedin.classes.php";

if (isset($_POST['add_new_user_btn']) or isset($_POST['add-new-user-form'])) {

    $first_time_log = new first_time_logged();
    $inviter_email =$_POST['email-friend'];
    $group_name = $_POST['group-name'];
    $invitee_email =$_POST['email'];

    $users_id = $_SESSION['users_id'];

    if (!$first_time_log->check_user_exists($invitee_email)) {
        //user exists and is verified in the database so we can continue and make a household

        if (!$first_time_log->check_household_exists($group_name)) {

            if (!$first_time_log->insert_into_household($group_name, $users_id)) {

                $first_time_log->sendemail_verify($invitee_email, $inviter_email, $group_name);

                header("location:../includes/add-new-user.php?error=none&group_name=".$_COOKIE['group_name']);
            }
        }

    } else {
        //User doesn't exist so we will show an error message
        header("location:../includes/add-new-user.php?error=user_exists_inDB&group_name=".$_COOKIE['group_name']);
    }

} else {
    echo "error";
}

