<?php
require_once "../classes/insert-get-class.php";

$house_name = $_COOKIE['group_name'];
$user_id = $_COOKIE['users_id'];
$get = new Insert_get();
$house_id = $get->get_house_id($user_id);
setcookie("house_hold_id", $house_id, time() + (10 * 365 * 24 * 60 * 60), "/", "");

?>
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
    <link rel="stylesheet" href="../CSS/style.css">

    <!--JQUERY LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <title>LP Budgeting - add category</title>
</head>
<body>


<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="../index.php" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="user-logged-in.php" class="nav-link text-white">Back</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--HEADER END-->
<!--ADD CATEGORY FORM START-->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white" style="background: url('../img/red-bg.jpg'); background-size: cover; height: 10vh"">
                    <h5>Add new category</h5>
                </div>
                <div class="card-body">
                    <form action="add-new-negative-category-code.php" id="add_form" method="POST">
                        <script>
                            $(document).ready(function () {
                                //use button click event
                                $("#add_btn2").click(function (e){
                                    e.preventDefault();
                                    let category_name2 = $("#category_name2").val().trim();
                                    let category_type2 = $("#category_type2").val();
                                    let house_hold_id2 = $("#household_id2").val();

                                    let check_name = 0;

                                    if (category_name2 === ""){
                                        $("#category_name2").addClass("border border-danger border-2");
                                        $("#error_category_name2").text(" Please write the name of your category ").addClass("text-danger fas fa-exclamation-circle ");
                                        $("#response").html(" ");
                                        check_name = 1;
                                    }else {
                                        $('#category_name2').addClass("border border-success border-2").removeClass("border border-danger border-2");
                                        $("#error_category_name2").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
                                    }

                                    if (check_name !==1 ){
                                        $.ajax({
                                            method: "post",
                                            url: "add-new-negative-category-code.php",
                                            data: {
                                                category_name2: category_name2,
                                                category_type2: category_type2,
                                                house_hold_id2: house_hold_id2
                                            },
                                            success: function (response){
                                                console.log(response);
                                                if(response === "success"){
                                                    $("#response").html("<div class='alert alert-success' role='alert'>Successfully added a new category</div>");
                                                }else{
                                                    $("#response").html(response);
                                                }
                                            },
                                            error: function(response) {
                                                alert(JSON.stringify(response));
                                            }
                                        })
                                    }


                                });
                            });
                        </script>

                        <input type="hidden" value="0" name="category_type2" id="category_type2">
                        <input type="hidden"  value="<?php if (isset($house_id)){  echo $house_id;}?>" name="household_id2" id="household_id2">
                        <div class="form-group mb-3">

                            <label for="category_name2">Category name</label>
                            <input type="text" id="category_name2" name="category_name2" class="form-control"
                                   placeholder="Enter new category name">
                            <small class="message" id="error_category_name2"></small>
                            <div id="response" ></div>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="add_btn2" id="add_btn2" class="btn btn-danger">Submit
                            </button>
                        </div>
                        <!--                            <script src="../js/reset-password-error-handler.js"></script>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--ADD CATEGORY  FORM END-->


<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>