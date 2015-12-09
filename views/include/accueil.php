<div id="accueil">
	<h1>Mes notes de frais</h1>


	<div class="list-container">
		<ul class="list-statut">
                    <?php foreach ($listStatut as $statut) { ?>
                        <li class="statut-<?php echo $statut['id']; if ($statut['id'] == 1) {echo " active";} ?>"><?php echo $statut['name']; ?></li>
                    <?php } ?>
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
                        <span>
                            <?php
                                $noteStatut->setId($note['statut_id']);
                                $stat = $noteStatut->getStatutById($bdd);
                                echo $stat['name'];
                            ?>
                        </span><br/>
					</div>
					<div class="actions-note">
						<span>supprimer</span>
						<a href="<?php echo $basePath. '?page=note&amp;id=' . $note['id']; ?>">editer</a>
					</div>
					<div class="total">
						<?php echo $note['total']; ?> €<br/>
						+ nb frais<br/>
					</div>
					<div class="btn-show-frais">+ Afficher les frais</div>
                    <ul class="list-frais">
                    	<?php
                    		$fraisNote->setId($note['id']);
                    		$allFrais = $fraisNote->getListFrais($bdd);

                    		//boucle des frais de la note
                    		foreach ($allFrais as $frais) {                    			
                    	?>
                    		<li>
	                        	<div class="infos-frais">
									<img class="img-frais" src="<?php echo $basePath . 'image/uploads/' .$frais ['image'] ?>"/>
									<span><?php echo $frais ['description'] ?></span><br/>
								</div>
								<div class="actions-frais">
									<span>supprimer</span>
									<span>editer</span>
								</div>
								<div class="total">
									<?php echo $frais['montant'] . ' ' . $frais['devise_id'] ?><br/>
									<span><?php echo $frais ['date'] ?></span>
								</div>
	                        </li>

                    	<?php
                    		} //fin boucle des frais
                    	?>
                    </ul>
				</li>
			<?php
				}//fin boucle liste notes
			?>
		</ul>
	</div>
</div>
