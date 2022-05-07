<?php
require_once "../classes/first-time-loggedin.classes.php";

if (isset($_POST['submit'])){

    $alone_box = 0;

    if (isset($_POST['alone-box'])){
        $alone_box = 1;
        $email = "";
    }
    else{
        $alone_box = 0;
        $friends_email = $_POST['email-friend'];
    }

    $group_name = $_POST['group-name'];
    $users_email = $_POST['user-email'];

    $first_time_log = new first_time_logged();

    if ($first_time_log->check_user_exists($users_email)){
        //user exists and is verified in the database so we can continue and make a household


    }
    else{
        //User doesn't exist so we will show an error message
        header("location:../index.php?error=first_time_log_no_user");
    }






}

