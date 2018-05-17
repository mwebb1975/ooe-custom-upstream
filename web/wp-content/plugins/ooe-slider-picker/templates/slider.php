<?php
/**
 * The template for displaying slider posts and pages
*/
?>
	
<?php

  $pagers_query = osp_get_slider_query();
  
  if ( $pagers_query->have_posts() ) {

    $pagers = array();
    while ($pagers_query->have_posts()) {
      $pagers_query->the_post();
      $pagers[] = array(
        'id' => $pagers_query->post->ID,
        'title' => get_the_title(),
      );
    } // while
    wp_reset_postdata();
  } // if
  $heroes = osp_get_slider_query();
  $count = $heroes->post_count;
  if ( $heroes->have_posts() ) { 
	$options = get_option( 'osp_settings' );
	$show_cta	 = isset( $options[ 'osp_show_cta' ] );
	?>
    <div id="hero-container" class="inner-padding">
      <ul id="hero-list">
      <?php
      while ($heroes->have_posts()) {
        $heroes->the_post();
        $id = get_the_ID();
		$title = get_post_meta($id, 'custom_slider_title', true);
		$cta_text = get_post_meta($id, 'custom_cta_text', true);
      ?>
        <li id="hero-feature-<?php print $id ?>" node-id="<?php print $id; ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
          <div class="slider-image">
            <a href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail(); ?></a>
          </div> <!-- .slider-image -->
          <div class="hero-content-container">
            <div class="content-area">
              <div class="slider-content">
                <h3 class="slider-title">
					<?php if($show_cta): ?><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php endif; ?>
						<?php echo ($title ? $title : get_the_title()); ?>
					<?php if($show_cta): ?></a><?php endif; ?>
				</h3>
                <div class="slider-description">
                  <?php the_excerpt(); ?>
                </div> <!-- .slider-description -->
				<?php if($show_cta): ?>
                <div class="slider-readmore">
                  <a class="slider-sliderbutton" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                    <?php printf(
                      /* Translators: %s = Name of the current post. */
                      wp_kses( __( $cta_text ? $cta_text : 'Learn More %s', 'outreach_psu' ), array( 'span' => array( 'class' => array() ) ) ),
                      the_title( '<span class="screen-reader-text">about ', '</span>', false )
                      );
                    ?>
                  </a>
                </div> <!-- .slider-readmore -->
				<?php endif; ?>
              </div> <!-- .slider-content -->
            </div> <!-- .content-area -->
            <?php if ( $count > 1 ) { ?>
              <div class="slider-nav">
                <a id="hero-left" class="hero-activator prev" href="#">
                  <img src="<?php print get_template_directory_uri(); ?>/images/slider-arrow-left.png" alt="Previous Story" />
                </a> <!-- #hero-left -->
                <div id="hero-pager">
                <?php foreach($pagers as $pager) { ?>
                  <a id="hero-pager-<?php print $pager['id'] ?>" node-id="<?php print $pager['id'] ?>" href="#"><?php print $pager['title']; ?></a>
                <?php } ?>
                </div> <!-- #hero-pager-->
                <a id="hero-right" class="hero-activator next" href="#">
                  <img src="<?php print get_template_directory_uri(); ?>/images/slider-arrow-right.png" alt="Next Story" />
                </a> <!-- #hero-right -->
              </div> <!-- .slider-nav-->
            <?php } // if ?>
          </div> <!-- .hero-content-container -->
        </li> <!-- #hero-feature-<?php print $id ?> -->
        <?php
      } // while
      wp_reset_postdata(); ?>
      </ul> <!-- #hero-list -->
    </div> <!-- #hero-container -->
    <div style="clear: both;"></div>
  <?php } // if
