<div id="accueil">
	<h1>Mes notes de frais</h1>


	<div class="list-container">
		<ul class="list-statut">
			<li class="active">Non signées</li>
			<li>En cours</li>
			<li>Refusées</li>
			<li>Acceptées</li>
			<li>Payées</li>
		</ul>

		<ul class="list-note">
			<?php
				//boucle sur la liste des notes
				foreach ($notes as $note) {
			?>
				<li class="statut-<?php echo $note['statut_id']; ?>">
					<div class="infos-note">
						<span><?php echo $note['name']; ?></span><br/>
						<span><?php echo $note['date']; ?></span><br/>
						<span>statut note</span><br/>
					</div>
					<div class="actions-note">
						<span>supprimer</span>
						<span>editer</span>
					</div>
					<div class="total">
						<?php echo $note['total']; ?> €<br/>
						+ nb frais<br/>
						Afficher les frais
					</div>
				</li>
			<?php
				}
			?>
		</ul>
	</div>
</div>
