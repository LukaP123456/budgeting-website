<?php
session_start();
require_once "../classes/insert-get-class.php";
$get = new Insert_get();
$user_id = $_COOKIE['users_id'];
$house_id = $get->get_house_id($user_id);
$budget = $get->get_budget($house_id);
echo $budget;
