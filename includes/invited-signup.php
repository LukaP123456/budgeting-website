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
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet'/>

    <!--Custom styles link-->
    <link rel="stylesheet" href="../CSS/style.css">

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
        <a href="../index.php" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>
<!--navbar end-->
<!--USER HEADER END-->


<!--INVITE SIGNUP FORM START-->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-black text-white">
                        <h5>Welcome to LP<span class="text-warning">Budgeting</span></h5>
                        <p>You have been invited by <span class="text-warning" ><?php echo $_GET['email']; ?> </span> to join him in saving money.</p>
                    </div>
                    <div class="card-body">
                        <form id="signup-form" class="form" method="POST" action="invite-signup-code.inc.php">
                            <?php
                            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


                            if (strpos($fullUrl, "error=empty_input") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> You should fill in on some of those fields below.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=full_name") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> Please only use letters when writing your name!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=invalidemail") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> Your e-mail address is invalid.Please check if you wrote it correctly.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=password_match") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> The passwords you wrote do not match.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=email_taken") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> The e-mail you wrote is already taken please login into your account or use another e-mail address
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=signup_error") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Massive error has happened please contact this email: xy@gmail.com
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=stmtfailed") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Failed to insert into database 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=user_not_found") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        User has not been found
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            } elseif (strpos($fullUrl, "error=token_failed") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        There is an error with your verification token
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            }elseif (strpos($fullUrl, "error=no_submit") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        You can't access this page that way.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                            }
                            else {
                                unset($_SESSION['error1']);
                            }

                            ?>
                            <input type="hidden" value="<?php echo  $_GET['group_name'];?>" name="group_name" id="group_name">
                            <input type="hidden" value="<?php echo $_GET['email'];?>" name="inviter_email" id="inviter_email">
                            <input type="hidden" value="<?php echo $_GET['userID'];?>" name="user_id" id="user_id">


                            <div class="mb-3 input-control">
                                <label for="full-name">Full name\User name</label>

                                    <input type="text" class="form-control" id="full-name" name="full-name"
                                           placeholder="John Smith">
                                    <small class="message" id="message-full-name"></small>

                                <br>
                            </div>
                            <div class="mb-3 input-control">
                                <label for="email">Email</label>
                                <span data-bs-toggle="tooltip" data-bs-placement="right"
                                      title="*You can only have one username/name per e-mail account">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="JohnSmith@gmail.com">
                                    </span>
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


                            <div class="modal-footer">

                                <button type="submit" id="submit" class="btn btn-primary" name="submit">Register now
                                </button>
                            </div>

                            <script src="../js/signup_error_handler.js"></script>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--INVITE SIGNUP FORM END-->


<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!--Bootstrap tooltip link-->
<script src="../js/bootstrap-tooltip.js"></script>

</body>
</html>

