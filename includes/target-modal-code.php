<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['goal']) && isset($_POST['amount'])){


    $goal = $_POST['goal'];
    $amount = $_POST['amount'];
    $users_id = $_COOKIE['users_id'];

    $insert_class = new Insert_get();

    if ($insert_class->insert_goal($users_id,$amount,$goal)){
        die("success");
    }else{
        die("error");
    }





}