<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['asc']) OR isset($_POST['desc'])){

    $asc_desc = 0;
    $get = new Insert_get();

    $user_id = $_COOKIE['users_id'];

    if (isset($_POST['asc'])){
        $asc_desc = $_POST['asc'];
    }

    if (isset($_POST['desc'])){
        $asc_desc = $_POST['desc'];
    }

    if ($house_id = $get->get_house_id($user_id)) {
        $get->search_costs_asc_desc($house_id,$asc_desc);
    }


}