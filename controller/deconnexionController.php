<?php

$_SESSION = array();
unset($_SESSION);
session_destroy();
cookie($pseudo, $password, false);
var_dump($_SESSION);
echo "deco";

//header("Location: http://" . $_SERVER['SERVER_NAME']);

