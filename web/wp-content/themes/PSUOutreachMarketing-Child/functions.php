<?php
/**
 * child theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package outreach-psu
 */

/*
*   Enqueue styles and scripts specific to this site
*/
function child_enqueue_styles() {

    // Get the parent style and the child style
    wp_enqueue_style( 'outreach-psu-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-psu-style', get_stylesheet_directory_uri() . '/style.css' );

} 
// child_enqueue_styles()
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' );
