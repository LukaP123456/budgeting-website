<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['category_type2']) && isset($_POST['category_name2'])){

    $category_type = $_POST['category_type2'];
    $category_name = $_POST['category_name2'];
    $house_id = $_POST['house_hold_id2'];

    $date_time = date('Y-m-d H:i:s');

    $insert_category = new Insert_get();

    if ($insert_category->insert_category($category_name, $category_type, $house_id, $date_time)){
        echo "success";
    }else{
        echo "false";
    }

}
