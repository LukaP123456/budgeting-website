<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['start_date']) AND isset($_POST['end_date'])){


    $get = new Insert_get();

    $user_id = $_COOKIE['users_id'];

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if ($house_id = $get->get_house_id($user_id)) {
        $get->search_costs_date($house_id,$start_date,$end_date);
    }


}


