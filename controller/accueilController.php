<?php

include_once "/class/User.php";

var_dump($_SESSION);
if (isset($_SESSION['user']) && !empty($_SESSION['user']))
{
    echo "hello accueil";
    include_once "/views/include/accueil.php";
}
elseif (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
        isset($_COOKIE['password']) && !empty($_COOKIE['password']))
    {
        cookie($_COOKIE['login'],$_COOKIE['password'],true);
        $user = new User();
        $user->setLogin($_COOKIE['login']);
        $user->setPassword($_COOKIE['password']);
        $user->connect($bdd,true);
        include_once "/views/include/accueil.php";
    }
else 
{
    header("Location: ?page=connexion");
}

