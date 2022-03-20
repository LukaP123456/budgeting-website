<!--    Jquery functions used to stop the from from submitting values in it-->
<script>
    $(document).ready(function (){
        $("signup-form").submit(function (event){
            event.preventDefault();
            let name = $("#full-name").value();
            let email = $("#email").value();
            let password = $("#password").value();
            let pwdRepeat = $("#pwdRepeat").value();
            let submit = $("#submit").value();
            $(".form-message").load("./includes/signup.inc.php", {
                name: name,
                email: email,
                password: password,
                pwdRepeat: pwdRepeat,
                submit: submit
            });
        });
    });
</script>

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
                        <label for="full-name">Full name</label>
                        <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Full name">
                        <br>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" >
                        <br>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                        <br>
                    </div>
                    <div class="mb-3">
                        <label for="pwdRepeat">Password repeat</label>
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




