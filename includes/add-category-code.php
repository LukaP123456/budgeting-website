<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['category_type']) && isset($_POST['category_name'])){

    $category_type = $_POST['category_type'];
    $category_name = $_POST['category_name'];
    $house_id = $_POST['house_hold_id'];

    $date_time = date('Y-m-d H:i:s');


    if (empty($category_name)) {
        echo "<p class='alert alert-danger' role='alert'>Please fill in the field.</p>";
    }else{
        $insert_category = new Insert_get();

        if ($insert_category->insert_category($category_name, $category_type, $house_id, $date_time)){
            die( "success");
        }else{
            die("false");
        }
    }

}else{
    echo "<p class='alert alert-danger' role='alert'>There was an error</p>";
}
