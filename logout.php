<?php

session_start();
unset($_SESSION["user_email"]);
session_destroy();
header("Location: index.php");
