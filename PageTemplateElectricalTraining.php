<?php
/**
 * Template Name: PageElectricalTraining
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
					<?= the_field('sous-titre') ?>
				</div>
			</div>
		</div>
	</div>  
</div>

<div id="page" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col">
				<?= the_content() ?>
			</div>
		</div>
	</div>
</div>

<?= get_footer(); ?>
