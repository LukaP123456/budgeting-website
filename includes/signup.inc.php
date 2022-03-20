<?php

if (isset($_POST['submit'])) {
    //Grab data from the jQuery script
    $full_name = $_POST["full-name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];


     //Verification token
    $number_rand = rand(0,9999999);
    $salt1="token456456456456465657894531324848951";
    $data = $number_rand.$full_name.$email.$salt1;
    $verify_token = md5($data);

    if (empty($full_name) || empty($email) || empty($pwd) || empty($pwdRepeat) )
    {
        echo "<span class='input-error'> Fill in all fields </span>";
        $errorEmpty = true;
    }
    else
    {
        echo "<span> Signed up successfully </span>";
    }


    //Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($full_name, $pwd, $pwdRepeat, $email, $verify_token);

    //Runs error handlers and inserts the user into the database
    $signup->signupUser();

    //Povratak na glavnu stranu
    header("location../index.php?error=none");


}
else
{
    header("Location: ../index.php?signup=error");
}
?>
<script>
    $("#full-name,#email,#password,#pwdRepeat").removeClassName("input-error");

    let errorEmpty = "<?php echo $errorEmpty; ?>";
    //let errorEmail = "<?php //echo $_SESSION['error-emmail'] ?>//";

    if (errorEmpty == true)
    {
        $("#full-name,#email,#password,#pwdRepeat").addClass("input-error");
    }

    // if (errorEmail == true)
    // {
    //     $("#email").addClassName("input-error");
    // }

    if (errorEmpty === false && errorEmail === false)
    {
        $("#full-name,#email,#password,#pwdRepeat").val("");
    }
</script>
