<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package outreach-psu
 */
get_header(); ?>
<?php global $first_post; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="index-entry-meta">
			<?php outreach_psu_index_posted_on(); ?>
		</div> <!-- .index-entry-meta -->
	</header> <!-- .entry-header -->
	<div class="entry-content">
    <?php
      if ( has_post_thumbnail()  and !get_post_meta( $post->ID, 'hide_featured_image', true )) { ?>
        <figure class="featured-image">
          <?php if ( $first_post == true ) { ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
              <?php the_post_thumbnail(); ?>
            </a>
          <?php } else {
            the_post_thumbnail();
          }
          ?>
        </figure> <!-- .featured-image -->
      <?php }
    ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'outreach_psu' ),
				'after'  => '</div>',
			) );
		?>
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) { ?>
				<div class="continue-reading-gray-single">
							<?php if ( ! post_password_required() ) {
							echo '<span class="comments-link-gray">';
							comments_popup_link( '0', '1', '%', 'comments-number' );
							comments_popup_link( esc_html__( 'Comments', 'outreach_psu' ), esc_html__( 'Comment', 'outreach_psu' ), esc_html__( 'Comments', 'outreach_psu' ), 'comments-text' );
							echo '</span>';
						}?>
				</div> <!-- .continue-reading-gray-single -->
				<?php
				comments_template();
			}
		?>
	</div> <!-- .entry-content -->
</article> <!-- #post-## -->

