<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/reset-password.class.php";
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
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <!--Custom styles link-->
    <link rel="stylesheet" href="../CSS/style.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>LP Budgeting - reset password</title>
</head>
<body>


<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="../index.php" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

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
                    <a href="../index.php" class="nav-link">Home</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--HEADER END-->


<!--RESET PASSWORD FORM START-->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Reset your password</h5>
                        <p>You will receive an e-mail with instructions on how to reset your password.</p>
                    </div>
                    <div class="card-body">
<?php
if ($_GET['token'] && $_GET['email'])
{
    $token=$_GET['token'];
    $email=$_GET['email'];

    $check_user_class = new reset_password();
    if ($check_user_class->check_user_4reset($email,$token))
    {
        ?>
        <form method="post" action="submit_new_password.php">
            <?php
            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


            if (strpos($fullUrl,"error=passwords-mismatch") == true)
            {
                if (isset($_SESSION["password-mismatch"]))
                {
                    echo $_SESSION["password-mismatch"];
                    unset($_SESSION["password-mismatch"]);
                }

            }
            else
            {
                if (isset($_SESSION["password-change-success"]))
                {
                    echo $_SESSION["password-change-success"];
                    unset($_SESSION["password-change-success"]);
                }

            }
            ?>
            <div class="form-group mb-3">
            <input type="hidden" name="email" value="<?php echo $email;?>">
            <input type="hidden" name="token" value="<?php echo $token;?>">
            <p>Enter New password</p>
            <input type="password" class="form-control" name='password'><br>
            <input type="password" class="form-control" name='password_repeat'>
            </div>
            <div class="form-group mb-3">
            <input type="submit" name="submit_password"  class="btn btn-primary">
            </div>
        </form>
<!--RESET PASSWORD FORM END-->

<?php
    }
    else
    {
        //That user doesn't exist
        echo "error";
    }



}
?>
</body>

<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>