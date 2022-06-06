<?php session_start();
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to access user side";
    header("Location: ../index.php");
    exit();
}

require_once "../classes/first-time-loggedin.classes.php";
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


    <title>LP Budgeting</title>
</head>
<body>

<!--<div class="loader-container">-->
<!--    <img src="../img/loader.gif"  alt="loader">-->
<!--</div>-->

<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">LP<span class="text-warning">Budgeting</span> Dashboard</a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class='nav-item'>
                    <a href='logout.inc.php' class='nav-link text-white'>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--HEADER END-->
<br><br>
<?php
require_once "../classes/insert-get-class.php";

$get = new Insert_get();

$houses_array = $get->get_all_houses();

var_dump($houses_array);



?>


<!--<div class="card text-center">-->
<!--    <div class="card-header">-->
<!--        -->
<!--    </div>-->
<!--    <div class="card-body">-->
<!--        <h5 class="card-title">Special title treatment</h5>-->
<!--        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
<!--        <a href="#" class="btn btn-primary">Go somewhere</a>-->
<!--    </div>-->
<!--    <div class="card-footer text-muted">-->
<!--        2 days ago-->
<!--    </div>-->
<!--</div>-->

</body>
</html>