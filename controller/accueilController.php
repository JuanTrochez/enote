<?php
if ($_SESSION['user'])
{
    include_once "/views/include/accueil.php";
}
elseif (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
        isset($_COOKIE['password']) && !empty($_COOKIE['password']))
    {
        cookie($_COOKIE['login'],$_COOKIE['password'],true);
        include_once "/views/include/accueil.php";
    }
else 
{
    include_once "/views/include/connexion.php";
}
