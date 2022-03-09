<?php session_start(); ?>
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
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <!--Custom styles link-->
    <link rel="stylesheet" href="CSS/style.css">

    <title>LP Budgeting</title>
</head>
<body>

<!--HEADER LOGIN START-->
<!--navbar login start-->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
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
                <li class="nav-item">
                    <a href="#learn" class="nav-link">What you will learn</a>
                </li>
                <li class="nav-item">
                    <a href="#questions" class="nav-link">Questions</a>
                </li>
                <li class="nav-item">
                    <a href="#instructors" class="nav-link">Reviews</a>
                </li>
                <li>
                    <?php
                    if (isset($_SESSION["userid"])){
                    ?>
                <li class='nav-item'>
                    <a href='#' class='nav-link'><?php echo $_SESSION["useruid"]?></a>
                </li><li class='nav-item'>
                <li class='nav-item'>
                    <a href='includes/logout.inc.php' class='nav-link'>Logout</a>
                </li><li class='nav-item'>
                    <?php
                    }else{
                    ?>
                <li class='nav-item'>
                    <a href='REGISTRATION_STUFF/modal_form.php' class='nav-link'>Signup</a>
                </li><li class='nav-item'>
                <li class='nav-item'>
                    <a href='login-page.php' class='nav-link'>Login</a>
                </li><li class='nav-item'>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar login end-->
<!--HEADER LOGIN END-->



</body>
</html>