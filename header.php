<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

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
                    <a href="#learn" class="nav-link">What you will learn</a>
                </li>
                <li class="nav-item">
                    <a href="#questions" class="nav-link">Questions</a>
                </li>
                <li class="nav-item">
                    <a href="#instructors" class="nav-link">Reviews</a>
                </li>
                <li>
                    <?php
                    if (isset($_SESSION["userid"])){
                        ?>
                        <li class='nav-item'>
                            <a href='#' class='nav-link'><?php echo $_SESSION["useruid"]?></a>
                        </li><li class='nav-item'>
                        <li class='nav-item'>
                            <a href='includes/logout.inc.php' class='nav-link'>Logout</a>
                        </li><li class='nav-item'>
                    <?php
                    }else{
                        ?>
                        <li class='nav-item'>
<<<<<<< HEAD
                            <a href='includes/login.inc.php' class='nav-link' data-bs-toggle="modal" data-bs-target="#login_modal">Login</a>
=======
                            <a href='login-page.php' class='nav-link'>Login</a>
>>>>>>> 7d61196c346a8d53bf9220ccac59fac13114d4a2
                        </li><li class='nav-item'>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--HEADER END-->