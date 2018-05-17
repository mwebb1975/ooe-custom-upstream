<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package outreach-psu
 */

if ( ! function_exists( 'outreach_psu_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function outreach_psu_posted_on() {

	$author_id = get_the_author_meta( 'ID' );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'outreach_psu' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'outreach_psu' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// Display author avatar if author has a Gravatar
	if ( validate_gravatar( $author_id ) ) {
		echo '<div class="meta-content has-avatar">';
		echo '<div class="author-avatar">' . get_avatar( $author_id ) . '</div>';
	} else {
		echo '<div class="meta-content">';
	}

	echo '<span class="byline">' . $byline . ' </span><span class="posted-on">' . $posted_on . ' </span>'; // WPCS: XSS OK.
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'outreach_psu' ), esc_html__( '1 Comment', 'outreach_psu' ), esc_html__( '% Comments', 'outreach_psu' ) );
		echo '</span>';
	}
	echo '</div><!-- .meta-content -->';

}
endif;

if ( ! function_exists( 'outreach_psu_index_posted_on' ) ) :
/**
 * Prints HTML with meta information for post-date/time and author on index pages.
 */
function outreach_psu_index_posted_on() {

	$author_id = get_the_author_meta( 'ID' );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'outreach_psu' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'outreach_psu' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<div class="meta-content">';
	echo '<span class="posted-on">' . $posted_on . ' </span> &bull; Published <span class="byline">' . $byline . ' </span>'; // WPCS: XSS OK.
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'outreach_psu' ), esc_html__( '1 Comment', 'outreach_psu' ), esc_html__( '% Comments', 'outreach_psu' ) );
		echo '</span>';
	}
	echo '</div><!-- .meta-content -->';

}
endif;

if ( ! function_exists( 'outreach_psu_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function outreach_psu_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between category list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'outreach_psu' ) );
		if ( $categories_list && outreach_psu_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'outreach_psu' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between tag list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'outreach_psu' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'outreach_psu' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'outreach_psu' ), esc_html__( '1 Comment', 'outreach_psu' ), esc_html__( '% Comments', 'outreach_psu' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'outreach_psu' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function outreach_psu_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'outreach_psu_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'outreach_psu_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so outreach_psu_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so outreach_psu_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in outreach_psu_categorized_blog.
 */
function outreach_psu_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'outreach_psu_categories' );
}
add_action( 'edit_category', 'outreach_psu_category_transient_flusher' );
add_action( 'save_post',     'outreach_psu_category_transient_flusher' );

/**
 * Utility function to check if a gravatar exists for a given email or id
 * Original source: https://gist.github.com/justinph/5197810
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @return bool if the gravatar exists or not
 */

function validate_gravatar($id_or_email) {
  //id or email code borrowed from wp-includes/pluggable.php
	$email = '';
	if ( is_numeric($id_or_email) ) {
		$id = (int) $id_or_email;
		$user = get_userdata($id);
		if ( $user )
			$email = $user->user_email;
	} elseif ( is_object($id_or_email) ) {
		// No avatar for pingbacks or trackbacks
		$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
		if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
			return false;

		if ( !empty($id_or_email->user_id) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_userdata($id);
			if ( $user)
				$email = $user->user_email;
		} elseif ( !empty($id_or_email->comment_author_email) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}

	$hashkey = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hashkey . '?d=404';

	$data = wp_cache_get($hashkey);
	if (false === $data) {
		$response = wp_remote_head($uri);
		if( is_wp_error($response) ) {
			$data = 'not200';
		} else {
			$data = $response['response']['code'];
		}
	    wp_cache_set($hashkey, $data, $group = '', $expire = 60*5);

	}
	if ($data == '200'){
		return true;
	} else {
		return false;
	}
}


if ( ! function_exists( 'outreach_psu_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 * Based on paging nav function from Twenty Fourteen
 */

function outreach_psu_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( 'Previous', 'outreach_psu' ),
		'next_text' => __( 'Next', 'outreach_psu' ),
		'type'      => 'list',
	) );

	if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'outreach_psu' ); ?></h1>
				<?php echo $links; ?>
		</nav><!-- .navigation -->
		<?php
		endif;
	}
endif;

/**
 * Customize Read More link
 */

function outreach_psu_modify_read_more_link() {
	$read_more_link = sprintf(
		/* translators: %s: Name of current post. */
		wp_kses( __( 'Continue reading %s', 'outreach_psu' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( ' <span class="screen-reader-text">"', '"</span>', false )
	);
	$read_more_string =
	'<div class="continue-reading">
		<a href="' . get_permalink() . '" rel="bookmark">' . $read_more_link . '</a>
	</div>';

	return $read_more_string;
}
add_filter( 'the_content_more_link', 'outreach_psu_modify_read_more_link' );


/**
 * Customize ellipsis at end of excerpts
 */
function outreach_psu_excerpt_more( $more ) {
	return "…";
}
add_filter('excerpt_more', 'outreach_psu_excerpt_more');



if ( ! function_exists( 'outreach_psu_attachment_nav' ) ) :
/**
 * Display navigation to next/previous image in attachment pages.
 */
function outreach_psu_attachment_nav() {
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="post-nav-box clear">
			<h1 class="screen-reader-text"><?php _e( 'Attachment post navigation', 'outreach_psu' ); ?></h1>
			<div class="nav-links">
				<div class="nav-previous">
					<?php previous_image_link( false, '<span class="post-title">Previous image</span>' ); ?>
				</div>
				<div class="nav-next">
					<?php next_image_link( false, '<span class="post-title">Next image</span>' ); ?>
				</div>
			</div><!-- .nav-links -->


		</div>
	</nav>


	<?php
}
endif;

if ( ! function_exists( 'outreach_psu_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 * Appropriated from Twenty Fourteen 1.0
 */
function outreach_psu_the_attached_image() {
	$post = get_post();
	/**
	 * Filter the default attachment size.
	 */
	$attachment_size = apply_filters( 'outreach_psu_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();
	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );
	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}
		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}
	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;
if ( ! function_exists( 'outreach_psu_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function outreach_psu_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'outreach_psu' ),
		'next_text' => __( 'Next &rarr;', 'outreach_psu' ),
                'type'      => 'list',      
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'outreach_psu' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'PSUOutreachMarketing_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function PSUOutreachMarketing_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) and has_custom_logo() ) { ?>
		<div class="site-title"><?php the_custom_logo(); ?></div><?php
	}
	if ( ! has_custom_logo() and get_bloginfo('description') ) { ?>
	  <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Homepage" rel="home"><?php bloginfo( 'description' ); ?></a></div>
	<?php
	}
	if ( ! has_custom_logo() and ! get_bloginfo('description') ) { ?>
	  <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Homepage" rel="home">Add a Custom Logo or Tagline in Settings</a></div>
	<?php
	}
}
endif;