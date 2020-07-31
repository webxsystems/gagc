<?php

session_start();

if(!isset($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit;
}
//if(array_key_exists('logout', $_POST)) {
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-86400, '/');
    }
    unset($_SESSION);
    session_destroy();
    header('Location: index.php');
    exit;
//}
