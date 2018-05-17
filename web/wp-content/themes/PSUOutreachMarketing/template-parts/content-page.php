<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package outreach-psu
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header> <!-- .entry-header -->

	<div class="entry-content">
    <?php
      // Check if featured image exists, and custom field 'Hide Featured Image' does NOT exist 
      if ( has_post_thumbnail() and !(get_post_meta( $post->ID, 'hide_featured_image', true ))  ) : ?>
        <figure class="featured-image">
          <?php the_post_thumbnail(); ?>
        </figure> <!-- .featured-image -->
      <?php endif;
    ?>
    
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'outreach-psu' ),
				'after'  => '</div>',
			) );
		?>
	</div> <!-- .entry-content -->
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	?>
</article><!-- #post-## -->
