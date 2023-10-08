<?php
/**
 * Template Name: PageEmployeur
*/ 
the_post();
?>


<?= get_header(); ?>

<div id="entete" class="container-fluid">
	<div class="container"> 
		<div class="row">
			<div class="col-md-8 col-lg-7 col-xl-5">
				<h1>
					<?= get_the_title() ?>
				</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8 col-lg-7 col-xl-5">
				<div class="description">
					<?= the_content() ?>
				</div>
			</div>
		</div>
	</div>  
</div>

<!-- <div id="encart">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-sm-11 col-md-10 col-lg-8 col-xl-6">
				<?php the_field('encart_1'); ?>
			</div>	
		</div>
	</div>
</div>

<div id="candidats-vedettes" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="titre"><?= __('Découvrez nos candidats vedettes pré-qualifiés :', 'optalent') ?></h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<--- set_query_var( 'nbEnregistrementMax', '3' ); get_template_part('parts/candidats-vedettes'); ?>
		</div>
		
		<br ><br >
		<div class="row">
			<div class="col text-center" style="margin-left: -0.9em;">
				<a class="btn btn-optalent-jaune" href="<?= get_lien('nos-candidats-vedettes') ?>"><?= __('Voir nos candidats vedettes', 'optalent') ?></a>
			</div>
		</div>

		<div class="row communiquez">
			<div class="col">
				<?= __('Communiquez avec nous pour en savoir plus sur nos candidats en vedettes : ', 'optalent') ?><span class="noTel">1 866 798-9992<span>
			</div>
		</div>
	</div>
</div> -->

<div id="encart" class="offre">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-sm-11 col-md-10 col-lg-8 col-xl-6">
				<?php the_field('encart_2'); ?>
			</div>	
		</div>
	</div>
</div>

<div id="offre" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2 class="titre"><?= __('Ce que nous offrons', 'optalent') ?></h2>
				<ul>
					<?php the_field('ce_que_nous_offrons'); ?>
				</ul>
			</div>
			<div class="col-md-6">
				<h2 class="titre"><?= __('Éléments supplémentaires', 'optalent') ?></h2>
				<ul>
					<?php the_field('elements_supplementaires'); ?>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col sous-text">
				<?php the_field('encart_3'); ?>
			</div>
		</div>
	</div>
</div>


<?= get_footer(); ?>
