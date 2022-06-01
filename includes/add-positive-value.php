<?php
require_once "../classes/insert-get-class.php";


if (isset($_POST['pos_amount']) AND isset($_POST['pos_category']) AND isset($_POST['pos_date'])){

    $pos_amount = $_POST['pos_amount'];
    $pos_category = $_POST['pos_category'];
    $pos_date = $_POST['pos_date'];

    $user_id = $_COOKIE['users_id'];
    $insert_pos_value = new Insert_get();

    $error_empty = false;
    $pos_category_error = false;
    $pos_date_error = false;

    if (empty($pos_amount)) {
        echo "<p class='alert alert-danger' role='alert'>Please fill in all the fields and choose propper values</p>";
        $error_empty = true;
    }else if ($pos_category === "category"){
        echo "<p class='alert alert-danger' role='alert'>Please select a category</p>";
        $pos_category_error = true;
    }else if (empty($pos_date)){
        echo "<p class='alert alert-danger' role='alert'>Please select a date</p>";
        $pos_date_error = true;

    }else{
        if ($insert_pos_value->insert_pos_money($pos_date,$pos_category,$pos_amount,$user_id)){
            die("success") ;
        }else{
            die("error");
        }
    }

}else{
    echo "<p class='alert alert-danger' role='alert'>There was an error</p>";
}