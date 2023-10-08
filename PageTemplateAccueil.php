<?php
/**
 * Template Name: PageAccueil
 */
the_post();
?>

<?= get_header(); ?>

<div id="entete" class="container-fluid">
	<div class="container"> 
		<div class="row">
			<div class="col">
				<h1>
					<?= get_the_title() ?>
				</h1>
				<h2>
					<?php the_field( 'soustitre' ); ?>
				</h2>
			</div>
		</div>
	</div>  
</div>

<div id="content" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col">
				<?= the_content() ?> 
			</div>			
		</div>
	</div>
</div>


<div id="emplois" class="container-fluid">
	<div class="row">
		<div class="col-lg-6 p-0">
			<div class="row">
				<div class="col">
					<div class="figure">
						<img src="<?= get_template_directory_uri() ?>/images/travailleur-tablette.png" class="figure-img img-fluid rounded">
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col max-row-width pl-5">
					<div class="row">
						<!-- <h3 class="figure-caption titre">TITRE</h3> -->
						<div class="col-6">
							<h4><?php the_field( 'gauchesoustitre1' ); ?></h4>
							<ul>
								<?php the_field( 'gauchetext1' ); ?>
							</ul>
						</div>
						<div class="col-6">
							<h4><?php the_field( 'gauchesoustitre2' ); ?></h4>
							<ul>
								<?php the_field( 'gauchetext2' ); ?>
							</ul>
						</div>
					</div>  
				</div>  
			</div>
		</div>
		<div class="col-lg-6 p-0">
			<div class="row">
				<div class="col">
					<div class="figure">
						<img src="<?= get_template_directory_uri() ?>/images/dame-tailleur2.jpg" class="figure-img img-fluid rounded">
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col max-row-width pl-5">
					<div class="row">
						<!-- <h3 class="figure-caption titre">TITRE</h3> -->
						<div class="col-6">
							<h4><?php the_field( 'droitsoustitre1' ); ?></h4>
							<ul>
								<?php the_field( 'droittext1' ); ?>
							</ul>
						</div>
						<div class="col-6">
							<h4><?php the_field( 'droitsoustitre2' ); ?></h4>
							<ul>
								<?php the_field( 'droittext2' ); ?>
							</ul>
						</div>
						<div class="col-6">
							<h4><?php the_field( 'droitsoustitre3' ); ?></h4>
							<ul>
								<?php the_field( 'droittext3' ); ?>
							</ul>
						</div>
						<div class="col-6">
							<h4><?php the_field( 'droitsoustitre4' ); ?></h4>
							<ul>
								<?php the_field( 'droittext4' ); ?>
							</ul>
						</div>
					</div>  
				</div>  
			</div>          
		</div>
	</div>
</div>

<!-- <div id="candidats-vedettes" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="titre"><?= __('Nos candidats vedettes', 'optalent') ?></h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<---set_query_var( 'nbEnregistrementMax', '3' ); get_template_part('parts/candidats-vedettes'); ?>
		</div>
	</div>
</div> -->

<div id="nouveaux-postes-restez-informes" class="container-fluid">
	<div class="container">
		
		<div class="row">
			<div class="col">
				<h2 class="titre"><?= __('Nouveaux postes', 'optalent') ?></h2>
			</div>
		</div>
		<div class="row justify-content-center">
			
			<?php
				$requete = new WP_Query([
					'post_type' => 'post',
					'orderby' => 'date',
					'order' => 'desc',
					'category_name' => 'poste',
					'posts_per_page' => 6
				]);
				if ($requete->have_posts()) {
					while ($requete->have_posts()) {
						$requete->the_post();
			?>
						<div class="col-md-6 col-xl-4 box-nouveau-poste">
							<!-- <img class="photo" src="<?= get_template_directory_uri() ?>/images/nouveau-poste-1.png"></img> -->
							<div class="nom"><?= the_title() ?></div>
							<!-- <div class="entreprise"><?= the_field("industrie") ?></div> -->
							<div class="description"><?= the_field("description_courte") ?></div>
							<a class="btn btn-optalent" href="<?= get_the_permalink() ?>"><?= __('Postuler', 'optalent') ?></a>
						</div>
			<?php
					}
				}
				wp_reset_query();
			?>
		</div>
		<br ><br >
		<div class="row">
			<div class="col text-center" style="margin-left: -0.9em;">
				<a class="btn btn-optalent-jaune" href="<?= get_lien('emplois-offerts') ?>"><?= __('Voir tous les emplois', 'optalent') ?></a>
			</div>
		</div>

<!-- 		<div class="row restez-informes">
			<div class="col">
				<h2 class="titre"><?= __('Restez informés', 'optalent') ?></h2>
				<h3><?= __('Abonnez-vous à nos infolettres', 'optalent') ?></h3>
			</div>
		</div>
		<div class="row restez-informes-abonnement">
			<div class="col-6 col-xl-5">
				<h4><?= __('Candidat', 'optalent') ?></h4>
				<div class="description"><?= __('Soyez les premiers à recevoir nos offres d’emplois', 'optalent') ?></div>
				<a class="btn btn-optalent btn-optalent-transparent" href="#"><?= __('M\'abonner', 'optalent') ?></a>
			</div>
			<div class="col-6 col-xl-5">
				<h4><?= __('Employeurs', 'optalent') ?></h4>
				<div class="description"><?= __('Recevez en premier les nouveaux candidats vedettes', 'optalent') ?></div>
				<a class="btn btn-optalent btn-optalent-transparent" href="#"><?= __('M\'abonner', 'optalent') ?></a>
			</div>
		</div> -->
	</div>
</div>

<!-- <div id="clients" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="titre"><?= __('Nos clients', 'optalent') ?></h2>
			</div>
		</div>      
		<div class="row pt-4 pb-5 justify-content-center">
			<div class="col">
				<img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar.png" class="figure-img img-fluid">
			</div>
			<div class="col">
				<img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar.png" class="figure-img img-fluid">
			</div>
			<div class="col">
				<img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar.png" class="figure-img img-fluid">
			</div>
			<div class="col">
				<img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar.png" class="figure-img img-fluid">
			</div>
			<div class="col">
				<img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar.png" class="figure-img img-fluid">
			</div>
		</div>
	</div>
</div> -->


<?= get_footer(); ?>
