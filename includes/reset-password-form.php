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
    <link rel="stylesheet" href="../CSS/style.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

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
<!--FORGOTTEN PASSWORD FORM START-->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-black text-white">
                        <h5>Reset your password</h5>
                        <p>You will receive an e-mail with instructions on how to reset your password.</p>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();

                        $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if (strpos($fullUrl, "error=empty_email") == true) {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Warning!</strong> That's not the password from the database.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }elseif (strpos($fullUrl, "error=email_notindb") == true){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Warning!</strong> An account with the entered email doesn't exist.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }else {
                            unset($_SESSION['error-message-resend']);
                        }


                        ?>
                        <form action="reset-request.php" id="reset-request-form" method="POST">
                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input type="email" id="email" name="email" class="form-control"
                                       placeholder="Enter your e-mail address">
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

<!--FORGOTTEN PASSWORD FORM END-->


<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>