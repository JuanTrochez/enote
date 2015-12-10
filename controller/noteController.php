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
else if (isset($_POST['modifier'])){
    
    if (isset($_POST['name_note']) && !empty($_POST['name_note']))
    {
        $namenote = htmlentities($_POST['name_note']);
//        $user = unserialize($_SESSION['user']);
        
        //s'il a coché la case 'Cloturer'
        if(isset($_POST['cloturer']) && !empty($_POST['cloturer'])){
            $statutnote = "2";
        }
        else {
            $statutnote = "1";
        }
        $nid = $_GET['id'];
        
        Note::updateNote($bdd, $nid, $namenote, $statutnote);
        echo '<div class="bg-success">La note à bien été modifié</div><br/><br/>';
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
        header("Location: " . $basePath . "/?page=connexion");
    }
}