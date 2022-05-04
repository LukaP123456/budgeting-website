<?php


if (isset($_POST['submit'])){

    $alone_box = 0;

    if (isset($_POST['alone-box'])){
        $alone_box = 1;
        $email = "";
    }
    else{
        $alone_box = 0;
        $email = $_POST['email-friend'];
    }

    $group_name = $_POST['group-name'];





}

