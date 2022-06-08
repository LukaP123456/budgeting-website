<?php

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


if (isset($_POST['submit'])) {
    //Grab data from the jQuery script
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    $ip = get_client_ip();
    setcookie("email", $email, time() + (10 * 365 * 24 * 60 * 60), "/", "");

    require '../vendor/autoload.php';

    $result = new WhichBrowser\Parser(getallheaders());
    $browser = $result->toString();

    //Verification token
    $number_rand = rand(0, 9999999);
    $salt1 = "token456456456456465657894531324848951";
    $data = $number_rand . $full_name . $email . $salt1;
    $verify_token = password_hash($data, PASSWORD_DEFAULT);


    //Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    //profile picture
    if (isset($_FILES['file'])){

        $file = $_FILES['file'];

        var_dump($_FILES);

        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];
        $file_tmp_type = $_FILES['file']['type'];

        $file_ext = explode(".",$file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allow = array('jpg','jpeg','png','pic',' ');

//        if (in_array($file_actual_ext,$allow)  ){

                if ($file_size < 1000000){
                    if ($file_name===""){
                        $img_name = "no";
                        $img_status = 0;
                    }

                    if (isset($file_name) AND !empty($file_name) AND $file_name != "" ){
                        $img_name = $file_name;
                        $img_status = 1;
                    }

                    $file_destination = 'uploads/'.$img_name;
                    move_uploaded_file($file_tmp_name, $file_destination);

                }else{
                    $_SESSION['error1'] = true;
                    header("location:../index.php?error=file_large");
                    die();
                }

//        }else{
//            $_SESSION['error1'] = true;
//            header("location:../index.php?error=wrong_img_typ");
//            die();
//        }
    }else{
        $img_status = 0;
        $img_name = "no";
    }


    $signup = SignupContr::create()->set_vanilla_user($full_name,$pwd,$pwdRepeat,$email,$verify_token,$ip,$browser,$img_name,$img_status);

    //Runs error handlers and inserts the user into the database
    $signup->signupUser();

    //Povratak na glavnu stranu
    header("location../index.php?error=none");


} else {
    $_SESSION['error1'] = true;
    header("location:../index.php?error=signup_error");
}





