
<h2> Bienvenue dans votre espace personnel <?php $sessionUser->getName(); ?> </h2>
<br/>
<h3> Voici quelques informations concernant votre compte : </h3>


<div>
    Votre nom : <?php $sessionUser->getName(); ?><br/>
    Votre Login : <?php $sessionUser->getLogin(); ?><br/>
    Mot de passe :
    <input class = "btn btn-primary" type="submit" name="changementMdp"/><br/>
    Votre devise actuelle : <?php $sessionUser->getDevise(); ?>
    <input class = "btn btn-primary" type="submit" name="changementDevise"/><br/>

    
</div>

