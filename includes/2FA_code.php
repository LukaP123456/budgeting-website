<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['2FA_submit'])){

    $value = $_POST['2FA_box'];

    if (isset($value) AND true){

        $turn = new Insert_get();
        $turn->turn_on_2FA($_COOKIE['users_id']);

    }else{
        header("location:../includes/turn_on_2FA.php?error=not_selected");
        die();
    }
}else{
    header("location:../includes/turn_on_2FA.php?error=not_clicked");
    die();
}
