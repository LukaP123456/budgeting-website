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
                        <h5><span class="text-danger">Admin</span> login</h5>
                        <p>Fill out this form to login </p>
                    </div>
                    <div class="card-body">
                        <form id="login-form" action="../includes/admin-login.inc.php" method="POST">
                            <?php
                            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            if (strpos($fullUrl, "error=emptyinput") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> You should fill in on some of those fields below.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                            } elseif (strpos($fullUrl, "error=email") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> Your e-mail address is invalid.Please check if you wrote it correctly.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                            } elseif (strpos($fullUrl, "error=stmtfailed") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> The statement failed to execute.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                            } elseif (strpos($fullUrl, "error=usernotfound") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> The user was not found.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                            } elseif (strpos($fullUrl, "error=wrongpassword") == true) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> That's not the password from the database.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                            }

                            ?>
                            <label for="login-email" class="call-form-label">
                                Email:
                            </label>
                            <input type="email" class="form-control" id="login-email" name="login-email" placeholder="Email">
                            <small class="message" id="message-login-email"></small>
                            <br>
                            <label for="login-password" class="call-form-label">
                                Password:
                            </label>
                            <input type="password" class="form-control" name="login-password" id="login-password"
                                   placeholder="Password">
                            <small class="message" id="message-login-password"></small>
                            <br>


                            <div class="modal-footer">
                                <p>Did not receive Your Verification Email?
                                    <a href="../resend-email-verification.php">Resend</a>
                                </p>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="login-submit" id="login-submit" class="btn btn-primary">Login</button>
                                <hr>
                            </div>
                            <script src="../js/login_error_handler.js"></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>