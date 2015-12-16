<?php

function cookie($pseudo, $password, $do){
    $server_name = $_SERVER['SERVER_NAME'];
    if($do){
            setcookie('login', ''.$pseudo.'', time() + 365*24*3600, '/', $server_name); 
            setcookie('password', ''.$password.'', time() + 365*24*3600, '/', $server_name);
    }else{
            setcookie('login', NULL, time() -3600, '/', $server_name); 
            setcookie('password', NULL, time() -3600, '/', $server_name);
    }
}
