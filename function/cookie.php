<?php

function cookie($pseudo, $password, $undo){
    if(!$undo){
            setcookie('login', ''.$pseudo.'', time() + 365*24*3600, null, null, false, true); 
            setcookie('password', ''.$password.'', time() + 365*24*3600, null, null, false, true);
    }else{
            setcookie('login', '', time() -3600, null, null, false, true); 
            setcookie('password', '', time() -3600, null, null, false, true);
    }
}
