<?php

$newpwdadm = 'nouveauMdpAdmin';

if(isset($_POST['changementParamUser']) && verifModification($sessionUser) || isset($_POST['changementDeviseUser']) || isset($_POST['changementEmailUser']))
{
    $sucess = true;
    
    if(isset($_POST['changementDeviseUser']))
    {
        $sessionUser->setDevise(htmlentities($_POST['devise_id']));
    }else if(isset($_POST['changementParamUser']))
    {
        $sessionUser->setPassword(sha1(htmlentities($_POST['nouveauMdp'])));
    }else
    {
        if(filter_var($_POST['nouveauMail'], FILTER_VALIDATE_EMAIL))
        {
            $sessionUser->setEmail(htmlentities($_POST['nouveauMail']));
        }else{
            echo 'Erreur avec le mail';
            $sucess = false;
        }    
    }
    
    $_SESSION['user'] = serialize($sessionUser);
    $sessionUser->editUser($bdd);
    if($sucess)
    {
       echo '<div class="bg-success">Modifications enregistrées </div><br/><br/>'; 
    }   
    
}else if(isset($_POST['changementParamUserByAdmin']) && verifModificationFromAdmin()){
    
    $CloneUser= User::getUserById($bdd, $_GET['id']);
    
    $CloneUser->setName(htmlentities($_POST['changerNomUser']));
    $CloneUser->setLogin(htmlentities($_POST['changerLoginUser']));
    $CloneUser->setEmail(htmlentities($_POST['changerMailUser']));
    $CloneUser->setRole(htmlentities($_POST['changerRoleUser']));
    $CloneUser->setDevise(htmlentities($_POST['devise_idAdmin']));
    
    if(!empty(htmlentities($_POST[$newpwdadm])))
    {
        $CloneUser->setPassword(sha1(htmlentities($_POST[$newpwdadm])));
    }
    
    $CloneUser->editUserByAdmin($bdd, $CloneUser);
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
    $modifCorrect = false;
    $newpwd = htmlentities($_POST['nouveauMdp']);
    // Verifie que les champs sont remplies
    if(!isset($_POST['ancienMdp']) || !isset($newpwd) || !isset($_POST['confirmationMdp']))
    {
        echo 'Erreur veuillez remplir tous les champs';
    }
    //Verifie que le mot de passe entré par l'utilisateur est correct
    elseif(strcmp(sha1(htmlentities($_POST['ancienMdp'])), $user->getPassword()) != 0)
    {
        echo 'Erreur d identification, le mot de passe est incorrect';
    }
    //Verifie que le nouveau mot de passe est supérieur ou égale à 6 caractères
    elseif(strlen($newpwd)<6)
    {
        echo 'Veuillez choisir un mot de passe de 6 caratères minimum';
    }
    //Verifie que la confirmation du mot de passe est correct
    elseif(strcmp($newpwd, htmlentities($_POST['confirmationMdp'])) != 0)
    {
        echo 'Erreur avec la confirmation du mot de passe';
    }
    else { $modifCorrect = true; }
    return $modifCorrect;
}


function verifModificationFromAdmin()
{
    $modifCorrect = false;
    $changemail = htmlentities($_POST['changerMailUser']);
    $newpwdadmin = htmlentities($_POST['nouveauMdpAdmin']);
    //Verifie que tous le champs ne sont pas vide
    if(!isset($_POST['changerNomUser']) || !isset($_POST['changerLoginUser']) || !isset($changemail) || !isset($_POST['changerRoleUser']))
    {
        echo 'Erreur veuillez remplir tous les champs';
    }
    //Verifie que l'adresse mail est valide
    elseif(!filter_var($changemail, FILTER_VALIDATE_EMAIL)){
        echo'Erreur, adresse mail non valide';
    }
    //Verifie que le nouveau mot de passe est supérieur ou égale à 6 caractères
    elseif(!empty($newpwdadmin) && strlen($newpwdadmin)<6){
        echo 'Veuillez choisir un mot de passe de 6 caratères minimum';
    }
    //Verifie que la confirmation du mot de passe est correct
    elseif(strcmp($newpwdadmin, $_POST['confirmationMdpAdmin']) != 0){
        echo 'Erreur avec la confirmation du mot de passe';
    }
    else { $modifCorrect = true; }
    return $modifCorrect;
}