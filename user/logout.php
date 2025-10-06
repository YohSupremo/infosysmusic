<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "please Login to access the page";
    header("Location: ../user/login.php");
} else {
    session_destroy();
    header("Location: login.php");
}