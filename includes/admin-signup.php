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


    <title>LP Budgeting - admin dashboard</title>
</head>

<body class="bg-dark">
<!--ADMIN SIGNUP HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">LP<span class="text-warning">Budgeting</span> Dashboard</a>
    </div>
</nav>
<!--navbar end-->
<!--ADMIN SIGNUP HEADER END-->

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 border-black">
                <div class="card">
                    <div class="card-header bg-black text-white">
                        <h5><span class="text-danger">Admin</span> signup</h5>
                        <p>Fill out this form to signup </p>
                    </div>
                    <div class="card-body">
                        <form id="signup-form" class="form" method="POST" action="../includes/admin-signup-code.php">
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
                            }
                            ?>

                            <div class="mb-3 input-control">
                                <label for="full-name">Full name\User name</label>

                                <input type="text" class="form-control" id="full-name" name="full-name"
                                       placeholder="John Smith">
                                <small class="message" id="message-full-name"></small>

                                <br>
                            </div>
                            <div class="mb-3 input-control">
                                <label for="email">Email</label>
                                <span data-bs-toggle="tooltip" data-bs-placement="top"
                                      title="*You can only have one username/name per e-mail account">
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="JohnSmith@gmail.com">
                        <small class="message" id="message-email"></small>
                        </span>
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

                            <a href="../includes/reset-password-form.php">Forgot your password?</a>

                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary" name="submit">Register now</button>
                            </div>

                            <script src="../js/signup_error_handler.js"></script>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>