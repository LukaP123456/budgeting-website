<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['search_text'])){

    $get = new Insert_get();

    $user_id = $_COOKIE['users_id'];

    $search_text = trim( $_POST['search_text']);

    if ($house_id = $get->get_house_id($user_id)) {
        $get->search_costs($house_id,$search_text);
    }
}

