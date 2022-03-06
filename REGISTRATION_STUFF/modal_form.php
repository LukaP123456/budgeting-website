<!--SIGNUP = modal_form.php-->
<!--Modal start-->
<div class="modal fade" id="enroll" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Fill out this form we will get back to you</p>
                <!-- Form -->
                <form method="POST" action="../REGISTRATION_STUFF/code.php">
                    <div class="mb-3">
                        <label for="full-name" class="col-form-label">Full name:</label>
                        <input type="text" class="form-control" id="full-name" placeholder="Full name" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                    </div>
                    <div class="mb-3">
                        <label for="username" class="col-form-label">User name:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="User name" >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                    </div>
                    <div class="mb-3">
                        <label for="pwdRepeat" class="col-form-label">Repeat password:</label>
                        <input type="password" class="form-control" id="pwdRepeat" name="pwdRepeat" placeholder="Retype Password" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" name="submit" >Register now</button>
            </div>
        </div>
    </div>
</div>
<!--Modal end-->