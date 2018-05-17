<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package outreach-psu
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main search-page" role="main">

    <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'outreach-psu' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
      </header> <!-- .page-header -->

      <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post(); ?>
        
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <?php the_title( sprintf( '<h2 class="entry-title index-excerpt"><a href="%s" rel="bookmark"><span>', esc_url( get_permalink() ) ), '</span></a></h2>' ); ?>
            </header> <!-- .entry-header -->
            <div class="index-the-excerpt">
            <?php if ( has_post_thumbnail() ) : ?>
              <figure class="featured-image">
                <?php the_post_thumbnail(); ?>
              </figure>
            <?php endif;

              the_excerpt();

            ?>
            </div> <!-- .index-the-excerpt -->
          </article> <!-- #post-## -->      

      <?php endwhile; ?>

      <nav class="pagination" role="navigation"> 
        <?php blog_numeric_posts_nav(); ?> 
      </nav>

      <?php else :
        get_template_part( 'template-parts/content', 'none' );

    endif; ?>
    
  </main> <!-- #main -->
</div> <!-- #primary -->

<?php
get_footer();
