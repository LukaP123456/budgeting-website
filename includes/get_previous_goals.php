<?php

require_once "../classes/insert-get-class.php";


$get = new Insert_get();

$user_id = $_COOKIE['users_id'];
if ($house_id = $get->get_house_id($user_id)) {
    $get->get_previous_goals($house_id);
}
die();
