<?php
session_start();

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


    $group_name = $_POST['group_name'];
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    $ip = get_client_ip();
    $inviter_email = $_POST["inviter_email"];
    $inviter_id = $_POST["user_id"];

    $_SESSION['inviter-email'] = $_POST['inviter_email'];
    $_SESSION['group_name'] = $_POST['group_name'];
    $_SESSION['inviterID'] = $_POST['user_id'];

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

    $img_name ="";
    $img_status = 0;

    $signup = SignupContr::create()->set_inviter_id($inviter_id)->set_house_id($_SESSION['house_id'])->set_vanilla_user($full_name,$pwd,$pwdRepeat,$email,$verify_token,$ip,$browser,$img_name,$img_status);


    //Checks if the house exists
    if ($signup->get_group_id($group_name)) {
        //Runs error handlers and inserts the user into the database to the aproppriate hosue if the house exists
        $signup->signup_user_invite();

    } else {
        header("Location:../includes/invited-signup.php?email=" . $inviter_email . "&group_name=" . $group_name . "&error=no_house");
    }


    //Povratak na glavnu stranu
//   header("Location:../includes/invited-signup.php?email=" . $inviter_email . "&group_name=" . $group_name . "&error=none");

} else {

    header("Location:../includes/invited-signup.php?email=" . $_SESSION["users_email"] . "&group_name=" . $_SESSION['group_name'] ."&userID=".$_SESSION['inviterID']."&error=no_submit");

}
