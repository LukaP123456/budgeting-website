<?php

require_once "../classes/insert-get-class.php";


if (isset($_POST['house_id'])){

    $block = new Insert_get();

    $house_id = $_POST['house_id'];


    $block->Unblock_house($house_id);

}
