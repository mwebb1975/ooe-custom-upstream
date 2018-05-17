<?php
$slides = osp_get_slider_query();

if ( $slides->have_posts() ):

	$options = get_option( 'osp_settings' );

	$show_cta	 = isset( $options[ 'osp_show_cta' ] );
	$pagers		 = array();
	$first		 = true;
	?>
	<div class="slider-banner">
		<div class="slides-wrapper">
			<ul class="slides">
				<?php
				do {
					$slides->the_post();
					$id = get_the_ID();

					$title_override	 = get_post_meta( $id, 'custom_slider_title', true );
					$cta_override	 = get_post_meta( $id, 'custom_cta_text', true );

					// Apply some filters so that consumers of this slider can customize the title, excerpt, and CTA
					$thumbnail			 = apply_filters( 'psu_slider_post_thumbnail', get_the_post_thumbnail() );
					$title				 = apply_filters( 'psu_slider_post_title', $title_override ? $title_override : get_the_title() );
					$excerpt			 = apply_filters( 'psu_slider_post_excerpt', get_the_excerpt() );
					$call_to_action		 = apply_filters( 'psu_slider_call_to_action', $cta_override ? $cta_override : _x( 'Learn More', 'ooe-slider-picker' ) );
					$call_to_action_link = apply_filters( 'psu_slider_call_to_action_link', get_permalink() );
					?>
					<li class="hero-node-<?php echo $id; ?><?php if ( $first ): ?> current-hero<?php endif; ?>">
						<figure>
							<div class="image-wrapper">
								<?php echo $thumbnail; ?>
							</div>
							<figcaption>
								<div class="title"><?php echo $title; ?></div>
								<p<?php if( !$show_cta ): ?> class="no-cta"<?php endif; ?>><?php echo $excerpt; ?></p>
								<?php if ( $show_cta ): ?>
									<a href="<?php echo esc_url( $call_to_action_link ); ?>"><?php echo $call_to_action; ?></a>
								<?php endif; ?>
							</figcaption>
						</figure>
					</li>
					<?php
					$pagers[] = array(
						'id'	 => $id,
						'title'	 => $title,
						'first'	 => $first
					);

					$first = false;
				} while ( $slides->have_posts() );
				?>
			</ul>
			<?php if ( count( $pagers ) > 1 ): ?>
				<ul class="pager">
					<li class="prev">
						<a href="#" aria-label="<?php echo _x( 'Previous Slide', 'ooe-slider-picker' ) . ': ' . $pagers[ count( $pagers ) - 1 ][ 'title' ]; ?>"><i class="fa fa-chevron-left" aria-hidden=true></i></a>
					</li>
					<?php foreach ( $pagers as $page ): ?>
						<?php $ariaLabel = ($page[ 'first' ] ? _x( 'Current Slide', 'ooe-slider-picker' ) : _x( 'View Slide', 'ooe-slider-picker' )) . ": {$page[ 'title' ]}"; ?>
						<li class="page" 
							data-hero-id="<?php echo $page[ 'id' ]; ?>">
							<a href="#" aria-label="<?php echo $ariaLabel; ?>"><i class="fa fa-circle<?php if ( !$page[ 'first' ] ): ?>-o<?php endif; ?>" 
																				  aria-hidden=true></i></a>
						</li>
					<?php endforeach; ?>
					<li class="next">
						<a href="#" aria-label="<?php echo _x( 'Next Slide', 'ooe-slider-picker' ) . ": {$pagers[ 1 ][ 'title' ]}"; ?>"><i class="fa fa-chevron-right" aria-hidden=true></i></a>
					</li>
				</ul>
			<?php endif; ?>
		</div>
		<script>
	        var container = jQuery( ".slider-banner" ).last();
	        jQuery( window ).load( function ( ) {
	            psu_outreach_marketing.slider_v2( container );
	        } );
		</script>
	</div>
	<?php
	wp_reset_postdata(); 
endif;
