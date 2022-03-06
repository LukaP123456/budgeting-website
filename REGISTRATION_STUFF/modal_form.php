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
                <form method="POST" action="REGISTRATION_STUFF/login.php">
                    <div class="mb-3">
                        <label for="full-name" class="col-form-label">Full name:</label>
                        <input type="text" class="form-control" id="full-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userName" class="col-form-label">User name:</label>
                        <input type="text" class="form-control" id="userName" name="user_name">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="R_password" class="col-form-label">Repeat password:</label>
                        <input type="password" class="form-control" id="R_password" name="R_password" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" name="submit" >Register</button>
            </div>
        </div>
    </div>
</div>
<!--Modal end-->