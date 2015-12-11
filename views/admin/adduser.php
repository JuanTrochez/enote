<?php
echo 'COUCOU';
?>
<div>
    <form class = "form" action="" method="POST" enctype="multipart/form-data">
        <input class="form-control champ-form" name="name_user" type="text" placeholder="Nom">
        <input class="form-control champ-form" name="name_user" type="text" placeholder="Login">
        <input class="form-control champ-form" name="name_user" type="password" placeholder="Password">
        <select class = "formulaire formulairePrix form-control champ-form" name="devise_id">
            <?php
            $reponseDevise = Devise::getAllDevise($bdd);
            while($donnee = $reponseDevise->fetch())
            { ?>
                <option value="<?php echo $donnee['id'];?>" <?php if($sessionUser->getDevise() == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
      <?php } ?>
        </select>

        
   
    </form>
    <br/>    
    <input class = "btn btn-primary" type="submit" name="adduser" value="Ajouter l'utilisateur"/>
    
</div>