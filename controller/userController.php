<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['changementParamUser']) && verifModification($sessionUser))
{
    
    $sessionUser->setPassword($_POST['nouveauMdp']);
    $sessionUser->setDevise($_POST['devise_id']);
    $_SESSION['user'] = serialize($sessionUser);
    $sessionUser->editUser($bdd);
    echo '<div class="bg-success">Modifications enregistrées </div><br/><br/>';
    
}else if(isset($_POST['changementParamUserByAdmin']) && verifModificationFromAdmin()){
    
    $CloneUser= User::getUserById($bdd, $_GET['id']);
    
    $CloneUser->setName($_POST['changerNomUser']);
    $CloneUser->setLogin($_POST['changerLoginUser']);
    $CloneUser->setEmail($_POST['changerMailUser']);
    $CloneUser->setRole($_POST['changerRoleUser']);
    $CloneUser->setDevise($_POST['devise_idAdmin']);
    
    if(!empty($_POST['nouveauMdpAdmin']))
    {
        $CloneUser->setPassword($_POST['nouveauMdpAdmin']);
    }
    
    $CloneUser->editUserByAdmin($bdd, $CloneUser);
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


function verifModificationFromAdmin()
{
    $modifCorrect = true;
    //Verifie que tous le champs ne sont pas vide
    if(!isset($_POST['changerNomUser']) || !isset($_POST['changerLoginUser']) || !isset($_POST['changerMailUser']) || !isset($_POST['changerRoleUser']))
    {
        echo 'Erreur veuillez remplir tous les champs';
        $modifCorrect = false;
    }
    //Verifie que l'adresse mail est valide
    else if(!filter_var($_POST['changerMailUser'], FILTER_VALIDATE_EMAIL))
    {
        echo'Erreur, adresse mail non valide';
        $modifCorrect = false;
    }
    if(!empty($_POST['nouveauMdpAdmin']))
    {
        //Verifie que le nouveau mot de passe est supérieur ou égale à 6 caractères
        if(strlen($_POST['nouveauMdpAdmin'])<6)
        {
            echo 'Veuillez choisir un mot de passe de 6 caratères minimum bitch';
            $modifCorrect = false;
        }
        //Verifie que la confirmation du mot de passe est correct
        else if(strcmp($_POST['nouveauMdpAdmin'], $_POST['confirmationMdpAdmin']) != 0)
        {
            echo 'Erreur avec la confirmation du mot de passe';
            $modifCorrect = false;
        }
    }
    return $modifCorrect;
}