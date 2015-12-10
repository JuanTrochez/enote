<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['modifier']))
{
    
    
}
    
if(isset($_SESSION['user']) && !empty($_SESSION['user']))
{
    include_once 'profil.php';
}else{
    header("Location: http://localhost/enote/?page=connexion");
}
