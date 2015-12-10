<?php

function cookie($pseudo, $password, $do){
    if($do){
            setcookie('login', ''.$pseudo.'', time() + 365*24*3600, '/', $_SERVER['SERVER_NAME']); 
            setcookie('password', ''.$password.'', time() + 365*24*3600, '/', $_SERVER['SERVER_NAME']);
    }else{
            setcookie('login', NULL, time() -3600, '/', $_SERVER['SERVER_NAME']); 
            setcookie('password', NULL, time() -3600, '/', $_SERVER['SERVER_NAME']);
    }
}
