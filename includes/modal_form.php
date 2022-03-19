

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
                <form id="signup-form"  method="POST" action="./includes/signup.inc.php">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Full name">
                        <br>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" >
                        <br>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                        <br>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="pwdRepeat" name="pwdRepeat" placeholder="Retype Password" >
                        <br>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary" name="submit" >Register now</button>
                    </div>
                    <p class="form-message"></p>
                </form>

            </div>
        </div>
    </div>
</div>



<script>
    $("#full-name,#email,#password,#pwdRepeat").removeClassName("input-error");

    let errorEmpty = "<?php echo $_SESSION['error-empty'] ?>";
    let errorEmail = "<?php echo $_SESSION['error-emmail'] ?>";

    if (errorEmpty === true)
    {
        $("#full-name,#email,#password,#pwdRepeat").addClassName("input-error");
    }

    if (errorEmail === true)
    {
        $("#email").addClassName("input-error");
    }

    if (errorEmpty === false && errorEmail === false)
    {
        $("#full-name,#email,#password,#pwdRepeat").val("");
    }
</script>
