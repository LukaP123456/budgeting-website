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
    ?>
    <!--FIRST TIME USER LOGGED IN START-->
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center"
                 style="background: url('./img/okean3.jpg'); background-size: cover; ">
                <div class="card-header">
                    <h1><span class="text-white">Welcome to LP</span><span class="text-warning">Budgeting</span></h1>
                    <p class="text-white">Before starting your plan please fill out the form below and answer our
                        questions.</p>
                    <p class="text-white">Will you be saving your money alone or with someone else</p>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label text-white" for="flexRadioDefault1">
                                I will be saving money alone.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                   checked>
                            <label class="form-check-label text-white" for="flexRadioDefault2">
                                I will be saving money with someone.
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="text" class="">
                            <label class="form-check-label text-white" for="flexRadioDefault2">
                                Invite another person who you want to save money with
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                   checked>
                            <label class="form-check-label text-white" for="flexRadioDefault2">
                                I will be saving money with someone.
                            </label>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--FIRST TIME USER LOGGED IN END-->


    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-white" style="background: url('./img/okean3.jpg'); background-size: cover; ">
                        <div class="card-header">
                            <h5>Reset your password</h5>
                            <p>You will receive an e-mail with instructions on how to reset your password.</p>
                        </div>
                        <div class="card-body">
                            <form action="reset-request.php" id="reset-request-form" method="POST">
                                <div class="form-group mb-3">
                                    <label for="email">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                           placeholder="Enter your e-mail address">
                                    <small class="message" id="message-email"></small>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="radio">
                                    <label for="email">Email address</label>
                                    <small class="message" id="message-email"></small>
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" name="reset-request-submit" class="btn btn-primary">Submit
                                    </button>
                                </div>
                                <script src="../js/reset-password-error-handler.js"></script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

</body>
</html>

