<?php

require_once "../classes/insert-get-class.php";
$get = new Insert_get();
$expenses = $get->get_expenses();
echo $expenses;

