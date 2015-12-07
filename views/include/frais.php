<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<form action="" method="POST" enctype="multipart/form-data">
    <p>
        Formulaire d'envoi de fichier :<br />
        <input type="file" name="monfichier" /><br />
        <input type="text" name="date" placeholder="jj/mm/aaaa"/>
        <input type="text" name="description" placeholder="Description"/>
        <br>
        <input type="text" name="montant" placeholder="TTC"/>
        
        <select name="devise_id">
            <option value="1">€</option>
            <option value="2">$</option>
        </select>
        <br>
        <input type="submit" value="Envoyer le fichier" />
    </p>
</form>

