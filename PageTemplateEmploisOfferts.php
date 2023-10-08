<?php
/**
 * Template Name: PageEmploisOfferts
*/ 
get_header();
the_post();

	$valDefautLieu = __('Filtrer par lieux','optalent');
	$valDefautTypeIndustrie = __('Filtrer par types d’emplois','optalent');

	$htmlTableau = '';
	$htmlTableauComble = '';
	// $typeIndustries = [];
	// $lieux = [];
	$requete = new WP_Query([
		'post_type' => 'post',
		'orderby' => 'date',
		'order' => 'desc',
		'category_name' => 'poste',
		'posts_per_page' => 999
	]);
	if ($requete->have_posts()) {
		while ($requete->have_posts()) {
			$requete->the_post();
			// $typeIndustries[] = get_field('industrie');
			// $lieux[] = get_field('ville');
			if (get_field('estcomble') == '1') {
				$htmlTableauComble .= 
				'<tr>
					<td><a href="'.get_the_permalink().'">'.get_the_title().'</a></td>
					<td class="comble">'.__('Comblé', 'optalent').'</td>
					<!-- <td>'.get_field('industrie').'</td> -->
					<td>'.get_field('ville').'</td>
					<td>'.get_field('salaire').'</td>
				</tr>';
			} else {
				$htmlTableau .= 
				'<tr>
					<td colspan=2><a href="'.get_the_permalink().'">'.get_the_title().'</a></td>
					<!-- <td>'.get_field('industrie').'</td> -->
					<td>'.get_field('ville').'</td>
					<td>'.get_field('salaire').'</td>
				</tr>';
			}
		}
	}
	// $typeIndustries = array_unique($typeIndustries);
	// $lieux = array_unique($lieux);
	// sort($typeIndustries);
	// sort($lieux);
	wp_reset_query();
?>

<div id="emplois-offerts" class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1><?= the_title() ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<?= the_content() ?>
			</div>
		</div>


<!-- 		<div class="row mt-5">
			<div class="col">
				<select id="filtreLieu" class="form-control">
					<option selected><?= $valDefautLieu ?></option>
					<?php
						foreach ($lieux as $lieu) {
							echo '<option>'.$lieu.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col">
				<select id="filtreIndustrie" class="form-control">
					<option selected><?= $valDefautTypeIndustrie ?></option>
					<?php
						foreach ($typeIndustries as $typeIndustrie) {
							echo '<option>'.$typeIndustrie.'</option>';
						}
					?>
				</select>
			</div>
		</div> -->

		<div class="row">
			<div class="col table-responsive">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col" colspan="2"><?= __('Poste', 'optalent') ?></th>
							<!-- <th scope="col"><?= __('Type d\'emploi', 'optalent') ?></th> -->
							<th scope="col"><?= __('Lieu', 'optalent') ?></th>
							<th scope="col"><?= __('Salaire', 'optalent') ?></th>
						</tr>
					</thead>
					<tbody id="liste-emploi">
						<?= $htmlTableau ?>
						<?= $htmlTableauComble ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- <script type="text/javascript">
	function filtrer(e) {
		let lieu = $('#filtreLieu').val();
		let industrie = $('#filtreIndustrie').val();

		$rangees = $('#liste-emploi').children('tr');
		$rangees.each((i,range) => {
			if (
					(($($(range).children('td')[1]).text() == industrie) || (industrie == "<?= $valDefautTypeIndustrie ?>"))
				 && (($($(range).children('td')[2]).text() == lieu) || (lieu == "<?= $valDefautLieu ?>"))
			) {
				$(range).removeClass('d-none');
			} else {
				$(range).addClass('d-none');
			}
		});
	}

	$('#filtreLieu').on('change',filtrer);
	$('#filtreIndustrie').on('change',filtrer);
</script> -->

<?= get_footer(); ?>
