<?php

session_start();
session_unset();
session_destroy();
unset($_COOKIE);

header("location:../index.php?error=none");


