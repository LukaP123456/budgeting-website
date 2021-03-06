<?php

require_once "../classes/insert-get-class.php";

if (isset($_POST['pic_submit']) OR isset($_POST['delete_pic'])){

    if (isset($_POST['delete_pic'])){
        $img_status = 0;
        $img_name = null;

        $insert = new Insert_get();
        $users_id = $_COOKIE['users_id'];
        $insert->insert_img($img_status,$img_name,$users_id);
    }

    //profile picture
    if (isset($_FILES['file'])){

        $file = $_FILES['file'];

        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];
        $file_tmp_type = $_FILES['file']['type'];

        $file_ext = explode(".",$file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allow = array('jpg','jpeg','png','pic','pdf');

            if ($file_error === 0){
                if ($file_size < 1000000){
                    $img_name = $file_name;

                    $img_status = 1;

                    $file_destination = '../uploads/'.$img_name;
                    move_uploaded_file($file_tmp_name, $file_destination);

                    $insert = new Insert_get();
                    $users_id = $_COOKIE['users_id'];


                    $insert->insert_img($img_status,$img_name,$users_id);

                }else{
                    header("location:../includes/change_profile_pic.php?error=file_large");
                    die();
                }

            }else{
                $img_status = 0;
                $img_name = null;

                $insert = new Insert_get();
                $users_id = $_COOKIE['users_id'];
                $insert->insert_img($img_status,$img_name,$users_id);
            }

    }else{
        header("location:../includes/change_profile_pic.php?error=no_pic");
        die();
    }









}
