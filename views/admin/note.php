<div class="admin-note list-all-note">
	<h1>Toutes les notes de frais</h1>


	<div class="list-container">
		<ul class="list-statut">
			<?php                     		
                            //pour la classe active
                            $i = 0;
                            foreach ($listStatut as $statut) { 
                                if ($statut['id'] == 1) {continue;};                            
                        ?>
				<li class="statut-<?php echo $statut['id']; if ($i == 0) {echo " active";} ?>"><?php echo $statut['name']; ?></li>
                        <?php 
                                $i = 1;
                            } 
                        ?>
		</ul>

		<ul class="list-note">
			<?php
				//boucle sur la liste des notes
				foreach ($notes as $note) {
                                    if ($note['statut_id'] == 1) { continue; }
					//initialisation des variables pour les frais de la note		
					$fraisNote->setId($note['id']);
					$allFrais = $fraisNote->getListFrais($bdd);
			?>
				<li class="statut-<?php echo $note['statut_id']; ?> note-<?php echo $note['id'] ?> note">
					<div class="infos-note">
						<span><?php echo $note['name']; ?></span><br/>
						<span><?php echo date("d-m-Y", strtotime($note['date'])); ?></span><br/>
						<span>
							<?php
								// recupere et affiche le nom du statut
								$noteStatut->setId($note['statut_id']);
								$stat = $noteStatut->getStatutById($bdd);
								echo $stat['name'];
							?>
						</span><br/>
					</div>
					<div class="actions-note">
						<button class="note-<?php echo $note['id'] ?> btn btn-danger">supprimer</button>
						<a href="<?php echo $basePath. '?page=note&amp;id=' . $note['id']; ?>">editer</a>
					</div>
					<div class="total">
						<?php 
							$devise = Devise::getDeviseById($bdd, $sessionUser->getDevise());
							echo Note::getMontantTotal($bdd, $note['id'], $devise->getTaux()) . ' ' . $devise->getSigne();
						?>
					</div>
					<div class="btn-show-frais btn btn-info">+ Afficher les frais (<?php echo count($allFrais); ?>)</div>
					<ul class="list-frais">
						<?php
							//boucle des frais de la note
							foreach ($allFrais as $frais) {       
							echo $frais['id'];    			
						?>
							<li class="frais-<?php echo $frais['id'] ?>">
								<div class="infos-frais">
									<img class="img-frais" src="<?php echo $basePath . 'image/uploads/' .$frais ['image'] ?>"/>
									<span><?php echo $frais['description'] ?></span><br/>
								</div>
								<div class="actions-frais">
									<button class="frais-<?php echo $frais['id'] ?> btn btn-danger">supprimer</button>
									<a href="<?php echo $basePath . '?page=frais&amp;id=' . $frais['id']; ?>">editer</a>
								</div>
								<div class="total">
									<?php
										$fdevise = Devise::getDeviseById($bdd, $frais['devise_id']);
										echo $frais['montant'] . ' ' . $fdevise->getSigne() . '/ Convertion dans votre devise : '; 
                                                                                echo Devise::getValueOfChangedDevise($frais['montant'],$fdevise->getTaux(),$devise->getTaux()) . '  ' . $devise->getSigne();
									?><br/>
									<span><?php echo date("d-m-Y", strtotime($frais['date'])); ?></span>
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
