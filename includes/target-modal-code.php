<?php
var_dump($_POST);
if (isset($_POST['goal']) && isset($_POST['amount'])){


    $goal = $_POST['goal'];
    $amount = $_POST['amount'];



    $array = array(
      "goal" => $goal,
      "amount" => $amount

    );
    echo json_encode($array);


}