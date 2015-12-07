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
                                $noteStatut = new Statut();
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
						<span>editer</span>
					</div>
					<div class="total">
						<?php echo $note['total']; ?> €<br/>
						+ nb frais<br/>
					</div>
					<div class="btn-show-frais">+ Afficher les frais</div>
                    <ul class="list-frais">
                        <li>
                        	<div class="infos-frais">
								<span class="img-frais">image frais</span>
								<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor dolor eu magna condimentum, ut rutrum nisi ultrices. Praesent non nisl mollis risus dignissim pulvinar. Donec sollicitudin id lorem non ultricies. Curabitur venenatis, nibh id volutpat.</span><br/>
							</div>
							<div class="actions-frais">
								<span>supprimer</span>
								<span>editer</span>
							</div>
							<div class="total">
								total frais + devise frais<br/>
								 <span>date frais</span>
							</div>
                        </li>
                        <li>
                        	<div class="infos-frais">
								<span class="img-frais">image frais</span>
								<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor dolor eu magna condimentum, ut rutrum nisi ultrices. Praesent non nisl mollis risus dignissim pulvinar. Donec sollicitudin id lorem non ultricies. Curabitur venenatis, nibh id volutpat.</span><br/>
							</div>
							<div class="actions-frais">
								<span>supprimer</span>
								<span>editer</span>
							</div>
							<div class="total">
								total frais + devise frais<br/>
								 <span>date frais</span>
							</div>
                        </li>
                        <li>
                        	<div class="infos-frais">
								<span class="img-frais">image frais</span>
								<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor dolor eu magna condimentum, ut rutrum nisi ultrices. Praesent non nisl mollis risus dignissim pulvinar. Donec sollicitudin id lorem non ultricies. Curabitur venenatis, nibh id volutpat.</span><br/>
							</div>
							<div class="actions-frais">
								<span>supprimer</span>
								<span>editer</span>
							</div>
							<div class="total">
								total frais + devise frais<br/>
								 <span>date frais</span>
							</div>
                        </li>
                    </ul>
				</li>
			<?php
				}//fin boucle liste notes
			?>
		</ul>
	</div>
</div>
