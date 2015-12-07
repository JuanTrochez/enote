<?php
include_once "/class/Statut.php";
include_once "/class/User.php";

if (isset($_POST['valider']))
{
    if (isset($_POST['name_note']) && !empty($_POST['name_note']))
    {
        $date = date("Y-m-d");
        $namenote = htmlentities($_POST['name_note']);
        $user = unserialize($_SESSION['user']);
        
        $newnote = new Note();
        $newnote->setName($namenote);
        $newnote->setTotal(0);
        $newnote->setDate($date);
        $newnote->setUser($user->getId());
        $newnote->setStatut(1);
        
        $newnote->insertNewNote($bdd);
        echo '<div class="bg-success">La note à bien été ajoutée</div><br/><br/>';
        include_once "/views/include/note.php";
    }
}
else 
{
    if (isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
            

        include_once "/views/include/note.php";
    }

    else
    {
        header("Location: http://localhost/enote/?page=connexion");
    }
}