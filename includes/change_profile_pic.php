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

    <!--Sweet alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>LP Budgeting - change profile picture</title>
</head>
<body>


<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-white" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="../includes/user-logged-in.php" class="nav-link">Home</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--HEADER END-->
<!--FORGOTTEN PASSWORD FORM START-->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-black text-white">
                        <h5>Change your profile picture</h5>
                        <p>Enter a file of a picture type (jpg, jpeg, png, pic). If you want to remove your profile picture just click on the submit button</p>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();

                        $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if (strpos($fullUrl, "error=file_large") == true) {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please upload a smaller file
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }elseif (strpos($fullUrl, "error=filer_error") == true){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error uploading image.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }elseif (strpos($fullUrl, "error=wrong_img_typ") == true){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                         Wrong file type please upload only jpg, jpeg, png, pic.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }elseif (strpos($fullUrl, "error=no_pic") == true){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Please upload a pic
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }elseif (strpos($fullUrl, "error=none") == true){
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                         Profile picture changed.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></p>";
                        }else {
                            unset($_SESSION['error-message-resend']);
                        }


                        ?>
                        <form action="change_pic_code.php" id="reset-request-form" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="pic_submit" class="btn btn-primary">Submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--FORGOTTEN PASSWORD FORM END-->


<!--Javascript/Bootstrap links-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>