<?php
/**
 * Template Name: Homepage - PSU Shield
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
			<div class="col1"></div>
			<div class="col2">
				<?php
			    wp_reset_postdata();
			    the_content();
			  ?>
			</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
  $meta_title = get_post_meta($post->ID, '_outreach_page_sidebar_title', true);
  $meta_content = get_post_meta($post->ID, '_outreach_page_sidebar', true);
?>
<?php if($meta_title || $meta_content): ?>
<div class="sidebar-wysiwyg ">
  <div class="content-area">
    <?php if($meta_title): ?>
      <h2 class="widget-title"><?php echo $meta_title; ?></h2>
    <?php endif; ?>
    <?php if($meta_content): ?>
      <div class="widget-content"><?php echo apply_filters('the_content', $meta_content); ?></div>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

<?php
get_footer();
