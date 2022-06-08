<?php session_start();
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to access user side";
    header("Location: ../index.php");
    exit();
}
require_once "../classes/first-time-loggedin.classes.php";
require_once "../classes/insert-get-class.php";
$get2 = new Insert_get();
$house_id2 = $get2->get_house_id($_COOKIE['users_id']);

$get2->check_block($house_id2);


if ($_SESSION['blocked'] === true){
    header("location:../includes/blocked_page.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--Bootstrap icons link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--JQUERY LINK2-->
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>

    <!--Custom styles link-->
    <link rel="stylesheet" href="../CSS/style.css">


    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">

    <!--Javascript/Bootstrap links-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <!--Chart.js link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
            integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--Sweet alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

    </style>


    <title>LP Budgeting</title>
</head>
<body class="bg-dark">

<!--<div class="loader-container">-->
<!--    <img src="../img/loader.gif"  alt="loader">-->
<!--</div>-->

<!--USER HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="../index.php" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>
        <button class="btn btn-black text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScrolling"
                aria-controls="offcanvasScrolling">Menu
        </button>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li>
                    <?php
                    $first_log = new first_time_logged();
                    $email = $_SESSION['email'];

                    if ($first_log->check_if_house_admin($email)){
                    ?>
                <li class='nav-item'>
                    <a href='add-new-user.php?group_name=<?php if (isset($_SESSION['group_name'])) {
                        echo $_SESSION['group_name'];
                    } ?>'
                       class='nav-link text-white'>Add a member</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--USER HEADER END-->
<?php

setcookie("users_id", $_SESSION["users_id"], time() + (10 * 365 * 24 * 60 * 60), "/", "");

if (!$first_log->log_first_time($_SESSION["users_id"])) {

    ?>
    <!--FIRST TIME USER LOGGED IN START-->
    <div class="p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-black text-white">
                            <h5>Welcome to LP<span class="text-warning">Budgeting</span></h5>
                            <p>Please fill out the form below to finish setting up your account</p>
                        </div>
                        <div class="card-body">
                            <form action="first-time-log.php" name="first-time-log-form"
                                  id="first-time-log-form" method="POST">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" name="alone-box"
                                           id="alone-radio" style="transform: scale(1.3)" onclick="radioCheck()">
                                    <label class="form-check-label" for="alone-radio">Click this button if you want to
                                        save money alone(without a group)</label>
                                    <small class="message" id="message-alone-radio"></small>
                                </div>
                                <br>
                                <div class="form-group mb-3">
                                    <label for="email">Enter the email address of the person you want to invite to save
                                        money with you</label>
                                    <input type="hidden" id="user-email" name="user-email"
                                           value="<?php echo $email; ?>">
                                    <input type="email" id="email" name="email-friend" class="form-control"
                                           placeholder="E-mail of a friend/family member">
                                    <small class="message" id="message-email"></small>
                                </div>
                                <br>
                                <?php
                                $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


                                if (strpos($fullUrl, "error=house_exists") == true) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                             <strong>Warning!</strong> Name of your group already exists please enter another name.
                                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                          </div>";
                                }


                                ?>
                                <div class="form-group mb-3">
                                    <label for="group-name">Enter the name of your group/household</label>
                                    <input type="text" id="group-name" name="group-name" class="form-control"
                                           placeholder="Group name/household name">
                                    <small class="message" id="message-group-name"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit
                                    </button>
                                </div>
                                <script src="../js/first-time-log.js"></script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FIRST TIME USER LOGGED IN END-->
<?php
} else {

require_once "../classes/dbh.classes.php";

$get = new Insert_get();
$get->get_group_name($_COOKIE['users_id']);

?>
    <!--SIDEBAR START-->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Bootstrap</title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
        <symbol id="home" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
        </symbol>
        <symbol id="speedometer2" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
            <path fill-rule="evenodd"
                  d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
        </symbol>
        <symbol id="table" viewBox="0 0 16 16">
            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </symbol>
        <symbol id="grid" viewBox="0 0 16 16">
            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
        </symbol>
        <symbol id="piggy" viewBox="0 0 16 16">
            <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm1.138-1.496A6.613 6.613 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.602 7.602 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962z"/>
            <path fill-rule="evenodd"
                  d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595zM2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.558 6.558 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.649 4.649 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393zm12.621-.857a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199z"/>
        </symbol>
    </svg>

    <script src="../js/sidebars.js"></script>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
         id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="width: 280px;">
        <div class="offcanvas-header bg-black text-white">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><?php if (isset($_SESSION['group_name'])) {
                    echo $_SESSION['group_name'];
                } ?></h5>
            <button type="button" class="btn-close text-reset bg-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <main class="d-flex flex-nowrap">

            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-black" style="width: 100%;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi bi-piggy-bank" width="40" height="32">
                        <use xlink:href="#piggy"/>
                    </svg>

                    <span class="fs-6">
                           <?php
                           if (isset($_SESSION["email"])) {

                               echo $_SESSION['email'];

                           } ?>

                    </span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
<!--                    <li class="nav-item">-->
<!--                        <a href="#" class="nav-link active bg-warning text-black" aria-current="page">-->
<!--                            <svg class="bi pe-none me-2" width="16" height="16">-->
<!--                                <use xlink:href="#home"/>-->
<!--                            </svg>-->
<!--                            Home-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#" class="nav-link text-white">-->
<!--                            <svg class="bi pe-none me-2" width="16" height="16">-->
<!--                                <use xlink:href="#speedometer2"/>-->
<!--                            </svg>-->
<!--                            Dashboard-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#" class="nav-link text-white">-->
<!--                            <svg class="bi pe-none me-2" width="16" height="16">-->
<!--                                <use xlink:href="#table"/>-->
<!--                            </svg>-->
<!--                            Orders-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#" class="nav-link text-white">-->
<!--                            <svg class="bi pe-none me-2" width="16" height="16">-->
<!--                                <use xlink:href="#grid"/>-->
<!--                            </svg>-->
<!--                            Products-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#" class="nav-link text-white">-->
<!--                            <svg class="bi pe-none me-2" width="16" height="16">-->
<!--                                <use xlink:href="#people-circle"/>-->
<!--                            </svg>-->
<!--                            Customers-->
<!--                        </a>-->
<!--                    </li>-->
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                       id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
<!--                        <li><a class="dropdown-item" href="#">New project...</a></li>-->
<!--                        <li><a class="dropdown-item" href="#">Settings</a></li>-->
<!--                        <li><a class="dropdown-item" href="#">Profile</a></li>-->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php
                        if (isset($_SESSION["email"])) {
                            ?>
                            <li class='nav-item'>
                                <a href='logout.inc.php' class='nav-link text-white'>Logout</a>
                            </li>
                            <li class="nav-item">

                            </li>
                            <?php
                        } ?>                    </ul>
                </div>
            </div>
        </main>
    </div>

    <!--SIDEBAR END-->

    <!--POSITIVE,NEGATIVE,TARGET START-->
    <section class="m-4">
        <div class="card-group">
            <div class="card">
                <div class="card-header "
                     style="background: url('../img/money-stack.jpg'); background-size: cover ; height: 30vh">
                </div>
                <div class="card-body p-0">
                    <div class="text-center">
                        <h5 class="card-title text-white"
                            style="background: url('../img/bg_money.jpg'); background-size: cover; height: 10vh">
                            Income</h5>
                    </div>
                    <p class="card-text text-center">Your current income is:</p>
                    <?php

                    $user_id = $_COOKIE['users_id'];
                    $house_id = $get->get_house_id($user_id);
                    $_SESSION['house_id'] = $house_id;



                    $budget = $get->get_budget($house_id);
                    ?>
                    <p class="card-text text-center text-success" id="full_budget" style="font-size: 45px">
                        $<?php if (isset($budget)) {
                            echo $budget;
                        } ?></p>
                    <div class="text-center">
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header "
                     style="background: url('../img/money-fire.jpg'); background-size: cover;  height: 30vh ">

                </div>
                <div class="card-body p-0">
                    <div class="">
                        <h5 class="card-title text-white text-center"
                            style="background: url('../img/red-bg.jpg'); background-size: cover; height: 10vh">
                            Expenses</h5>
                    </div>
                    <p class="card-text text-center">Your expenses are:</p>
                    <?php
                    $expenses = $get->get_expenses($house_id);

                    ?>
                    <p class="card-text text-center text-danger" id="full_expenses" style="font-size: 45px">
                        $-<?php if (isset($expenses)) {
                            echo $expenses;
                        } ?></p>
                    <div class="text-center text-3">
                        <h4 class="text-danger">Three most popular categories</h4>
                        <hr>
                        <h5 class="text-danger" id="three_categories"><?php $get->get_3_categories($house_id);  ?></h5>
                    </div>

                    <script type="text/javascript">

                        $(document).ready(function (){

                            $("#neg_submit").click(function (){

                                $.ajax({
                                    method: "post",
                                    url: "3-popular-categories.php",
                                    success:function (response){
                                        $("#three_categories").html(response);
                                    },
                                    error:function (response){
                                        alert(response);
                                    }
                                })
                            })
                        });


                    </script>

                </div>
            </div>

            <div class="card">
                <div class="card-header "
                     style="background: url('../img/target.jpg'); background-size: cover ; height: 30vh">
                </div>
                <div class="card-body p-0">
                    <div class="text-center">
                        <h5 class="card-title text-black"
                            style="background: url('../img/bg-target.jpg'); background-size: cover; height: 10vh">
                            Goal</h5>
                    </div>
                    <p class="card-text text-center">Your goal is: </p>
                    <?php
                    $goal = $_COOKIE['goal'];
                    $amount = $_COOKIE['amount'];

                    ?>
                    <p class="card-text text-center" id="goal_response"><?php if (isset($goal)) {
                            echo $goal;
                        } ?></p>

                    <p class="card-text text-center" id="amount_response">It's value is: $<?php if (isset($amount)) {
                            echo $amount;
                        } ?></p>

                    <input type="hidden" value="0" id="hidden_amount">

                    <div class="text-center">

                        <!--Script for calculating the goal-->
                        <script type="text/javascript">

                            //let full_budget = parseFloat($("#full_budget").val().replace(/$/g, ''));
                            //let full_expenses = parseFloat($("#full_budget").val().replace(/$/g, ''));
                            //let goal_value = <?php //echo $amount;?>//;
                            //
                            //console.log(full_budget);
                            //
                            //let ratio = full_budget - full_expenses;
                            //let direction = 0;
                            //
                            //if(ratio < goal_value){
                            //    direction = 1;
                            //}
                            //
                            //if (!direction){
                            //
                            //    console.log("Goal reached");
                            //
                            //    $(document).ready(function (){
                            //
                            //        $.ajax({
                            //            method: "POST",
                            //            url:"set_goal_achieved.php",
                            //            data:{
                            //                full_budget: full_budget,
                            //                full_expenses: full_expenses,
                            //                goal_value: goal_value
                            //            },
                            //            success: function (response){
                            //                if (response === "success"){
                            //                    console.log(response)
                            //
                            //
                            //                }else {
                            //                    console.log(response)
                            //                }
                            //            },
                            //            error:function (response){
                            //                alert(response);
                            //            }
                            //        })
                            //    });
                            //}
                            //else {
                            //    console.log("Goal not reached");
                            //}


                        </script>

                        <br>
<!--                        <div class="progress" style="height: 50px">-->
<!--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%; font-size: 25px" aria-valuenow="0"-->
<!--                                 aria-valuemin="0" aria-valuemax="100">25%-->
<!--                            </div>-->
<!--                        </div>-->
                        <br>
                        <button class="btn btn-warning  text-black btn-lg" data-bs-toggle="modal"
                                data-bs-target="#target" id="change_goal">Change goal
                        </button>
                        <button class="btn btn-warning  text-black btn-lg" data-bs-toggle="modal"
                                data-bs-target="#previous_target" id="view_previous_goals">View previous goals
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <!--    POSITIVE,NEGATIVE,TARGET END-->


        <section class="m-3">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card" style="border: green solid 2px">
                        <div class="card-body">
                            <h5 class="card-title">Add an amount to the income</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>

                            <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#enroll"
                                    id="add_btn">+
                            </button>
                            <button class="btn btn-success btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#previous_additions" id="additions_btn">Show all additions
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body" style="border: red solid 2px">
                            <h5 class="card-title">Withdraw from the budget</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <button class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#delete"
                                    id="delete_btn">-
                            </button>
                            <button class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#previous_costs" id="costs_btn">Show all costs
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

<br>
<br>
<br>
    <!--PREVIOUS COSTS START-->
    <!--Ajax previous withdraws -->
    <script type="text/javascript">

    $(document).ready(function (){
        $("#costs_btn").click(function (){

            $.ajax({
                method:"post",
                url:"get_previous_costs.php",
                success: function (response){
                    $("#all_costs_body").html(response);
                },
                error:function (response){
                    alert(JSON.stringify(response));
                }
            })
        });
    });


    </script>

    <div class="modal fade" id="previous_costs" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="costs_modal">
                <div class="modal-header"
                     style="background: url('../img/red-bg.jpg'); background-size: cover; height: 10vh">
                    <h5 class="modal-title text-white" id="enrollLabel" style="margin-right: 20px">Previous expenses</h5>
                    <br>
                    <input type="text" name="search_text" id="search_text" style="margin-right: 20px" class="form-control" placeholder="Previous expenses search">
                    <br>
                    <button type="button" id="load_btn" class="btn-close bg-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    
                </div>

                <div class="modal-header">
                    <select class="form-select" id="asc_desc">
                        <option value="0">Ascending or descending</option>
                        <option value="1">Ascending</option>
                        <option value="2">Desceding</option>
                    </select>
                    <small class="message" id="error_asc_desc"></small>
                </div>

                <div class="modal-body" id="all_costs_body">


                    <?php $get->get_all_costs($house_id) ?>

                </div>
                <div class="response" id="response_previous"></div>
                <div class="modal-footer" style="justify-content: start">
                    <div>
                        <label for="start_date">Start date</label>
                        <input type="datetime-local" id="start_date" class="form-control">
                        <small class="message" id="error_start_date"></small>
                    </div>

                    <div style="margin-left: 10px">
                        <label for="end_date" >End date</label>
                        <input type="datetime-local" id="end_date" class="form-control">
                        <small class="message" id="error_end_date"></small>
                    </div>

                    <button class="btn btn-danger btn-lg" id="search_btn">Search on date</button>

                    <script type="text/javascript">

                        $(document).ready(function (){
                            $("#asc_desc").on('change',function (){
                                let asc_desc_val = $("#asc_desc").val();

                                console.log(asc_desc_val)

                                if(asc_desc_val == 1){
                                    console.log("asd")
                                    $.ajax({
                                        method:"post",
                                        url:"asc_desc_costs.php",
                                        data:{
                                            asc: "asc"
                                        },
                                        success:function (response){
                                            $("#all_costs_body").html(response);
                                        },
                                        error:function (response){
                                            alert(response);
                                        }
                                    });
                                }


                                if(asc_desc_val == 2){
                                    console.log("desc")
                                    $.ajax({
                                        method:"post",
                                        url:"asc_desc_costs.php",
                                        data:{
                                            desc: "desc"
                                        },
                                        success:function (response){
                                            $("#all_costs_body").html(response);
                                        },
                                        error:function (response){
                                            alert(response);
                                        }
                                    });
                                }

                            });

                            $("#costs_btn").click(function (e){
                                $("#start_date").removeClass("border border-danger border-2").removeClass("border border-success border-2");
                                $("#end_date").removeClass("border border-danger border-2").removeClass("border border-success border-2");
                                $("#error_start_date").html(" ").removeClass("text-success fas fa-exclamation-circle").removeClass("text-danger fas fa-exclamation-circle ");
                                $("#error_end_date").html(" ").removeClass("text-success fas fa-exclamation-circle").removeClass("text-danger fas fa-exclamation-circle ");

                            });

                            $("#search_btn").click(function (e){
                                e.preventDefault();
                                $("#error_start_date").html(" ").removeClass("text-success fas fa-exclamation-circle").removeClass("text-danger fas fa-exclamation-circle ");
                                $("#error_end_date").html(" ").removeClass("text-success fas fa-exclamation-circle").removeClass("text-danger fas fa-exclamation-circle ");
                                $("#start_date").removeClass("border border-danger border-2").removeClass("border border-success border-2");
                                $("#end_date").removeClass("border border-danger border-2").removeClass("border border-success border-2");


                                let start_date = $("#start_date").val();
                                let end_date = $("#end_date").val();

                                let check_start_date = 0;
                                let check_end_date = 0;


                                if(start_date === ""){
                                    swal("Warning!",  "Please select start date","error");
                                    $("#start_date").addClass("border border-danger border-2");
                                    $("#error_start_date").html("<small> Please select a start date </small>").addClass("text-danger fas fa-exclamation-circle ");
                                    check_start_date = 1;
                                }

                                if(end_date === ""){
                                    if( end_date=== "" && start_date === ""){
                                        swal("Warning!",  "Please select start & end date","error");
                                        $("#end_date").addClass("border border-danger border-2");
                                        $("#error_end_date").html("<small> Please select a start date </small>").addClass("text-danger fas fa-exclamation-circle ");
                                        check_start_date = 1;
                                    }else {
                                        swal("Warning!",  "Please select end date","error");
                                        $("#end_date").addClass("border border-danger border-2");
                                        $("#error_end_date").html("<small> Please select a start date </small>").addClass("text-danger fas fa-exclamation-circle ");
                                        check_start_date = 1;
                                    }


                                }

                                if(check_start_date !== 1 && check_end_date !== 1){
                                    $("#all_costs_body").html('')

                                    $.ajax({
                                        method:"post",
                                        url:"search_costs_date.php",
                                        data:{
                                            start_date: start_date,
                                            end_date: end_date
                                        },
                                        success:function (response){
                                            $("#all_costs_body").html(response);
                                            $("#start_date").removeClass("border border-danger border-2").addClass("border border-success border-2");
                                            $("#end_date").removeClass("border border-danger border-2").addClass("border border-success border-2");

                                            $("#error_start_date").html("<small> Looks good! </small>").addClass("text-success fas fa-exclamation-circle ");
                                            $("#error_end_date").html("<small> Looks good!</small>").addClass("text-success fas fa-exclamation-circle ");


                                            $("#start_date").val(" ");
                                            $("#end_date").val(" ");


                                        },
                                        error:function (response){
                                            alert(response);
                                        }

                                    });
                                }
                            })

                                $("#search_text").keyup(function (){

                                    let search_text = $("#search_text").val().trim();

                                    if(search_text === " "){
                                        console.log(search_text)
                                        console.log(2131231)

                                    }else{
                                        $("#all_costs_body").html('')

                                        $.ajax({
                                            method:"post",
                                            url:"search_costs.php",
                                            data:{
                                                search_text:search_text
                                            },
                                            success:function (response){

                                                $("#all_costs_body").html(response);
                                            },
                                            error:function (response){
                                                alert(response);
                                            }

                                        });
                                    }
                                });
                        });

                    </script>

                </div>
            </div>
        </div>
    </div>
    <!--PREVIOUS COSTS END-->

    <!--PREVIOUS ADDITIONS START-->

    <div class="modal fade" id="previous_additions" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="additions_modal">
                <div class="modal-header"
                     style="background: url('../img/bg_money.jpg'); background-size: cover; height: 10vh">
                    <h5 class="modal-title text-white" id="enrollLabel">Previous additions to the income</h5>
                    <button type="button" id="load_btn" class="btn-close bg-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body" id="all_additions_body">

                    <?php $get->get_all_additions($house_id) ?>

                </div>
                <div class="response" id="response_previous"></div>
                <div class="modal-footer">

                    <!--Ajax previous additions -->
                    <script type="text/javascript">

                        $(document).ready(function (){
                            $("#additions_btn").click(function (){

                                $.ajax({
                                    method:"post",
                                    url:"get_previous_additions.php",
                                    success: function (response){
                                        $("#all_additions_body").html(response);
                                    },
                                    error:function (response){
                                        alert(JSON.stringify(response));
                                    }
                                })
                            });
                        });


                    </script>

                </div>
            </div>
        </div>
    </div>
    <!--PREVIOUS ADDITIONS END-->

    <!--PREVIOUS GOAL START-->

    <div class="modal fade" id="previous_target" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
    <!--AJAX script for previous goals-->
    <script type="text/javascript">

        $(document).ready(function (){
            $("#view_previous_goals").click(function (){

                $.ajax({
                    method:"post",
                    url:"get_previous_goals.php",
                    success: function (response){
                            $("#previous_goals_body").html(response);
                    },
                    error:function (response){
                        alert(JSON.stringify(response));
                    }
                })
            });
        });

    </script>

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="target_modal">
                <div class="modal-header"
                     style="background: url('../img/bg-target.jpg'); background-size: cover; height: 10vh">
                    <h5 class="modal-title" id="enrollLabel">Previous</h5>
                    <button type="button" id="load_btn" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body" id="previous_goals_body">
                    <input type="hidden" id="house_id_goals">

                    <?php $get->get_previous_goals($house_id); ?>

                </div>
                <div class="response" id="response_previous"></div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!--PREVIOUS GOAL END-->


    <!--CHANGE GOAL START-->

    <div class="modal fade" id="target" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">

        <!--AJAX script for target-->
        <script type="text/javascript" src="../js/change-target.js"></script>

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="target_modal">
                <div class="modal-header"
                     style="background: url('../img/bg-target.jpg'); background-size: cover; height: 10vh">
                    <h5 class="modal-title" id="enrollLabel">Change your goal</h5>
                    <button type="button" id="load_btn" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="target-modal-code.php" name="target-form" id="target-form">
                    <div class="modal-body" >

                        <div class="mb-3 input-control">
                            <label for="goal_name">Goal</label>
                            <input type="text" class="form-control" id="goal_name" name="goal_name"
                                   placeholder="Goal" pattern="[a-zA-Z]+">
                            <small class="message text-danger" id="error_goal_name"></small>
                            <br>
                        </div>

                        <div class="mb-3 input-control">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                   placeholder="Amount">
                            <small id="error_amount"></small>
                            <br>
                        </div>
                    </div>
                    <div class="response" id="response"></div>
                    <div class="modal-footer">
                        <button type="button" id="goalBTN" class="btn btn-warning">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--CHANGE GOAL END-->


    <!--ADD MODAL START-->
    <div class="modal fade" id="enroll" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-white"
                     style="background: url('../img/bg_money.jpg'); background-size: cover; height: 10vh">
                    <h5 class="modal-title" id="enrollLabel">Add to the budget</h5>
                    <button type="button" class="btn-close bg-white" id="load_budget" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="add-positive-value.php">

                    <!--Add to the budget script-->
                    <script type="text/javascript" src="../js/add_positive_value.js"></script>

                    <div class="modal-body">
                        <div class="mb-3 input-control">
                            <label for="pos_amount">Amount</label>
                            <input type="number" class="form-control" id="pos_amount" name="pos_amount"
                                   placeholder="Amount">
                            <small class="message" id="error_pos_amount"></small>
                            <br>
                        </div>
                        <div class="mb-3 input-control">
                            <label for="pos_category">Category</label>
                            <?php
                            echo "<select class='form-select' id='pos_category' name='pos_category'>";
                            echo "<option value='category'>--CHOOSE--</option>";
                            $get->get_category1($house_id);
                            echo "</select>";
                            ?>
                            <small class="message" id="error_pos_category"></small>
                            <br>
                        </div>
                        <div class="mb-3 input-control">
                            <label for="pos_date">Date added</label>
                            <input type="datetime-local" class="form-control" id="pos_date" name="pos_date">
                            <small class="message" id="error_pos_date"></small>
                            <br>
                        </div>

                    </div>
                    <div class="pos_response" id="pos_response"></div>

                    <div class="modal-footer">
                        <?php
                        if ($first_log->check_if_house_admin($email)) {
                            ?>
                            <button type="button" class="btn btn-danger fas fa-exclamation-circle" id="delete_category"> Delete a category</button>
                            <a class="btn btn-success" href="add-new-category.php" role="button">Add a new category</a>
                        <?php }
                        ?>
                        <button type="button" class="btn btn-success" id="pos_submit">Submit</button>
                    </div>
                </form>
                <!--Delete category from list-->
                <script type="text/javascript">

                    $(document).ready(function (){

                        $("#delete_category").click(function () {

                            let category = $("#pos_category").val();

                            console.log(category)

                            let check_neg_category2 = 0;

                            if (category=== "category"){
                                $("#pos_category").addClass("border border-danger border-2");
                                $("#error_neg_category").html("<small> Please select a categroy from the list and click the <b>Delete a category button again</b> </small>").addClass("text-danger fas fa-exclamation-circle ");
                                check_neg_category2 = 1;
                            }else{
                                $('#pos_category').addClass("border border-success border-2").removeClass("border border-danger border-2");
                                $("#error_pos_category").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
                            }

                            let category_text = $("#pos_category option:selected").text();

                            if(check_neg_category2 !== 1){
                                $.ajax({
                                    method: "post",
                                    url:"delete-category.php",
                                    data:{
                                        category:category
                                    },
                                    success: function (response){
                                            console.log("asdasdasdasd")
                                        swal("Good job!",  "Successfully deleted category: "+category_text, "success");
                                        $("#pos_response").html(response);
                                    },
                                    error:function (response){
                                        console.log(response)
                                        swal("Warning",  response, "error");
                                        $("#pos_response").html(response);

                                    }
                                })
                            }
                        })
                    });

                </script>

            </div>
        </div>
    </div>
    <!--ADD MODAL END-->

    <!--WITHDRAW MODAL START-->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header  text-white"
                     style="background: url('../img/red-bg.jpg'); background-size: cover; height: 10vh">
                    <h5 class="modal-title" id="deleteLabel">Add new cost</h5>
                    <button type="button" class="btn-close" id="load_expenses" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="add-negative-value.php">

                    <!--Add a new cost -->
                    <script type="text/javascript" src="../js/add_negative_value.js"></script>

                    <div class="modal-body">
                        <div class="mb-3 input-control">
                            <label for="neg_amount">Amount</label>
                            <input type="number" class="form-control" id="neg_amount" name="neg_amount"
                                   placeholder="Amount">
                            <small class="message" id="error_neg_amount"></small>
                            <br>
                        </div>
                        <div class="mb-3 input-control">
                            <label for="neg_category">Category</label>
                            <?php
                            echo "<select class='form-select' id='neg_category' name='neg_category'>";
                            echo "<option value='category'>--CHOOSE--</option>";
                            $get->get_category0($house_id);
                            echo "</select>";
                            ?>
                            <small class="message" id="error_neg_category"></small>
                            <br>
                        </div>
                        <div class="mb-3 input-control">
                            <label for="neg_date">Date added</label>
                            <input type="datetime-local" class="form-control" id="neg_date" name="neg_date">
                            <small class="message" id="error_neg_date"></small>
                            <br>
                        </div>

                        <div class="mb-3 input-control">
                            <label for="cost_description">Cost description</label>
                            <textarea class="form-control" id="cost_description" name="cost_description"></textarea>
                            <small class="message" id="error_cost_description"></small>
                            <br>
                        </div>
                        <div class="neg_response" id="neg_response"></div>
                    </div>
                    <div class="modal-footer">
                        <?php
                        if ($first_log->check_if_house_admin($email)) {
                            ?>
                            <button type="button" class="btn btn-warning fas fa-exclamation-circle" id="delete_category_neg"> Delete a category</button>
                            <a class="btn btn-danger" href="add-new-negative-category.php" role="button">Add a new
                                category</a>
                        <?php }
                        ?>
                        <button type="button" class="btn btn-danger" id="neg_submit">Submit</button>
                    </div>
                </form>

                <!--Delete negative category from list-->
                <script type="text/javascript">

                    $(document).ready(function (){

                        $("#delete_category_neg").click(function () {

                            let category = $("#neg_category").val();

                            let check_neg_category2 = 0;

                            if (category=== "category"){
                                $("#neg_category").addClass("border border-danger border-2");
                                $("#error_neg_category").html("<small> Please select a category from the list and click the <b>Delete a category button again</b> </small>").addClass("text-danger fas fa-exclamation-circle ");
                                check_neg_category2 = 1;
                            }else{
                                $('#neg_category').addClass("border border-success border-2").removeClass("border border-danger border-2");
                                $("#error_neg_category").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
                            }

                            let category_text = $("#neg_category option:selected").text();

                            if(check_neg_category2 !== 1){
                                $.ajax({
                                    method: "post",
                                    url:"delete-category.php",
                                    data:{
                                        category:category
                                    },
                                    success: function (response){
                                        console.log("asdasdasdasd");
                                        swal("Good job!",  "Successfully deleted category: "+category_text, "success");
                                        $("#neg_response").html(response);
                                    },
                                    error:function (response){
                                        console.log(response)
                                        $("#neg_response").html(response);
                                        swal("Warning",  response, "error");

                                    }
                                })
                            }
                        })
                    });

                </script>
            </div>
        </div>
    </div>
    <!--WITHDRAW MODAL END-->

    <div class="card text-center">
        <div class="card-body">
            <div class="container" style="height: 645px">
                <canvas id="myChart">

                </canvas>
            </div>
        </div>
    </div>
    <script>
        let my_chart = document.getElementById("myChart").getContext('2d');

        let budget_expenses_chart = new Chart(my_chart, {
            type: 'pie', //bar, horizontal bar, pie, line ,doughnut, radar, polar area
            data: {
                labels: ['Budget', 'Expenses'],
                datasets: [{
                    // label: 'Budget',
                    data: [
                        <?php echo $budget; ?>,
                        <?php echo $expenses; ?>
                    ],
                    backgroundColor: [
                        'green',
                        'red'
                    ],
                    borderWidth: 1,
                    hoverBorderWidth: 3,
                    hoverBorderColor: 'black'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Your balance',
                        color: 'black',
                        font: {
                            size: 30
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'black',
                            font: {
                                size: 20
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            bottom: 0,
                            top: 0
                        }
                    },

                }

            }
        });


    </script>
<br>
<br>



<?php
$expenses_month = $get->get_expense_month($house_id);

?>
    <div class="card bg-dark text-white" style="text-align: center">
        <img src="../img/red-bg%20-%20Copy.jpg" class="card-img"  alt="..." >
        <div class="card-img-overlay">
            <h5 class="card-title">Expenses for the current month</h5>
            <h1 class="text-white" style="font-size: 150px" id="expense_month">$<?php echo $expenses_month;?></h1>
        </div>
    </div>

    <?php
}
?>
<script>

    $(document).ready(function () {

        $("#neg_submit").click(function () {

            $.ajax({
                type: "POST",
                url: "get_expenses_month.php",
                success: function (response) {
                    $("#expense_month").html(response);
                },
                error: function (response){
                    $("#expense_month").html(response);
                }
            })

        });
    });


</script>

<!--Loader script for loader gif and refresh page-->
<!--<script type="text/javascript" src="../js/loader-refresh.js"></script>-->

</body>
</html>