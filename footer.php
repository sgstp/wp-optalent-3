		<div id="contactez-nous" class="container-fluid">
			<div class="container">
				<div class="row pt-5">
					<div class="col">
						<h2 class="titre"><?= __('Contactez-nous maintenant', 'optalent') ?></h2>
						<h3><?= __('pour une évaluation de vos besoins', 'optalent') ?></h3>
					</div>
				</div>
				<div class="row coordonnees">
					<div class="col separateur-droit">
						<h4>1 866 798-9992<br />info@optalent.ca</h4>
					</div>
					<div class="col separateur-droit">
						<h4>Montréal</h4>
						<!-- 1370 Joliot-Curie #714<br />Boucherville, Québec<br />J4B 7L9 -->
					</div>
					<div class="col separateur-droit">
						<h4>Québec</h4>
						<!-- 5262, Wilfrid-Hamel #120<br /> Québec, Québec<br />G2E 2G9 -->
					</div>
					<div class="col separateur-droit">
						<h4>Toronto</h4>
						<!-- 2275 Lakeshore Blvd. West<br />5th floor #517<br />Etobicoke, Ontario<br />M8V 3Y3 -->
					</div>
					<div class="col">
						<a class="facebook" href="https://www.facebook.com/optalent" target="_blank">
							<span class="fa-stack fa-1x">
								<i class="fas fa-square fa-stack-2x"></i>
								<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<span class="pr-2"></span>
						<a class="linkedin" href="https://www.linkedin.com/company/optalent-job/" target="_blank">
							<span class="fa-stack fa-1x">
								<i class="fas fa-square fa-stack-2x"></i>
								<i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>

<!--		<div id="pied" class="container-fluid">-->
<!--			<div class="container">-->
<!--				<div class="row">-->
<!--					<div class="col menu-footer">-->
<!--						--><?php //=
//							wp_nav_menu([
//								'theme_location' => 'bas',
//								'container' => false
//							]);
//						?>
<!--					</div>  -->
<!--				</div>-->
<!--				<br />-->
<!--				<div class="row">-->
<!--					<div class="col-6 col-lg-2">-->
<!--						© OpTalent-->
<!--					</div>-->
<!--					<div class="col-6 col-lg-10">-->
<!--						<!- Termes et conditions d’utilisation ->-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->


		<?php wp_footer(); ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156622481-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-156622481-1');
		</script>
	</body>
</html>
