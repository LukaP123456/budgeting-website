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
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet'/>

    <!--Custom styles link-->
    <link rel="stylesheet" href="./CSS/style.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>


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

<!--Javascript links-->
<!--Jquery functions used to stop the from from submitting values in it-->
<script>

    //MODAL SIGNUP FORM STOPPER - used to stop the modal form from disappearing so the user
    //can see the error message which occurs on sign up
    let error = <?php if (isset($_SESSION['error1'])) {
        echo $_SESSION['error1'];
    } else {
        echo 0;
    }
    ?>;
    console.log(error);
    $(document).ready(function () {
        if (error === 1) {
            console.log(error)
            console.log("unutar if-a");
            $("#enroll").modal("show");

        }
    });


    //LOGIN SIGNUP FORM STOPPER - used to stop the modal form from disappearing so the user
    //can see the error message which occurs on sign up

    let error2 = <?php if (isset($_SESSION['error2'])) {
        echo $_SESSION['error2'];
    } else {
        echo 0;
    } ?>;
    console.log(error2);
    $(document).ready(function () {
        if (error2 === 1) {
            console.log(error)
            console.log("unutar if-a");
            $("#login_modal").modal("show");

        }
    });


</script>

<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!--Mapbox links-->
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script src="js/Mapbox.js"></script>
<!--Mapbox links-->

</body>
</html>