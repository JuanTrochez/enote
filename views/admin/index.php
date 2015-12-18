<div id="admin">
    <h1>Interface administrateur</h1>
    
    <ul>
        <li><a href="<?php echo $basePath ?>?page=admin&section=user">Gerer les utilisateurs</a></li>
        <?php if ($secu->isAdmin($bdd)) { ?><li><a href="<?php echo $basePath ?>?page=admin&section=statistique">Voir les stats</a></li><?php } ?>
        <li><a href="<?php echo $basePath ?>?page=admin&section=note">Gerer les notes</a></li>
    </ul>
</div>