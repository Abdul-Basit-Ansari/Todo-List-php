<?php

include "includes/config.php";
session_start();

if (isset($_SESSION["user_email"])) {
    header("Location: todos.php");
    die();
}

if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

    if (emailIsValid($email)) {
        if (checkLoginDetails($email, $password)) {
            $_SESSION["user_email"] = $email;
            header("Location: todos.php");
            die();
        } else {
            echo "<script>alert('Login details is invalid.');window.location.replace('index.php');</script>";
        }
    } else {
        $user_registration = createUser($email, $password);
        if ($user_registration) {
            $_SESSION["user_email"] = $email;
            header("Location: todos.php");
            die();
        } else {
            echo "User registration failed. Please try again later.";
            die();
        }
    }
} 
else {
    header("Location: index.php");
    die();
}
