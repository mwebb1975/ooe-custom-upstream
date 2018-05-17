<?php

/**
 * Plugin Name: OOE Slider Picker
 * Description: This plugin allows the choice of various sliders
 * Version: 2.2.1
 * Author: Matthew Webb
 */
// The base include path for the OOE Slider Picker (wp-content/plugins/ooe-slider-picker/)
define( 'OSP_BASE_PATH', plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR );

// The base url of the OOE Slider Picker (http://website.psu.edu/wp-content/plugins/ooe-slider-picker)
define( 'OSP_BASE_URL', plugins_url( '', __FILE__ ) );

// The base include path for the OOE Slider Picker (wp-content/plugins/ooe-slider-picker/includes/)
define( 'OSP_INCLUDE_PATH', OSP_BASE_PATH . 'includes' . DIRECTORY_SEPARATOR );

// The base template path for the OOE Slider Picker (wp-content/plugins/ooe-slider-picker/templates/)
define( 'OSP_TEMPLATE_PATH', OSP_BASE_PATH . 'templates' . DIRECTORY_SEPARATOR );

// Adds a new menu item under the settings tab
include_once(OSP_INCLUDE_PATH . 'settings.php');

// Adds a new "Slide Options" meta box to each post type
include_once(OSP_INCLUDE_PATH . 'slide_options.php');

/**
 * Fires upon activation (and re-activation)
 */
register_activation_hook( __FILE__, function() {

	// Specify default options for the slider
	$defaults = array(
		'osp_radio_field_0'            => 'version1',
		'osp_order_by'                 => 'rand',
		'osp_order'                    => 'ASC',
		'osp_slide_limit'              => 5,
		'osp_show_cta'                 => 1,
		'osp_v1_description_max_width' => 440
	);

	// If this plugin was once active, retain any of the old settings
	$options = get_option( 'osp_settings' );
	if ( !empty( $options ) ) {
		$options = array_replace( $defaults, $options );
	} else {
		$options = $defaults;
	}

	update_option( 'osp_settings', $options );

	// Grant the edit_slider_options capability to the proper roles
	// Note - this capability can be granted to other roles or users through the UI
	$roles = array( 'administrator', 'editor' );

	foreach ( $roles as $role_name ) {
		$role = get_role( $role_name );
		if ( !$role->has_cap( 'edit_slider_options' ) ) {
			$role->add_cap( 'edit_slider_options' );
		}
	}
} );

/**
 * Fires upon deactivation.
 */
register_deactivation_hook( __FILE__, function() {

	// Note - we keep the options set by this plugin in the wp_options table
	// In doing so, the old options are retained if/when the plugin is activated again
	// Clean up any capabilities set by the use of this plugin
	$roles = array_keys( get_editable_roles() );

	foreach ( $roles as $role_name ) {
		get_role( $role_name )->remove_cap( 'edit_slider_options' );
	}
} );

function osp_enqueue_v1_inline_styles($options) {
	$css = array();
	if( $options['osp_v1_description_max_width'] ) {
		$css[] = <<< CSS
		@media screen and (min-width:810px) {
			.slider-content .slider-description {
				max-width: {$options['osp_v1_description_max_width']}px;
			}
		}
CSS;
	}
	if( $options['osp_show_cta'] ) {

		if( $options['osp_cta_color'] ) {
			$css[] = '.home .slider-content .slider-readmore a.slider-sliderbutton { background-color: ' . esc_html( $options['osp_cta_color'] ) . '; }';
		}

		if( $options['osp_cta_hover_color'] ) {
			$css[] = '.home .slider-content .slider-readmore a.slider-sliderbutton:hover { background-color: ' . esc_html( $options['osp_cta_hover_color'] ) . '; }';
		}

		if( $options['osp_cta_text_color'] ) {
			$css[] = '.slider-readmore a.slider-sliderbutton { color: ' . esc_html($options['osp_cta_text_color']) . '; }';
			$css[] = '.slider-readmore a.slider-sliderbutton:visited { color: ' . esc_html($options['osp_cta_text_color']) . '; }';
		}
	}

	if( $css ) {
		wp_add_inline_style( 'outreach-psu-slider-style', implode( "\n", $css ) );
	}
}

function osp_enqueue_v2_inline_styles($options) {

	if( $options['osp_show_cta'] ) {
		$css = array();

		if( $options['osp_cta_color'] ) {
			$css[] = '.slides li figure figcaption a { background-color: ' . esc_html( $options['osp_cta_color'] ) . '; }';
		}

		if( $options['osp_cta_hover_color'] ) {
			$css[] = '.slides li figure figcaption a:hover { background-color: ' . esc_html( $options['osp_cta_hover_color'] ) . '; }';
		}

		if( $options['osp_cta_text_color'] ) {
			$css[] = '.slides li figure figcaption a, .slides li figure figcaption a:visited, .slides li figure figcaption a:hover { color: ' . esc_html($options['osp_cta_text_color']) . '; }';
		}

		if( $css ) {
			wp_add_inline_style( 'outreach-psu-slider-style', implode( "\n", $css ) );
		}
	}
}

/**
 * Includes the necessary asset files for the slider implementation to function properly.
 */
add_action( 'init', function() {

	// Never include frontend scripts / css on admin pages
	if ( is_admin() ) {
		return;
	}

	$options = get_option( 'osp_settings' );

	switch ( $options[ 'osp_radio_field_0' ] ) {
		case 'version2':
			wp_enqueue_style( 'outreach-psu-slider-style', OSP_BASE_URL . '/css/slider-v2.css', array( 'outreach-psu-style' ) );
			wp_enqueue_script( 'outreach-psu-slider-js', OSP_BASE_URL . '/js/slider-v2.js', array( 'jquery' ) );
			if ( wp_is_mobile() ) {
				wp_enqueue_script( 'jquery-mobile', '//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js', array( 'jquery', 'outreach-psu-slider-js' ), '1.4.5', true );
			}
			osp_enqueue_v2_inline_styles($options);
			break;
		case 'version1':
		default:
			wp_enqueue_style( 'outreach-psu-slider-style', OSP_BASE_URL . '/css/slider.css', array( 'outreach-psu-style' ) );
			wp_enqueue_script( 'outreach-psu-slider-js', OSP_BASE_URL . '/js/slider-ver1.js', array( 'jquery' ) );
			osp_enqueue_v1_inline_styles($options);
			break;
	}
} );

/**
 * Retrieves the types of posts that are eligible for being displayed in a slider
 * 
 * @return array
 */
function osp_get_post_types() {

	/**
	 * Filters the post types eligible for slider selection.
	 * 
	 * Example: How to add the slider options to Events Manager events
	 * 
	 * <code>
	 * <?php // functions.php in child theme
	 * 
	 * apply_filters('osp_post_types', function($post_types) {
	 *     $post_types[] = EM_POST_TYPE_EVENT;
	 *     return $post_types;
	 * });
	 * </code>
	 * 
	 * @param array $post_types an array of post types
	 */
	return apply_filters( 'osp_post_types', array(
		'post',
		'page'
	) );
}

/**
 * Retrieves the WP_Query object that holds the information required to build a slider
 * 
 * @return \WP_Query
 */
function osp_get_slider_query() {

	$options = get_option( 'osp_settings' );

	$args = array(
		'posts_per_page' => $options[ 'osp_slide_limit' ],
		'post_type'		 => osp_get_post_types(),
		'meta_query'	 => array(
			array(
				'key'	 => 'feature_in_slider',
				'value'	 => true
			)
		),
		'orderby'		 => $options[ 'osp_order_by' ], // rand | meta_value_num
		'order'			 => $options[ 'osp_order' ], // ASC | DESC
		'meta_key'		 => 'sort_order'
	// Note - the meta_key query variable can be added as a configurable option if required
	// The meta_value and meta_value_num 'orderby' arguments will sort by the value of the 
	// specified meta_key.  Now it's always the 'sort_order' meta field added by this plugin.
	);

	// TODO: this should be cached...
	return new WP_Query( $args );
}

/**
 * Renders the configured slider
 */
function osp_render_slider() {

	$options = get_option( 'osp_settings' );

	switch ( $options[ 'osp_radio_field_0' ] ) {
		case 'version2':
			include( OSP_TEMPLATE_PATH . 'slider-v2.php' );
			break;
		case 'version1':
		default:
			include( OSP_TEMPLATE_PATH . 'slider.php' );
	}
}
