<?php session_start();
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to access user side";
    header("Location: index.php");
    exit();
}

include_once "classes/first-time-loggedin.classes.php";


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
    <!--Mapbox css link (optional)-->
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet'/>

    <!--Custom styles link-->
    <link rel="stylesheet" href="./CSS/style.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <title>LP Budgeting</title>
</head>
<body>
<!--USER HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

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
                    if (isset($_SESSION["email"])){
                    ?>
                <li class='nav-item'>
                    <a href='#' class='nav-link text-white'><?php echo $_SESSION["email"]; ?></a>
                </li>
                <li class='nav-item'>
                <li class='nav-item'>
                    <a href='includes/logout.inc.php' class='nav-link text-white'>Logout</a>
                </li>
                <?php
                } ?>
            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--USER HEADER END-->


<?php
$first_log = new first_time_logged();
$email = $_SESSION['email'];


if ($first_log->check_if_first_log($email)) {
//    $first_log->log_first_time($email);
    ?>
    <!--FIRST TIME USER LOGGED IN START-->
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-black text-white">
                            <h5>Welcome to LP<span class="text-warning">Budgeting</span></h5>
                            <p>Please fill out the form below to finish setting up your account</p>
                        </div>
                        <div class="card-body">
                            <form action="includes/first-time-log.php" name="first-time-log-form" id="first-time-log-form" method="POST" novalidate>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" name="alone-box" id="alone-radio" style="transform: scale(1.3)" onclick="radioCheck()">
                                    <label class="form-check-label" for="alone-radio">Click this button if you want to save money alone(without a group)</label>
                                    <small class="message" id="message-email"></small>
                                </div>
                                <br>
                                <div class="form-group mb-3">
                                    <label for="email" >Enter the email address of the person you want to invite to save money with you</label>
                                    <input type="email" id="email" name="email-friend" class="form-control"
                                           placeholder="E-mail of a friend/family member" >
                                    <small class="message" id="message-email"></small>
                                </div>
                                <br>
                                <div class="form-group mb-3">
                                    <label for="group-name" >Enter the name of your group/household</label>
                                    <input type="text" id="group-name" name="group-name" class="form-control"
                                           placeholder="Group name/household name" >
                                    <small class="message" id="message-email"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit
                                    </button>
                                </div>
                                <script src="js/first-time-log.js" ></script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FIRST TIME USER LOGGED IN END-->
    <?php
}
?>

</body>
</html>

