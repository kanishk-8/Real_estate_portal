<?php
include 'session.php';
if (isset($_SESSION['loginstring']) && $_SESSION['loginstring'] === $_GET['token']) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
} else {
    echo 'Invalid token';
}
