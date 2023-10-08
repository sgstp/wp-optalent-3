<?php
/**
 * Template Name: PageNotreEquipe
*/ 
the_post();
?>


<?= get_header(); ?>


<div class="container-fluid" id="page">
	<div class="container"> 

		<div class="row">
			<div class="col text-center">
				<h1>
					<?= get_the_title() ?>
				</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<div class="description text-justify">
					<?= the_content() ?>
				</div>
			</div>
		</div>
	


		<div id="notre-equipe">			
			<div class="row">
				<div class="col">
					<div class="card-deck">
						
			<?php
				$dernierNumeroLigne = 1;
				$requete = new WP_Query([
					'post_type' => 'post',
					'orderby' => 'meta_value',
					'meta_key' => 'ordre',
					'order' => 'ASC',
					'category_name' => 'equipe'
				]);
				if ($requete->have_posts()) {
					while ($requete->have_posts()) {
						$requete->the_post();
						if ($dernierNumeroLigne != substr(get_field("ordre"),0,1)) {
			?>	
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col">
									<div class="card-deck">
			<?php
						}
			?>

						<div class="card">
							<img src="<?= get_template_directory_uri() ?>/images/equipe/<?= the_field("photo") ?>" class="card-img-top" alt="<?= the_field("titre") ?>">
							<div class="card-body">
								<span class="fa-stack info" data-toggle="modal" data-target="#modalDetailEmploye" data-nom="<?= the_title() ?>" data-description="<?= the_content() ?>">
									<i class="fas fa-circle fa-stack-2x"></i>
									<i class="fas fa-align-left fa-stack-1x" style="color:#fff;"></i>
								</span>
								<a class="courriel" href="mailto:<?= the_field("courriel") ?>"><i class="far fa-envelope"></i></a>
								<p class="nom"><?= the_title() ?></p>
								<p class="poste"><?= the_field("titre") ?></p>
								<p class="poste2"><?= the_field("sous-titre") ?></p>
							</div>
						</div>

			<?php
						$dernierNumeroLigne = substr(get_field("ordre"),0,1);
					}
				}
			?>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalDetailEmploye" tabindex="-1" aria-labelledby="modalDetailEmployeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modalDetailEmployeNom">...</span>
        <i class="far fa-times-circle fermer" data-dismiss="modal" ></i>
      </div>
      <div class="modal-body" id="modalDetailEmployeDescription">
        ...
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$("#notre-equipe .card-body .info").on("click", (e) => {
		let data = e.currentTarget.dataset;
		$('#modalDetailEmployeNom').text(data.nom);
		$('#modalDetailEmployeDescription').html(data.description);
	})
</script>

<?= get_footer(); ?>
