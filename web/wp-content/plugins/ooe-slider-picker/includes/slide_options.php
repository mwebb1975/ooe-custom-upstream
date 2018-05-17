<?php

// Adds a custom meta-box to the current post if the user has the proper capability
add_action( 'add_meta_boxes', function($post_type) {
		
	if ( in_array($post_type, osp_get_post_types()) && current_user_can( 'edit_slider_options' ) ) {
		add_meta_box( 'slider_options', __( 'Slider Options', 'osp' ), 'osp_render_slide_options_metabox', $post_type, 'side' );
	}
} );

/**
 * Renders the custom meta-box.
 * 
 * @param WP_Post $post the current post that is being edited
 */
function osp_render_slide_options_metabox( $post ) {
	
	wp_nonce_field( -1, 'osp_slider_options_nonce' );
	?>
	<ul>
		<li class="slider-option">
			<label for="feature_in_slider">
				<input type="checkbox" 
					   id="feature_in_slider" 
					   name="feature_in_slider"
					   <?php echo checked( (bool) get_post_meta( $post->ID, 'feature_in_slider', true ) ); ?> />
					   <?php echo __( 'Add to Homepage Slider', 'osp' ); ?>
			</label>
		</li>
		<li class="slider-option dependent-slider-option post-attributes-label-wrapper">
			<label class="post-attributes-label" 
				   for="custom_slider_title"><?php echo __( 'Custom Slider Title', 'osp' ); ?></label>
			<input type="text" 
				   id="custom_slider_title" 
				   name="custom_slider_title" 
				   value="<?php echo esc_attr( get_post_meta( $post->ID, 'custom_slider_title', true ) ); ?>" />
		</li>
		<li class="slider-option dependent-slider-option post-attributes-label-wrapper">
			<label class="post-attributes-label" 
				   for="custom_cta_text"><?php echo __( 'Custom Call To Action Text', 'osp' ); ?></label>
			<input type="text" 
				   id="custom_cta_text" 
				   name="custom_cta_text" 
				   value="<?php echo esc_attr( get_post_meta( $post->ID, 'custom_cta_text', true ) ); ?>" />
		</li>
		<li class="slider-option dependent-slider-option">
			<label for="hide_featured_image">
				<input type="checkbox" 
					   id="hide_featured_image" 
					   name="hide_featured_image"
					   <?php echo checked( (bool) get_post_meta( $post->ID, 'hide_featured_image', true ) ); ?> />
					   <?php echo __( 'Hide Featured Image in Post', 'osp' ); ?>
			</label>
		</li>
		<li class="slider-option dependent-slider-option post-attributes-label-wrapper">
			<label class="post-attributes-label" 
				   for="sort_order"><?php echo __( 'Sort Order', 'osp' ); ?></label>
			<input type="number" 
				   id="sort_order" 
				   name="sort_order" 
				   min="0" 
				   max="<?php echo PHP_INT_MAX; ?>" 
				   value="<?php echo get_post_meta( $post->ID, 'sort_order', true ); ?>" />
		</li>
	</ul>
	<?php
}

// Saves the meta-box fields to the provided posts
add_action( 'save_post', function($post_id) {
	$nonce = filter_input( INPUT_POST, 'osp_slider_options_nonce' );

	if ( !$nonce || !wp_verify_nonce( $nonce ) ) {
		return $post_id;
	}

	if ( defined( DOING_AUTOSAVE ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( !current_user_can( 'edit_slider_options' ) ) {
		return $post_id;
	}

	$feature_in_slider = filter_input( INPUT_POST, 'feature_in_slider', FILTER_VALIDATE_BOOLEAN );

	update_post_meta( $post_id, 'feature_in_slider', $feature_in_slider );
	if ( $feature_in_slider ) {

		update_post_meta( $post_id, 'custom_slider_title', filter_input( INPUT_POST, 'custom_slider_title', FILTER_UNSAFE_RAW ) );
		update_post_meta( $post_id, 'custom_cta_text', filter_input( INPUT_POST, 'custom_cta_text', FILTER_UNSAFE_RAW ) );
		update_post_meta( $post_id, 'hide_featured_image', filter_input( INPUT_POST, 'hide_featured_image', FILTER_VALIDATE_BOOLEAN ) );

		$sort_order = filter_input( INPUT_POST, 'sort_order', FILTER_VALIDATE_INT, array(
			'options' => array(
				'min_range'	 => 0,
				'max_range'	 => PHP_INT_MAX
			)
		) );

		// Invalid or missing input safely casts to 0
		update_post_meta( $post_id, 'sort_order', (int) $sort_order );
	} else {
		// If removing this post from the slider, no longer hide the featured image
		update_post_meta( $post_id, 'hide_featured_image', false );
	}
} );
