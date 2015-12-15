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

		<!-- <div class="table list-note">
			<div class="row">
				<div class="col">Nom</div>
				<div class="col">Date</div>
				<div class="col">Statut</div>
				<div class="col">Total</div>
				<div class="col actions">Action</div>
			</div>
		</div> -->

		<div class="list-note">
			<?php
				//boucle sur la liste des notes
				foreach ($notes as $note) {
					//initialisation des variables pour les frais de la note		
					$fraisNote->setId($note['id']);
					$allFrais = $fraisNote->getListFrais($bdd);
			?>
				<div class="statut-<?php echo $note['statut_id']; ?> note-<?php echo $note['id'] ?> note">
					<div class="infos-note">
						<div><?php echo $note['name']; ?></div>
						<div><?php echo date("d-m-Y", strtotime($note['date'])); ?></div>
						<div>
							<?php
								// recupere et affiche le nom du statut
								$noteStatut->setId($note['statut_id']);
								$stat = $noteStatut->getStatutById($bdd);
								echo $stat['name'];
							?>
						</div>
						<div>						
							<?php 
								$devise = Devise::getDeviseById($bdd, $sessionUser->getDevise());
								echo '<span class="total-note">' . Note::getMontantTotal($bdd, $note['id'], $devise->getTaux()) . '</span> ' . $devise->getSigne();
							?>
						</div>
						<div class="actions">
							<?php //if ($note['statut_id'] == 1) { ?>
								<button class="note-<?php echo $note['id'] ?> btn btn-danger">supprimer</button>
								<a class="btn btn-default" href="<?php echo $basePath. '?page=note&amp;id=' . $note['id']; ?>">editer</a>
								<button class="btn-show-frais btn btn-info" data-frais="list-frais-<?php echo $note['id'] ?>">Afficher les frais (<span class="count-frais"><?php echo count($allFrais); ?></span>)</button>
							<?php //} ?>
						</div>
					</div>

					<div class="list-frais list-frais-<?php echo $note['id'] ?>">
						<ul>
							<?php
								//boucle des frais de la note
								foreach ($allFrais as $frais) {
									$categorie = CategorieFrais::getCategorieById($bdd, $frais['categorie_id']);
							?>
								<li class="frais-<?php echo $frais['id'] ?>">
									<div class="infos-frais">
										<img class="img-frais" src="<?php echo $basePath . 'image/uploads/' . $frais['image'] ?>"/>
										<span><?php echo $frais['description'] ?></span>
									</div>
									<div class="total">
										<?php
											$fdevise = Devise::getDeviseById($bdd, $frais['devise_id']);
											echo $frais['montant'] . ' ' . $fdevise->getSigne() . '/ Convertion dans votre devise : '; 
	                                        echo '<span class="total-frais">' . Devise::getValueOfChangedDevise($frais['montant'],$fdevise->getTaux(),$devise->getTaux()) . '</span>  ' . $devise->getSigne();
										?><br/>
										<span><?php echo date("d-m-Y", strtotime($frais['date'])); ?></span><br/>
										<span class="categorie-frais"><?php echo $categorie->getName(); ?></span>
									</div>
									<?php if ($categorie->getName() != "Avance") { ?>
										<div class="actions-frais">
											<button class="frais-<?php echo $frais['id'] ?> btn btn-danger" data-note="note-<?php echo $note['id']; ?>">supprimer</button>
											<a class="btn btn-default" href="<?php echo $basePath . '?page=frais&amp;id=' . $frais['id']; ?>">editer</a>
										</div>
									<?php } ?>
								</li>
							<?php
								} //fin boucle des frais
							?>
						</ul>
					</div>
				</div>
			<?php
				}//fin boucle liste notes
			?>
		</div>
	</div>
</div>

