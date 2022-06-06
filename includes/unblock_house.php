<?php

require_once "../classes/insert-get-class.php";


if (isset($_POST['house_name'])){

    $block = new Insert_get();

    $house_name = $_POST['house_name'];

    if (empty($house_name)){
        die("Please enter a name into the field");
    }

    $block->Unblock_house($house_name);

}
