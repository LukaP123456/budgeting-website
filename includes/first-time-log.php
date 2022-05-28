<?php
session_start();
require_once "../classes/first-time-loggedin.classes.php";

if (isset($_POST['submit']) or isset($_POST['reset-request-submit'])) {

    $first_time_log = new first_time_logged();
    $users_email = $_SESSION["users_email"];
    $group_name = $_POST['group-name'];

    $_SESSION['group-name'] = $_POST['group-name'];
    //Immortal cookie
    //TODO:group_name cookie ne radi kako treba jer njegova vrednost se setuje kada se upise ime na onoj first time logged in formi sto je lose jer onda svaki put kad se neko prvi put loginuje menja svima ime kuce na ispisu
    setcookie("group_name", $group_name, time() + (10 * 365 * 24 * 60 * 60), "/", "");


    if (!isset($_POST['alone-box'])) {
        $friends_email = $_POST['email-friend'];

        $first_time_log->sendemail_verify($users_email, $friends_email, $group_name);
    }

    $users_id = $_SESSION['users_id'];

    if ($first_time_log->check_user_exists($users_email)) {
        //user exists and is verified in the database so we can continue and make a household

        if ($first_time_log->check_household_exists($group_name)) {

            if (!$first_time_log->create_household($group_name, $users_id)) {
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

