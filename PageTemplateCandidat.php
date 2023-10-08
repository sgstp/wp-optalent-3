<?php
/**
 * Template Name: PageCandidat
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

<div id="candidats-vedettes" class="container-fluid">
	<div class="container">
		<div class="row justify-content-center">
			<?php set_query_var( 'nbEnregistrementMax', '99' ); get_template_part('parts/candidats-vedettes'); ?>
		</div>
	</div>
</div>

<?= get_footer(); ?>
