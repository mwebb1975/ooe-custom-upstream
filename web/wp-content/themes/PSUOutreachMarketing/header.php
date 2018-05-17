<?php 
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to main content', 'outreach-psu'); ?></a>
	<div id="header_wrapper">
		<div id="utility-bar">
			<div class="psu-logo">
				<a href="http://www.psu.edu" title="Penn State">
					<div class="screen-reader-text">Go to the homepage of Penn State University</div>
					<img src="<?php echo get_template_directory_uri(); ?>/images/psu-mark.png" alt="Penn State" />
				</a>
			</div> <!-- .site-logo -->
		</div> <!-- #utility-bar -->
		<header id="masthead" class="site-header" role="banner">
			<div id="inner-header-wrapper" class="inner-padding">
        <div id="site-branding">
          <div class="site-logo">
            <?php PSUOutreachMarketing_the_custom_logo(); ?>
          </div>
        </div> <!-- #site-branding -->
				<?php if (has_nav_menu('primary')) : ?>
				<div id="mobile-wrapper">
					<div id="mobile-menu-wrapper">
						<div class="close-menu" id="mp-close-menu">X</div>
						<a href="#footer" id="mobile-menu"><div id="mobile-menu-expand">Menu</div></a>
						<article id="mob-search">
							<a href="#footer"><div id="mobile-search-expand"><img src="<?php echo get_template_directory_uri(); ?>/images/search-white.svg" alt="Search icon" /></div></a>
						</article>
					</div> <!-- #mobile-menu-wrapper -->
					<div id="off-canvas-search">
						<?php get_search_form_with_context('mobile'); ?>
					</div> <!-- #off-canvas-search -->
					<div id="off-canvas-nav">
						<div class="mp-pusher" id="mp-pusher">
							<nav id="mp-menu" class="mp-menu mp-cover" role="navigation">
								<div class="mp-level">
									<div class="utility-links-wrapper">
										<div class="utility-links-content">
										<?php if (is_active_sidebar('utility')) : ?>
											<div class="utility">
												<nav>
													<?php dynamic_sidebar('utility'); ?>
												</nav>
											</div> <!-- .utility -->
										<?php endif; ?>
										</div> <!-- .utility-links-content -->
									</div> <!-- .utility-links-wrapper -->
									<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'mp-level-1', 'menu_class' => 'nav-menu', 'walker' => new outreach_walker_nav_menu())); ?>
								</div> <!-- .mp-level -->
							</nav><!-- #mp-menu -->
						</div> <!-- .mp-pusher -->
					</div> <!-- #off-canvas-nav -->
				</div> <!-- #mobile-wrapper -->
				<?php endif; ?>
				<?php if (is_active_sidebar('utility')) : ?>
          <div class="utility">
            <nav>
              <?php dynamic_sidebar('utility'); ?>
            </nav>
          </div> <!-- .utility -->
        <?php endif; ?>
        <div id="header-search">
      	  <?php get_search_form_with_context('desktop'); ?>
        </div> <!-- #header-search -->
				<?php if (has_nav_menu('primary')) : ?>
					<div class="menu_wrapper">
						<nav id="main-menu" class="main-navigation" role="navigation">
							<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu')); ?>
						</nav><!-- #main-menu -->
					</div> <!-- .menu_wrapper -->
				<?php endif; ?>
			</div> <!-- #inner-header-wrapper -->
		</header><!-- #masthead -->
	</div> <!-- #header_wrapper -->

	<div id="page" class="hfeed site <?php echo get_theme_mod('layout_setting', 'no-sidebar'); ?>">
		<div id="content" class="site-content">
			<div class="breadcrumb-container">
				<div class="content-area">
					<?php custom_breadcrumbs('breadcrumbs-top','breadcrumbs','&rsaquo;'); ?>
				</div>
			</div>

