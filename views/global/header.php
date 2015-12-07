<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>E note</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo $basePath ?>vendor/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo $basePath ?>css/app.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Amaranth:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <header>
           <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="<?php echo $basePath; ?>">Enote</a>
                </li>
                <li>
                    <a href="<?php echo $basePath; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo $basePath; ?>/?page=note">Nouvelle note</a>
                </li>
                <li>
                    <a href="<?php echo $basePath; ?>/?page=frais">Ajouter un frais</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <?php
                        if($secu->logged())
                        {
                            ?>
                           
                <li class="deco">
                    <a href="?page=deconnexion">Déconnexion<span class="sr-only">(current)</span></a>
                </li>
                        <?php
                        }
                        ?>
                </li>
            </ul>
        </div>
        </header>
        
        <section class ="section">
        