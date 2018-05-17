<?php
/**
 * Template Name: Homepage - Default
 * Template Post Type: page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package outreach-psu
 */

get_header();

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Is the slider plugin enabled?
if( is_plugin_active( 'ooe-slider-picker/ooe-slider-picker.php' ) ) {
	osp_render_slider();
}
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		  <header class="entry-header">
        <?php the_title( '<h1 class="screen-reader-text">', '</h1>' ); ?>
      </header>

			<?php
			  wp_reset_postdata();
			  the_content();
			?>

		</main><!-- #main -->
		<?php
		/*
		 * Include custom sidebar
		 */
		get_template_part( 'template-parts/content-sidebar', 'none' );
		?>
	</div><!-- #primary -->

<?php
get_footer();
