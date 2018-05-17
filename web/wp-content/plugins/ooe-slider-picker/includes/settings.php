<?php
add_action( 'admin_menu', 'osp_add_admin_menu' );
add_action( 'admin_init', 'osp_settings_init' );

function osp_add_admin_menu() {
	add_options_page( 'OOE Slider Picker', 'OOE Slider Picker', 'manage_options', 'ooe-slider-picker', 'osp_options_page' );
}

function osp_settings_init() {

	wp_enqueue_script( 'outreach-psu-slider-options', OSP_BASE_URL . '/js/admin/slider_options.js', array( 'jquery' ) );

	register_setting( 'pluginPage', 'osp_settings' );

	add_settings_section(
	'osp_pluginPage_section', __( 'OOE Slider Version', 'wordpress' ), 'osp_settings_section_callback', 'pluginPage'
	);

	add_settings_field(
	'osp_version1', __( 'Full Width Slider', 'wordpress' ), 'osp_radio_field_0_render', 'pluginPage', 'osp_pluginPage_section'
	);

	add_settings_field(
	'osp_version2', __( 'Fixed Width, Separate Text Slider', 'wordpress' ), 'osp_radio_field_1_render', 'pluginPage', 'osp_pluginPage_section'
	);

	add_settings_section(
	'osp_options_section', __( 'Content Options', 'osp' ), 'osp_add_content_options_section', 'pluginPage'
	);
}

function osp_radio_field_0_render() {

	$options = get_option( 'osp_settings' );
	?>
	<input type='radio' name='osp_settings[osp_radio_field_0]' <?php checked( $options[ 'osp_radio_field_0' ], 'version1' ); ?> value='version1'>
	<?php
}

function osp_radio_field_1_render() {

	$options = get_option( 'osp_settings' );
	?>
	<input type='radio' name='osp_settings[osp_radio_field_0]' <?php checked( $options[ 'osp_radio_field_0' ], 'version2' ); ?> value='version2'>
	<?php
}

function osp_settings_section_callback() {

	echo __( 'Pick the slider version you wish to us on your homepage.', 'wordpress' );
}

function osp_options_page() {
	?>
	<form action='options.php' method='post'>

		<h2>OOE Slider Picker</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php
}

/**
 * Adds a section to the settings form for settings that apply to any selected slider
 */
function osp_add_content_options_section() {
	echo __( 'The settings within this section apply to either of the selected sliders.', 'osp' );
	
	$fields = array(
		'osp_slide_limit'              => array(
			'label'    => __( 'Max Items in Slider', 'osp' ),
			'renderer' => 'osp_add_slide_limit_field'
		),
		'osp_v1_description_max_width' => array(
			'label'    =>  __( 'Description Max Width', 'osp' ),
			'renderer' => 'osp_add_v1_description_max_width'
		),
		'osp_show_cta'                 => array(
			'label'    => __( 'Show Call To Action Button', 'osp' ),
			'renderer' => 'osp_add_show_cta_field'
		),
		'osp_cta_color'                => array(
			'label'    => __( 'CTA Button Color', 'osp' ),
			'renderer' => 'osp_add_cta_color_field'
		),
		'osp_cta_hover_color'          => array(
			'label'    => __( 'CTA Button Hover Color', 'osp' ),
			'renderer' => 'osp_add_cta_hover_color_field'
		),
		'osp_cta_text_color'           => array(
			'label'    => __( 'CTA Text Color', 'osp' ),
			'renderer' => 'osp_add_cta_text_color_field'
		),
		'osp_order_by'                 => array(
			'label'    => __( 'Slide Order', 'osp' ),
			'renderer' => 'osp_add_slide_order_by_field'
		),
		'osp_order'                    => array(
			'label'    => __( 'Sort Direction', 'osp' ),
			'renderer' => 'osp_add_slide_order_field'
		),
	);

	foreach( $fields as $field => $attributes ) {
		add_settings_field( $field, $attributes['label'], $attributes['renderer'], 'pluginPage', 'osp_options_section' );
	}
}

/**
 * Renders the slide limit input
 */
function osp_add_slide_limit_field() {
	
	$options = get_option( 'osp_settings' );
	?>
	<input id="osp_slide_limit" 
		   name="osp_settings[osp_slide_limit]" 
		   type="number" 
		   min="1" 
		   max="5" 
		   value="<?php echo (int) $options[ 'osp_slide_limit' ]; ?>" 
		   required />
	<?php
}

function osp_add_v1_description_max_width() {

	$options = get_option( 'osp_settings' );
	?>
	<div class="dependent-slider-v1">
		<input id="osp_v1_description_max_width"
			   name="osp_settings[osp_v1_description_max_width]"
			   type="number"
			   min="200"
			   max="1200"
			   value="<?php echo (int) $options[ 'osp_v1_description_max_width' ]; ?>"
			   required />
	</div>
	<?php
}

/**
 * Renders the show call to action input
 */
function osp_add_show_cta_field() {
	
	$options = get_option( 'osp_settings' );
	?>
	<input name="osp_settings[osp_show_cta]" 
		   value="1" 
		   type="checkbox"<?php echo checked($options['osp_show_cta']); ?> />
		   
		
	<?php
}

/**
 * Renders the call to action color override input
 */
function osp_add_cta_color_field() {

	$options = get_option( 'osp_settings' );
	?>
	<div class="dependent-show-cta">
		<input name="osp_settings[osp_cta_color]"
		       type="text"
		       pattern="#[a-fA-F0-9]{6}"
		       placeholder="#000000"
		       value="<?php echo isset( $options['osp_cta_color'] ) ? $options['osp_cta_color'] : ''; ?>"/>
		<p class="description"><?php echo __( 'If left blank, the default CTA color will be used.', 'osp' ); ?></p>
		<p class="description"><?php echo __( 'Please note that the default color may change between slider implementations.', 'osp' ); ?></p>
	</div>

	<?php
}

/**
 * Renders the call to action hover color override input
 */
function osp_add_cta_hover_color_field() {

	$options = get_option( 'osp_settings' );
	?>
	<div class="dependent-show-cta">
		<input name="osp_settings[osp_cta_hover_color]"
		       type="text"
		       pattern="#[a-fA-F0-9]{6}"
		       placeholder="#000000"
		       value="<?php echo isset( $options['osp_cta_hover_color'] ) ? $options['osp_cta_hover_color'] : ''; ?>"/>
		<p class="description"><?php echo __( 'If left blank, the default CTA hover color will be used.', 'osp' ); ?></p>
		<p class="description"><?php echo __( 'Please note that the default color may change between slider implementations.', 'osp' ); ?></p>
	</div>

	<?php
}

/**
 * Renders the call to action text color override input
 */
function osp_add_cta_text_color_field() {

	$options = get_option( 'osp_settings' );
	?>
	<div class="dependent-show-cta">
		<input name="osp_settings[osp_cta_text_color]"
		       type="text"
		       pattern="#[a-fA-F0-9]{6}"
		       placeholder="#000000"
		       value="<?php echo isset( $options['osp_cta_text_color'] ) ? $options['osp_cta_text_color'] : ''; ?>"/>
		<p class="description"><?php echo __( 'If left blank, the default CTA text color will be used.', 'osp' ); ?></p>
		<p class="description"><?php echo __( 'Please note that the default color may change between slider implementations.', 'osp' ); ?></p>
	</div>

	<?php
}

/**
 * Renders the slide sort order radio group
 */
function osp_add_slide_order_by_field() {
	
	$options = get_option( 'osp_settings' );

	/**
	 * Filters the available orders that slides can be sorted by
	 * 
	 * @param array $orders an associative array of sort orders consisting of a user-friendly name as a key with the machine name as a value
	 */
	$orders = apply_filters(
	'osp_slide_order', array(
		'Random' => 'rand',
		'Manual' => 'meta_value_num'
		// Note - there are numerous other ordering mechanisms, some may require additional effort to fully utilize.
		// See https://codex.wordpress.org/Class_Reference/WP_Query
		//
		// To add more, follow the 'User Friendly Name' => 'machine_name' pattern above.
	) );

	foreach ( $orders as $label => $value ):
		?>
		<label for="osp_slide_order_by_<?php echo $value; ?>">
			<input id="osp_slide_order_by_<?php echo $value; ?>" 
				   type="radio" name="osp_settings[osp_order_by]" 
				   value="<?php echo $value; ?>"<?php echo checked( $options[ 'osp_order_by' ], $value ); ?> />
				   <?php echo __( $label, 'osp' ); ?>
		</label><br />
	<?php endforeach; ?>

	<?php
}

function osp_add_slide_order_field() {
	$options = get_option( 'osp_settings' );

	$directions = array( 'Ascending' => 'ASC', 'Descending' => 'DESC' );
	?>
	<div class="dependent-order-by">
		<?php foreach ( $directions as $label => $value ):
			?>
			<label for="osp_slide_order_<?php echo $value; ?>">
				<input id="osp_slide_order_<?php echo $value; ?>" 
					   type="radio" 
					   name="osp_settings[osp_order]" 
					   value="<?php echo $value; ?>"<?php echo checked( $options[ 'osp_order' ], $value ); ?> />
					   <?php echo __( $label, 'osp' ); ?>
			</label><br />
		<?php endforeach; ?>
		<p class="description dependent-meta-value-num"><?php echo __( 'This setting uses the <strong>order</strong> attribute in the slider options form.', 'osp' ); ?></p>
	</div>
	<?php
}
