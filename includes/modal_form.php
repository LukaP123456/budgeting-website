<!--SIGNUP = modal_form.php-->
<!--Modal start-->
<div class="modal fade" id="enroll" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollLabel">User signup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="lead">Fill out this form we will get back to you</p>
                <!-- Form -->
                <form id="signup-form" class="form" method="POST" action="./includes/signup.inc.php">
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
                    } else {
                        unset($_SESSION['error1']);
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

                    <a href="./includes/reset-password-form.php">Forgot your password?</a>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary" name="submit">Register now</button>
                    </div>

                    <script src="./js/signup_error_handler.js"></script>

                </form>
            </div>
        </div>
    </div>
</div>


<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!--Bootstrap tooltip link-->
<script src="./js/bootstrap-tooltip.js"></script>


