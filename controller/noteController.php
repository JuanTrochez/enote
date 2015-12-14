<?php
include_once "/class/Statut.php";
include_once "/class/User.php";

if (isset($_POST['Editer'])){
    
    $note_name = $_POST['name_note'];
    if (isset($note_name) && !empty($note_name))
    {
        $namenote = htmlentities($note_name);
        $statutnote = $_POST['statut'];
        $nid = $_GET['id'];
        
        Note::updateNote($bdd, $nid, $namenote, $statutnote);
        echo '<div class="bg-success">La note à bien été éditée</div><br/><br/>';
    }
}

elseif (isset($_POST['valider']))
{
    $note_name = $_POST['name_note'];
    if (isset($note_name) && !empty($note_name))
    {
        $date = date("Y-m-d");
        $namenote = htmlentities($note_name);
        
        $newnote = new Note();
        $newnote->setName($namenote);
        $newnote->setDate($date);
        $newnote->setUser($sessionUser->getId());
        $newnote->setStatut(1);
        
        $newnote->insertNewNote($bdd);
        echo '<div class="bg-success">La note à bien été ajoutée</div><br/><br/>';
    }
}
elseif (isset($_POST['modifier'])){
    
    $note_name = $_POST['name_note'];
    if (isset($note_name) && !empty($note_name))
    {
        $namenote = htmlentities($note_name);
        
        //s'il a coché la case 'Cloturer'
        if(isset($_POST['cloturer']) && !empty($_POST['cloturer'])){
            $statutnote = "2";
        }
        else {
            $statutnote = "1";
        }
        $nid = $_GET['id'];
        
        Note::updateNote($bdd, $nid, $namenote, $statutnote);
        echo '<div class="bg-success">La note à bien été modifiée</div><br/><br/>';
    }
}

include_once "/views/include/note.php";