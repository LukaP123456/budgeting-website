<?php

session_start();
session_unset();
session_destroy();
unset($_COOKIE);
unset($_SESSION);

header("location:../index.php?error=none");


