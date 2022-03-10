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
                    <div class="mb-3">
                        <label for="username" class="call-form-label">
                            User name:
                        </label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="User name">
                        <label for="password" class="call-form-label">
                            Password:
                        </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- LOGIN modal start -->