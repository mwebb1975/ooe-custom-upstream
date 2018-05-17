<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package outreach-psu
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
      while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/content', 'single' );
      } // while
    ?>

    </main> <!-- #main -->

    <?php get_template_part( 'template-parts/content', 'sidebar' ); ?>

	</div> <!-- #primary -->

<?php
get_footer();
