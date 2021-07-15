<?php
session_start();
if (isset($_SESSION['user_name'])) {
    $_SESSION['user_name'] = null;
    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/myGallery/index.php");
    exit();
}