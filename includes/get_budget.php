<?php
require_once "../classes/insert-get-class.php";
$get = new Insert_get();
$budget = $get->get_budget();
echo $budget;
