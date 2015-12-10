<?php

include_once '/function/cookie.php';

if (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
        isset($_COOKIE['password']) && !empty($_COOKIE['password'])) {
    $user = unserialize($_SESSION['user']);
    cookie($user->getLogin(), $user->getPassword(), false);
    //var_dump($_COOKIE);
}

$_SESSION = array();
unset($_SESSION);
session_destroy();

header("Location: http://localhost/enote/?p=connexion");

