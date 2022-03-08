<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<ul>
    <?php
        if (isset($_SESSION["userid"]))
        {
        ?>
        <li><a href="#"><?php echo $_SESSION["userid"]?></a></li>
        <li><a href="includes/logout.inc.php">LOGOUT</a></li>
        <?php
        }
        else
        {
        ?>
        <li><a href="#">SIGN UP</a></li>
        <li><a href="#">LOGIN</a></li>
        <?php
        }
    ?>
</ul>



<section class="login">
    <div id="wrapper">
        <div class="index-login-signup">
            <h4>SIGN UP</h4>
            <p>Don't have an account yet? Sing up here!</p>
            <form action="includes/signup.inc.php" method="post" >
                <input type="text" name="uid" placeholder="username">
                <input type="password" name="pwd" placeholder="password">
                <input type="password" name="pwdRepeat" placeholder="repeat password">
                <input type="text" name="email" placeholder="E-mail">
                <br>
                <button type="submit" name="submit" >SIGN UP</button>
            </form>
        </div>


        <div class="index-login-login">
            <h4>LOGIN</h4>
            <p>Don't have an account yet? Sign up here!</p>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="username">
                <input type="password" name="pwd" placeholder="password">
                <br>
                <button type="submit" name="submit" >LOGIN</button>
            </form>
        </div>
    </div>
</section>



</body>
</html>