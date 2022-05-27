<?php
require_once "../classes/insert-get-class.php";


if (isset($_POST['amount']) AND isset($_POST['neg_category']) AND isset($_POST['neg_date'])){

    $amount = $_POST['amount'];
    $neg_category = $_POST['neg_category'];
    $neg_date = $_POST['neg_date'];

    $user_id = $_COOKIE['user_id'];
    $insert_neg_value = new Insert_get();

    if ($insert_neg_value->insert_neg_money($neg_date,$neg_category,$amount,$user_id)){
        echo "success";
    }else{
        echo "false";
    }



}