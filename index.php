<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Bootstrap icons link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--Mapbox css link (optional)-->
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <!--Custom styles link-->
    <link rel="stylesheet" href="CSS/style.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

    <title>LP Budgeting</title>
</head>
<body>
<!--BODY START-->
<?php
include_once "header.php";
include_once "showcase.php";
include_once "newsletter.php";
include_once "boxes.php";
include_once "learn.php";
include_once "faq-accordion.php";
include_once "review.php";
include_once "contact_map.php";
include_once "footer.php";
include_once "includes/modal_form.php";
include_once "includes/login-modal.php";
?>
<!--BODY END-->

<?php
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($fullUrl,"error=empty") == true)
{
    echo "<p>You did not fill out all fields!</p>";
    exit();
}
elseif (strpos($fullUrl,"error=full_name") == true)
{
    echo "<p>You used invalid characters. Please use only capital or small letters.</p>";
    exit();
}
elseif (strpos($fullUrl,"error=invalidemail") == true)
{
    echo "<p>Your email address is invalid.</p>";
    exit();
}
elseif (strpos($fullUrl,"error=password_match") == true)
{
    echo "<p>Your passwords do not match.</p>";
    exit();
}
elseif (strpos($fullUrl,"error=email_taken") == true)
{
    echo "<p>There is already a user signed up with that email address.</p>";
    exit();
}
elseif (strpos($fullUrl,"error=none") == true)
{
    echo "<p>You have been signed up!</p>";
    exit();
}


?>

<!--Javascript links-->


<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!--Mapbox links-->
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script src="js/Mapbox.js" ></script>
<!--Mapbox links-->




</body>
</html>