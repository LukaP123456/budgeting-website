<?php
//TODO:Napraviti novu klasu ili funkciju koja ce zabiljeziti novog usera tacno u onu grupu/kucu koja je prosledjena.
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

if (isset($_POST['submit'])){

    $group_name = $_POST['group_name'];
    //Grab data from the jQuery script
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    $ip = get_client_ip();

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

    $signup = new SignupContr($full_name, $pwd, $pwdRepeat, $email, $verify_token, $ip, $browser);

    //Runs error handlers and inserts the user into the database
    $signup->signup_user_invite();

    //Povratak na glavnu stranu
    header("location../index.php?error=none");

}else {
   //
}
