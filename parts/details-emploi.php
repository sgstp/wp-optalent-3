<div id="details-emploi">

	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1><?= the_title() ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col text-white text-bold font-weight-bold">
					OPTALENT | CANADA
				</div>
			</div>
			<div class="row">
				<div class="col">
					<?= __('Publié le', 'optalent') ?> <?= get_the_date() ?>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<a class="btn btn-optalent-jaune" href="https://optalent.zohorecruit.com/recruit/PortalForm.na?digest=PUdcCcZtRHqzIUa6RUO8znGAUnkE7bVo.a85bxdBEmQ-&iframe=true&jobid=<?= the_field('idJob') ?>" target="_blank"><?= __('Postuler maintenant', 'optalent') ?></a>
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<h2><?= __('Information', 'optalent') ?></h2>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid fond-blanc">
		<div class="container">
			<div class="row">
				<div class="col">
					<table>
						<tr>
							<th><?= __('Industrie', 'optalent') ?></th>
							<td><?= the_field('industrie') ?></td>
						</tr>
						<tr>
							<th><?= __('Ville', 'optalent') ?></th>
							<td><?= the_field('ville') ?></td>
						</tr>
						<tr>
							<th><?= __('Code postal', 'optalent') ?></th>
							<td><?= the_field('code_postal') ?></td>
						</tr>
						<tr>
							<th><?= __('Province', 'optalent') ?></th>
							<td><?= the_field('province') ?></td>
						</tr>
						<tr>
							<th><?= __('Expérience requise', 'optalent') ?></th>
							<td><?= the_field('experience_requise') ?></td>
						</tr>
						<tr>
							<th><?= __('Salaire', 'optalent') ?></th>
							<td><?= the_field('salaire') ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col">
					<h2><?= __('Description', 'optalent') ?></h2>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid fond-blanc">
		<div class="container">
			<div class="row">
				<div class="col">
					<?= the_content() ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col">
					<a class="btn btn-optalent-jaune" href="<?= get_lien('emplois-offerts') ?>"><?= __('Voir tous les emplois', 'optalent') ?></a>
				</div>
			</div>
		</div>  
	</div>
</div>