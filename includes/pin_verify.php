<?php

require_once "../classes/insert-get-class.php";

if (isset($_POST['PIN-submit'])){

    $entered_pin = $_POST['PIN'];
    $pin_length = strlen($entered_pin);

    if (isset($entered_pin) AND $pin_length === 5){

            $check = new Insert_get();

            $check->check_pin($entered_pin,$_COOKIE['users_id']);

    }


}
