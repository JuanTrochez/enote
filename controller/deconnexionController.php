<?php

include_once '/function/cookie.php';

if (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
        isset($_COOKIE['password']) && !empty($_COOKIE['password'])) {
    cookie($_SESSION['login'], $_SESSION['password'], false);
}

$_SESSION = array();
unset($_SESSION);
session_destroy();

header("Location: http://" . $_SERVER['SERVER_NAME'] . "/enote/?p=connexion");

