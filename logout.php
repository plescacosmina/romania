<?php session_start();
unset($_SESSION);
unset($_COOKIE);
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: index.php');
} else {
    unset($_SESSION['username']);
    header('Location: login.php');
}