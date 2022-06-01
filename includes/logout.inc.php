<?php

session_start();

session_destroy();
unset($_COOKIE);

header("location:../index.php?error=none");


