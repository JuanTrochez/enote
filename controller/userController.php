<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['changementDevise']) && verifModification($sessionUser))
{
    
    $sessionUser->setPassword($_POST['nouveauMdp']);
    $sessionUser->setDevise($_POST['nouveauMdp']);
    $_SESSION['user'] = serialize($sessionUser);
    $sessionUser->editUser($bdd,false);
    echo '<div class="bg-success">Modifications enregistrées </div><br/><br/>';
}
    
if(isset($_SESSION['user']) && !empty($_SESSION['user']))
{
    include_once 'views/include/profil.php';
}else{
    header("Location: http://localhost/enote/?page=connexion");
}


function verifModification($user)
{
    $modifCorrect = true;  
    // Verifie que les champs sont remplies
    if(!isset($_POST['ancienMdp']) || !isset($_POST['nouveauMdp']) || !isset($_POST['confirmationMdp']))
    {
        echo 'Erreur veuillez remplir tous les champs';
        $modifCorrect = false;
    }
    //Verifie que le mot de passe entré par l'utilisateur est correct
    else if(strcmp($_POST['ancienMdp'], $user->getPassword()) != 0)
    {
        echo 'Erreur d identification, le mot de passe est incorrect';
        $modifCorrect = false;
    }
    //Verifie que le nouveau mot de passe est supérieur ou égale à 6 caractères
    else if(strlen($_POST['nouveauMdp'])<6)
    {
        echo 'Veuillez choisir un mot de passe de 6 caratères minimum';
        $modifCorrect = false;
    }
    //Verifie que la confirmation du mot de passe est correct
    else if(strcmp($_POST['nouveauMdp'], $_POST['confirmationMdp']) != 0)
    {
        echo 'Erreur avec la confirmation du mot de passe';
        $modifCorrect = false;
    }
    return $modifCorrect;
}