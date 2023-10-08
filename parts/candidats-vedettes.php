<?php
	/** @var int $nbEnregistrementMax */
	$requete = new WP_Query([
		'post_type' => 'post',
		'orderby' => 'title',
		'order' => 'ASC',
		'category_name' => 'candidat',
		'posts_per_page' => $nbEnregistrementMax
	]);
	if ($requete->have_posts()) {
		while ($requete->have_posts()) {
			$requete->the_post();
?>
			<div class="col-md-6 col-xl-4 box-candidat-vedette">
				<img class="photo" src="<?= get_template_directory_uri() ?>/images/candidat.png"></img>
				<div class="nom"><?= the_title() ?></div>
				<div class="metier"><?= the_field("metier") ?></div>
				<div class="description"><?= the_content() ?></div>
				<a class="btn btn-optalent" href="#" data-toggle="modal" data-target="#modal-candidat-informations-supplementaire" data-candidat="<?= the_ID() ?>" data-recruteur="<?= the_field('recruteur') ?>"><?= __('En savoir plus', 'optalent') ?></a>
			</div>
<?php
		}
	}
	wp_reset_query();
?>

<!-- Modal -->
<div class="modal fade" id="modal-candidat-informations-supplementaire" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<img src="<?= get_template_directory_uri() ?>/images/op-icone.png">
			<div class="modal-body mt-4">
				<div class="row">
					<div class="col-4">
						<div class="align-middle">
							<p><b id="nomRecruteur"></b><br /><?= __('est le/la recruteur(e) attitré(e) à ce dossier.', 'optalent') ?></p>
							<p><?= __('Il/elle communiquera avec vous rapidement afin de vous fournir l\'information pertinente sur ce candidat ou cette candidate.', 'optalent') ?></p>
						</div>
					</div>
					<div class="col-8">
						<form>
							<input type="hidden" id="idCandidat" value="">

							<label class="sr-only" for="nom"><?= __('Votre nom', 'optalent') ?></label>
							<input type="text" class="form-control mb-4" id="nom" placeholder="<?= __('Votre nom', 'optalent') ?>">

							<label class="sr-only" for="compagnie"><?= __('Nom de la compagnie que vous représentez', 'optalent') ?></label>
							<input type="text" class="form-control mb-4" id="compagnie" placeholder="<?= __('Nom de la compagnie que vous représentez', 'optalent') ?>">
							
							<label class="sr-only" for="courriel"><?= __('Votre courriel', 'optalent') ?></label>
							<input type="text" class="form-control mb-4" id="courriel" placeholder="<?= __('Votre courriel', 'optalent') ?>">
							
							<label class="sr-only" for="telephone"><?= __('Votre numéro de téléphone', 'optalent') ?></label>
							<input type="text" class="form-control mb-4" id="telephone" placeholder="<?= __('Votre numéro de téléphone', 'optalent') ?>">
							
							<label class="sr-only" for="soumettre"><?= __('Soumettre', 'optalent') ?></label>
							<input type="submit" class="form-control mt-4 btn btn-optalent btn-optalent-bleu" id="soumettre" value="<?= __('Soumettre', 'optalent') ?>">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var idCandidat = -1;
	var nomRecruteur = "(Nom recruteur)"
	$("#modal-candidat-informations-supplementaire form").on("submit", (e) => {
		e.preventDefault();
		let donnees = {
			nom: e.target.nom.value,
			compagnie: e.target.compagnie.value,
			courriel: e.target.courriel.value,
			telephone: e.target.telephone.value,
			idCandidat: idCandidat
		}

		$.ajax({
			type: "POST", 
			url: "<?= get_template_directory_uri() ?>/mail/mail.php",
			data: donnees,
			success: () => {
				$('#modal-candidat-informations-supplementaire').modal('hide');
			}
		});
	});

	$(".box-candidat-vedette .btn-optalent").on("click", (e) => {
		idCandidat = $(e.target).attr("data-candidat");
		nomRecruteur = $(e.target).attr("data-recruteur");
		$('#nomRecruteur').text(nomRecruteur);
	})
</script>