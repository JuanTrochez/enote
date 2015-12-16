<?php
session_start();

try{
    //On se connecte a MySQL
    $bdd = new PDO('mysql:charset=utf8;host=localhost;dbname=e_note','root','');
}
catch(Exception $e){
    //Si erreur, on affiche un message
    die('Erreur : '.$e->getMessage());
}
