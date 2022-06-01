<?php
require_once "../classes/insert-get-class.php";


if (isset($_POST['amount']) AND isset($_POST['neg_category']) AND isset($_POST['neg_date'])){

    $amount = $_POST['amount'];
    $neg_category = $_POST['neg_category'];
    $neg_date = $_POST['neg_date'];

    $user_id = $_COOKIE['users_id'];
    $insert_neg_value = new Insert_get();

    $error_empty = false;
    $neg_category_error = false;
    $neg_date_error = false;

    if (empty($amount)) {
        echo "<p class='alert alert-danger' role='alert'>Please fill in all the fields and choose propper values</p>";
        $error_empty = true;
    }else if ($neg_category === "category"){
        echo "<p class='alert alert-danger' role='alert'>Please select a category</p>";
        $neg_category_error = true;
    }else if (empty($neg_date)){
        echo "<p class='alert alert-danger' role='alert'>Please select a date</p>";
        $neg_date_error = true;

    }else{
        if ($insert_neg_value->insert_neg_money($neg_date,$neg_category,$amount,$user_id)){
            die("success") ;
        }else{
            die("error");
        }
    }

}else{
    echo "<p class='alert alert-danger' role='alert'>There was an error</p>";
}
