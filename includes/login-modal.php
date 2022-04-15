<!-- LOGIN modal start -->
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login_modal">User Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Fill out this form to login</p>
                <form action="./includes/login.inc.php" method="POST">
                    <?php
                    $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    if (strpos($fullUrl,"error=emptyinput") == true)
                    {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> You should fill in on some of those fields below.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                    }
                    elseif (strpos($fullUrl,"error=email") == true)
                    {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> Your e-mail address is invalid.Please check if you wrote it correctly.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                    }
                    elseif (strpos($fullUrl,"error=stmtfailed") == true)
                    {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> The statement failed to execute.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                    }
                    elseif (strpos($fullUrl,"error=usernotfound") == true)
                    {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> The user was not found.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                    }
                    elseif (strpos($fullUrl,"error=wrongpassword") == true)
                    {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Holy guacamole!</strong> That's not the password from the database.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                    }
                    elseif (strpos($fullUrl,"error=none") == true)
                    {
                        //TODO:Napraviti alert da se ispise succes na strani korisnika ne na strani guesta

                        $_SESSION['login-success'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please fill in the form and we will resend you the verification link. 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";

                    }
                    else
                    {
                        unset($_SESSION['error2']);
                    }

                    ?>
                        <label for="email" class="call-form-label">
                            Email:
                        </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">

                        <label for="password" class="call-form-label">
                            Password:
                        </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
                        <hr>
                        <p>Did not receive Your Verification Email?
                            <a href="./resend-email-verification.php">Resend</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>

<!-- LOGIN modal end -->

