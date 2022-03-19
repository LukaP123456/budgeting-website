<?php

if (isset($_POST['submit'])) {
    //Grab data from the jQuery script
    $full_name = $_POST["name"];
    $pwd = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];


     //Verification token
    $number_rand = rand(0,9999999);
    $salt1="token456456456456465657894531324848951";
    $data = $number_rand.$full_name.$email.$salt1;
    $verify_token = md5($data);


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
