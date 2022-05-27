<?php
require_once "../classes/insert-get-class.php";


if (isset($_POST['pos_amount']) AND isset($_POST['pos_category']) AND isset($_POST['pos_date'])){

    $pos_amount = $_POST['pos_amount'];
    $pos_category = $_POST['pos_category'];
    $pos_date = $_POST['pos_date'];

    $user_id = $_COOKIE['user_id'];
    $insert_pos_value = new Insert_get();

    if ($insert_pos_value->insert_pos_money($pos_date,$pos_category,$pos_amount,$user_id)){
        echo "success";
    }else{
        echo "false";
    }



}