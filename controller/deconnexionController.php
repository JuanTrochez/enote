<?php

include_once '/function/cookie.php';

if (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
        isset($_COOKIE['password']) && !empty($_COOKIE['password'])) {
    cookie($sessionUser->getLogin(), $sessionUser->getPassword(), false);
}

$_SESSION = array();
unset($_SESSION);
session_destroy();

header("Location: " . $basePath . "/?page=connexion");

