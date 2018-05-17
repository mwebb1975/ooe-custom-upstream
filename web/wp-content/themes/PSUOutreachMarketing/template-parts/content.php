<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package outreach-psu
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title index-excerpt"><a href="%s" rel="bookmark"><span>', esc_url( get_permalink() ) ), '</span></a></h2>' ); ?>
		<div class="index-entry-meta">
			<?php outreach_psu_index_posted_on(); ?>
		</div> <!-- .index-entry-meta -->
	</header> <!-- .entry-header -->
	<div class="index-the-excerpt">
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php } // if

		the_excerpt();

	?>
	</div> <!-- .index-the-excerpt -->
	<div class="continue-reading">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php printf(
					/* Translators: %s = Name of the current post. */
					wp_kses( __( 'Read More %s', 'outreach_psu' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">about "', '"</span>', false )
				);
			?>
		</a>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			comments_popup_link( '0', '1', '%', 'comments-number' );
			comments_popup_link( esc_html__( 'Comments', 'outreach_psu' ), esc_html__( 'Comment', 'outreach_psu' ), esc_html__( 'Comments', 'outreach_psu' ), 'comments-text' );
		} ?>
	</div> <!-- .continue-reading -->

</article> <!-- #post-## -->
