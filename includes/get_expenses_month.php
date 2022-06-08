<?php
session_start();

require_once "../classes/insert-get-class.php";


$get = new Insert_get();

$house_id = $_COOKIE['house_hold_id'];

$expenses = $get->get_expense_month($house_id);

echo $expenses;