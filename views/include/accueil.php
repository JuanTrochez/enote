<div id="accueil" class="list-all-note">
	<h1>Mes notes de frais</h1>


	<div class="list-container">
		<ul class="list-statut">
			<?php				
				//pour la classe active
				$i = 0;
				foreach ($listStatut as $statut) { 
			?>
				<li class="statut-<?php echo $statut['id']; if ($i == 0) {echo " active";} ?>"><?php echo $statut['name']; ?></li>
			<?php 
					$i = 1;
				} 
			?>
		</ul>

		<table class="list-note">
			<tr>
				<th>Nom</th>
				<th>Date</th>
				<th>Statut</th>
				<th>Total</th>
				<th class="actions">Actions</th>
			</tr>
			<?php
				//boucle sur la liste des notes
				foreach ($notes as $note) {
					//initialisation des variables pour les frais de la note		
					$fraisNote->setId($note['id']);
					$allFrais = $fraisNote->getListFrais($bdd);
			?>
					<tr></tr>
					<tr class="statut-<?php echo $note['statut_id']; ?> note-<?php echo $note['id'] ?> note">
						<td><?php echo $note['name']; ?></td>
						<td><?php echo date("d-m-Y", strtotime($note['date'])); ?></td>
						<td>
							<?php
								// recupere et affiche le nom du statut
								$noteStatut->setId($note['statut_id']);
								$stat = $noteStatut->getStatutById($bdd);
								echo $stat['name'];
							?>
						</td>
						<td>
							<?php 
								$devise = Devise::getDeviseById($bdd, $sessionUser->getDevise());
								echo '<span class="total-note">' . Note::getMontantTotal($bdd, $note['id'], 1) . '</span> ' . $devise->getSigne();
							?>
						</td>
						<td>
							<?php //if ($note['statut_id'] == 1) { ?>
							<button class="note-<?php echo $note['id'] ?> btn btn-danger">supprimer</button>
							<a class="btn btn-default" href="<?php echo $basePath. '?page=note&amp;id=' . $note['id']; ?>">editer</a>
							<div class="btn-show-frais btn btn-info" data-frais="list-frais-<?php echo $note['id'] ?>">Afficher les frais (<span class="count-frais"><?php echo count($allFrais); ?></span>)</div>
							<?php //} ?>						
						</td>
					</tr>

					<tr class="list-frais list-frais-<?php echo $note['id'] ?>">
						<td colspan="5">
							<ul>
								<?php
									//boucle des frais de la note
									foreach ($allFrais as $frais) {
								?>
									<li class="frais-<?php echo $frais['id'] ?>">
										<div class="infos-frais">
											<img class="img-frais" src="<?php echo $basePath . 'image/uploads/' .$frais ['image'] ?>"/>
											<span><?php echo $frais['description'] ?></span>
										</div>
										<div class="total">
											<?php
												$fdevise = Devise::getDeviseById($bdd, $frais['devise_id']);
												echo '<span class="total-frais">' . $frais['montant'] . '</span> ' . $fdevise->getSigne(); 
											?><br/>
											<span><?php echo date("d-m-Y", strtotime($frais['date'])); ?></span>
										</div>
										<div class="actions-frais">
											<button class="frais-<?php echo $frais['id'] ?> btn btn-danger" data-note="note-<?php echo $note['id']; ?>">supprimer</button>
											<a class="btn btn-default" href="<?php echo $basePath . '?page=frais&amp;id=' . $frais['id']; ?>">editer</a>
										</div>
									</li>
								<?php
									} //fin boucle des frais
								?>
							</ul>
						</td>
					</tr>
			<?php
				}//fin boucle liste notes
			?>
		</table>
	</div>
</div>

