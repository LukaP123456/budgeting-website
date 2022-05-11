<?php session_start();  ?>
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

    <title>LP Budgeting - friend invite form</title>
</head>
<body>

<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">

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
                    <div class="card-header bg-dark text-white">
                        <h5>You have been invited by <span class="text-warning"> <?php echo $_SESSION["users_email"];?> </span> to save money on our website.</h5>
                        <p>Please fill out the form below and you will join <span class="text-warning"> <?php echo $_SESSION["users_email"];?> </span> in saving money together </p>
                    </div>
                    <div class="card-body">
                        <form action="reset-request.php" id="reset-request-form" method="POST">
                            <div class="mb-3 input-control">
                                <label for="full-name">Full name\User name</label>
                                <span data-bs-toggle="tooltip" data-bs-placement="right"
                                      title="*You can only have one username/name  per e-mail account">

                                     <input type="text" class="form-control" id="full-name" name="full-name"
                                            placeholder="John Smith">
                                    <small class="message" id="message-full-name"></small>
                                </span>
                                <br>
                            </div>
                            <div class="mb-3 input-control">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="JohnSmith@gmail.com">
                                <small class="message" id="message-email"></small>
                                <br>
                            </div>

                            <div class="mb-3 input-control">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Password">
                                <small class="message" id="message-password"></small>
                                <br>
                            </div>

                            <div class="mb-3 input-control">
                                <label for="pwdRepeat">Password repeat</label>
                                <input type="password" class="form-control" id="pwdRepeat" name="pwdRepeat"
                                       placeholder="Retype Password">
                                <small class="message" id="message-pwdRepeat"></small>
                                <br>
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
<!--Bootstrap tooltip link links-->
<script src="../js/bootstrap-tooltip.js" ></script>

</body>
</html>