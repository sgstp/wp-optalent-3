<?php get_header(); ?>

<div class="wrapper section medium-padding" id="site-content">
										
	<div class="section-inner">
	
		<div class="content center">
												        
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php
					
					$format = get_post_format();
				
					if ( $format == 'quote' || $format == 'link' || $format == 'audio' || $format == 'status' || $format == 'chat' ) : ?>
					
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					
							<div class="featured-media">
							
								<?php 
								
								the_post_thumbnail( 'post-image' );

								$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
								
								if ( $image_caption ) : ?>
												
									<div class="media-caption-container">
									
										<p class="media-caption"><?php echo $image_caption; ?></p>
										
									</div>
									
								<?php endif; ?>
										
							</div><!-- .featured-media -->
						
						<?php endif; ?>
					
					<?php endif; ?>
				
					<div class="post-header">

						<?php if ( get_the_title() ) : ?>
						
						    <h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

						<?php endif; ?>
					    
					</div><!-- .post-header -->
					
					<?php if ( $format == 'link' ) : ?> 
					
						<div class="post-link">
						
							<?php
							
							// Fetch post content
							$content = get_post_field( 'post_content', get_the_ID() );
							
							// Get content parts
							$content_parts = get_extended( $content );
							
							echo $content_parts['main']; 
							?>
						
						</div><!-- .post-link -->
						
					<?php elseif ( $format == 'quote' ) : ?> 
					
						<div class="post-quote">
							
							<?php
							
							// Fetch post content
							$content = get_post_field( 'post_content', get_the_ID() );
							
							// Get content parts
							$content_parts = get_extended( $content );
							
							echo $content_parts['main']; 
								
							?>

						</div>
						
					<?php elseif ( $format == 'gallery' && ! post_password_required() ) : ?> 
					
						<div class="featured-media">

							<?php baskerville_flexslider( 'post-image' ); ?>
											
						</div><!-- .featured-media -->
						
					<?php elseif ( $format == 'video' && ! post_password_required() ) : ?>
					
						<?php if ( strpos( $post->post_content, '<!--more-->' ) ) : ?>
						
							<div class="featured-media">
							
								<?php
										
								// Fetch post content
								$content = get_post_field( 'post_content', get_the_ID() );
								
								// Get content parts
								$content_parts = get_extended( $content );
								
								// oEmbed part before <!--more--> tag
								$embed_code = wp_oembed_get( $content_parts['main'] ); 
								
								echo $embed_code;
								
								?>
							
							</div><!-- .featured-media -->
						
						<?php endif; ?>
				
					<?php elseif ( has_post_thumbnail() && ! post_password_required() ) : ?>
					
						<div class="featured-media">
						
							<?php 
								
							the_post_thumbnail( 'post-image' );

							$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
							
							if ( $image_caption ) : ?>
											
								<div class="media-caption-container">
								
									<p class="media-caption"><?php echo $image_caption; ?></p>
									
								</div>
								
							<?php endif; ?>
									
						</div><!-- .featured-media -->
					
					<?php endif; ?>
														                                    	    
					<div class="post-content">

                        <?php if ( ($cat = get_the_category()) && ($cat[0]->slug == 'poste' || $cat[0]->slug == 'poste-en')) : ?>
                            <a class="btn btn-optalent-jaune" href="https://optalent.zohorecruit.com/recruit/PortalForm.na?digest=PUdcCcZtRHqzIUa6RUO8znGAUnkE7bVo.a85bxdBEmQ-&iframe=true&jobid=<?= the_field('idJob') ?>" target="_blank"><?= __('Postuler maintenant', 'optalent') ?></a>
                            <table class="supplement-emploi">
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
                        <?php endif; ?>
						
						<?php 
						if ( isset( $content_parts ) && $content_parts && ( $format == 'link' || $format == 'quote' || $format == 'video' ) ) { 
							$content = $content_parts['extended'];
							$content = apply_filters( 'the_content', $content );
							echo $content;
						} else {
							the_content();
						}																																	
						wp_link_pages();
						?>
						
						<div class="clear"></div>
									        
					</div><!-- .post-content -->
												                        
				<?php endwhile; endif; ?>
		
			</div><!-- .post -->
		
		</div><!-- .content -->
		
		<div class="clear"></div>
		
	</div><!-- .section-inner -->

</div><!-- .wrapper -->
		
<?php get_footer(); ?>