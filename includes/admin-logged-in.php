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

<div class="loader-container">
    <img src="../img/loader.gif"  alt="loader">
</div>

<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">LP<span class="text-warning">Budgeting</span> Dashboard</a>
        <!--        <input id="house_name" placeholder="Name of house" type="text">-->


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

for ($i = 0; $i < count($houses_array); $i++) {


    if ($houses_array[$i]['verify_status'] === 1) {
        $verify_text = "User is verified";
    } else {
        $verify_text = "User is not verified";
    }

    if ($houses_array[$i]['role'] === 1) {
        $role_text = "House admin";
    }

    if ($houses_array[$i]['role'] === 1) {
        $role_text = "Regular user";
    }


    if ($houses_array[$i]['first_login'] === null) {
        $first_login_text = "User logged in for the first time";
    } else {
        $first_login_text = "User has yet to login";
    }

    if ($houses_array[$i]['blocked'] === 1) {
        $blocked_text = "House is blocked";
    } else {
        $blocked_text = "House is not blocked";
    }

    echo '<div class="card">
    <div class="card-body">
        <h5 class="card-title" id="parent"><b>House name:</b> ' . $houses_array[$i]['household_name'] . '</h5>
        <p class="card-text"><b>Blocked:</b> ' . $blocked_text . '</p>
        <button type="submit" name="block_btn" class="btn btn-danger block" id="block_btn" value="' . $houses_array[$i]['household_id'] . '">Block house</button>
        <button type="submit" name="unblock_btn" class="btn btn-success unblock" id="unblock_btn" style="margin-left: 20px" value="' . $houses_array[$i]['household_id'] . '">Unblock house</button>
        <br><br>
        <p class="card-text"><b>Users email:</b> ' . $houses_array[$i]['users_email'] . '</p>
        <p class="card-text"><b>Full name:</b>  ' . $houses_array[$i]['full_name'] . '</p>
        <p class="card-text"><b>Verification status:</b>  ' . $verify_text . '</p>
        <p class="card-text"><b>Users\'s role:</b> ' . $role_text . '</p>
        <p class="card-text"><b>Time of sign in:</b> ' . $houses_array[$i]['date_time_signup'] . '</p>
        <p class="card-text"><b>First login:</b>  ' . $first_login_text . '</p>
        <p class="card-text"><b>Users\'s ip address:</b> ' . $houses_array[$i]['ip_adress'] . '</p>
        <p class="card-text"><b>Users\'s web browser and OS:</b> ' . $houses_array[$i]['web_browser_OS'] . '</p>
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>';
}
?>


<script type="text/javascript">

    $(document).ready(function () {

        $(".block").click(function () {
            console.log(123123)

            let house_id = $(this).val();

            console.log(house_id);

            $.ajax({
                method: "post",
                url: "block_house.php",
                data: {
                    house_id: house_id
                },
                success: function (response) {
                    window.location.reload(true);
                    alert(response);
                },
                error: function (response) {
                    alert(response);
                }
            })
        });

        $(".unblock").click(function () {
            console.log(123123)
            let house_id = $(this).val();

            console.log(house_id);


            $.ajax({
                method: "post",
                url: "unblock_house.php",
                data: {
                    house_id: house_id
                },
                success: function (response) {
                    window.location.reload(true);
                    alert(response);
                },
                error: function (response) {
                    alert(response);
                }
            })
        });
    });


</script>

</body>
</html>