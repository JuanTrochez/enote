<div class="admin-stat">
    <h1>Statistiques du site (en <?php echo Devise::getDeviseById($bdd, $sessionUser->getDevise())->getSigne(); ?>)</h1>
    
    <div class="chart">
    	<h3>Couts par categorie : </h3>
    	<canvas id="categorieChart" width="500" height="500"></canvas>
    </div>
    <div class="chart">
    	<h3>Couts des Frais par mois :</h3>
    	<canvas id="fraisChart" width="500" height="500"></canvas>
    </div>
    <div class="chart">
    	<h3>Couts des 10 premiers utilisateurs :</h3>
    	<canvas id="userChart" width="500" height="500"></canvas>
    </div>
</div>
