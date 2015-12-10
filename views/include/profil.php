<?php include_once 'class/Devise.php';?>

<h2> Bienvenue dans votre espace personnel <?php echo $sessionUser->getName(); ?> </h2>
<br/>
<h3> <strong>Voici quelques informations concernant votre compte : </strong></h3><br/>


<div>
    <strong>Votre nom</strong> : <?php echo $sessionUser->getName(); ?><br/>
    <strong>Votre Login</strong> : <?php echo $sessionUser->getLogin(); ?><br/>
    <?php 
    $Devise = new Devise();
    $Devise = Devise::getDeviseById($bdd,$sessionUser->getDevise());
    ?>
    <strong>Votre devise actuelle</strong> : <?php echo $Devise->getName() ;?>
</div>

<div>
    <h2> Modification des informations personnelle</h2><br/>
    <h4> <strong>Modification mot de passe </strong></h4><br/>
</div>

<form  class = "form" action="" method="POST" enctype="multipart/form-data">
    Ancien mot de passe :  <input class = "form-control champ-form" type="password" name="ancienMdp"/><br/>
    Nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="nouveauMdp"/> <br/>
    Confirmer le nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="confirmationMdp"/><br/>
    Nouvelle devise :
    <select class = "formulaire formulairePrix form-control champ-form" name="devise_id">
                <?php
                $reponseDevise = $bdd->query('SELECT * FROM devise');
                while($donnee = $reponseDevise->fetch())
                {
                    ?>
                    <option value="<?php echo $donnee['id'];?>" <?php if(isset($_POST['devise_id']) && !empty($_POST['devise_id']) && $_POST['devise_id'] == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                    <?php  
                }
                $reponseDevise->closeCursor();
                ?>
            </select>
    <br/>
    <input class = "btn btn-primary" type="submit" name="changementDevise" value="Modifier"/><br/>
</form>
