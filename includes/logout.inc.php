<?php

//TESTIRANO: ne radi

//Sa casa
//session_start();
//$_SESSION = array();
//
//if (ini_get("session.use_cookies")) {
//    $params = session_get_cookie_params();
//    setcookie(session_name(), '', time() - 42000,
//        $params["path"], $params["domain"],
//        $params["secure"], $params["httponly"]
//    );
//}
//
//session_destroy();

//header("location:../index.php?error=none");
//exit();

//TESTIRANO: ne radi

//PHP manual documentation https://www.php.net/manual/en/function.session-destroy.php

// Initialize the session.
// If you are using session_name("something"), don't forget it now!
//session_start();

// Unset all of the session variables.
//$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
//if (ini_get("session.use_cookies")) {
//    $params = session_get_cookie_params();
//    setcookie(session_name(), '', time() - 42000,
//        $params["path"], $params["domain"],
//        $params["secure"], $params["httponly"]
//    );
//}

// Finally, destroy the session.
//session_destroy();
//header("location:../index.php?error=none");

//TESTIRANO: ne radi
//PHP manual documentation https://www.php.net/manual/en/function.session-destroy.php
//$session_id_to_destroy = 'KN6ddlfra_qNMdkcwmIeLR3fZ__SK3ww2jpp23__6Kz6eQNV';
//// 1. commit session if it's started.
//if (session_id()) {
//    session_commit();
//}
//
//// 2. store current session id
//session_start();
//$current_session_id = session_id();
//session_commit();
//
//// 3. hijack then destroy session specified.
//session_id($session_id_to_destroy);
//session_start();
//session_destroy();
//session_commit();
//
//// 4. restore current session id. If don't restore it, your current session will refer to the session you just destroyed!
//session_id($current_session_id);
//session_start();
//session_commit();
//
//header("location:../index.php?error=none");

//TESTIRANO: ne radi
//Moj kod
session_start();

session_destroy();
unset($_COOKIE);

header("location:../index.php?error=none");





