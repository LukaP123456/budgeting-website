<?php

if ($_GET['token'] && $_GET['email'])
{
    $token=$_GET['token'];
    $email=$_GET['email'];

    $check_user_class = new reset_password();
    if ($check_user_class->check_user_4reset($email,$token))
    {
        ?>
        <form method="post" action="submit_new_password.php">
            <?php
            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


            if (strpos($fullUrl,"error=passwords-mismatch") == true)
            {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Warning!</strong> The entered passwords do not match
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            else
            {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Success!</strong> Your password has been successfully reset.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            ?>
            <input type="hidden" name="email" value="<?php echo $email;?>">
            <input type="hidden" name="token" value="<?php echo $token;?>">
            <p>Enter New password</p>
            <input type="password" name='password'>
            <input type="password" name='password_repeat'>
            <input type="submit" name="submit_password">
        </form>
        <?php
    }
    else
    {
        //That user doesn't exist
        echo "error";
    }



}



