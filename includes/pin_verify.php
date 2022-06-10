<?php

require_once "../classes/insert-get-class.php";

if (isset($_POST['PIN-submit'])){

    if (empty($_POST['PIN'])){
        header("location:../includes/pin_verification.php?error=no_pin");
        die();
    }else{
        $entered_pin = $_POST['PIN'];
        $pin_length = strlen($entered_pin);

        if (isset($entered_pin) AND $pin_length <= 6 and is_numeric($entered_pin)){

            $check = new Insert_get();

            $check->check_pin($entered_pin,$_COOKIE['users_id']);
            die();

        }else{
            header("location:../includes/pin_verification.php?error=no_pin");
            die();
        }
    }




}
