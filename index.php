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

    <title>LP Budgeting</title>
</head>
<body>
<!--BODY START-->
<?php
include_once "header.php";
include_once "includes/modal_form.php";
include_once "showcase.php";
include_once "newsletter.php";
include_once "boxes.php";
include_once "learn.php";
include_once "faq-accordion.php";
include_once "review.php";
include_once "contac_map.php";
include_once "footer.php";
?>
<!--BODY END-->
<!--Javascript links -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!--Mapbox link(optional)-->
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibHVrYXAxMjM0IiwiYSI6ImNsMGUyZm9zMzBlbjcza216dHVpaHp1MGsifQ.YiIO8BXNFO_5ulU7cekvnQ';
    let map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-71.060982,42.35725],
        zoom:18,
    });
</script>
</body>
</html>