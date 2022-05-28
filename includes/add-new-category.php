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
                    <div class="card-header text-white" style="background: url('../img/bg_money.jpg'); background-size: cover; height: 10vh"">
                        <h5>Add new category</h5>
                    </div>
                    <div class="card-body">
                        <form action="add-category-code.php" id="add_form" method="POST">
                            <script>
                                $(document).ready(function () {
                                    //use button click event
                                    $("#add_btn").click(function (e){
                                        e.preventDefault();
                                        let category_name = $("#category_name").val();
                                        let category_type = $("#category_type").val();
                                        let house_hold_id = $("#household_id").val();

                                        $.ajax({
                                            method: "post",
                                            url: "add-category-code.php",
                                            data: {
                                                category_name: category_name,
                                                category_type: category_type,
                                                house_hold_id: house_hold_id
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
                                    });
                                });
                            </script>

                            <input type="hidden" value="1" name="category_type" id="category_type">
                            <input type="hidden"  value="<?php if (isset($_COOKIE['house_hold_id'])){  echo $_COOKIE['house_hold_id'];}?>" name="household_id" id="household_id">
                            <div class="form-group mb-3">
                                <p id="response" ></p>
                                <label for="category_name">Category name</label>
                                <input type="text" id="category_name" name="category_name" class="form-control"
                                       placeholder="Enter new category name">
                                <small class="message" id="message-category_name"></small>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="add_btn" id="add_btn" class="btn btn-success">Submit
                                </button>
                            </div>
<!--                            <script src="../js/reset-password-error-handler.js"></script>-->
                        </form>
                    </div>
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