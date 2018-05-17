<?php
/**
 * Template part for displaying custom sidebar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package outreach-psu
 */

/** Hide mobile footer 'This Section' navigation from pages without sub-navigation
 *  Enter Post IDs in the array of Posts/Pages that should not have 'This Section' nav
 */
?>
<?php if(is_active_sidebar('sidebar-right-body')): ?>
<div id="sidebar-body">
	<?php
	if (is_category()) {
		$categories = get_the_category();
	}
	 ?>
	<?php $render_nav = $post->post_parent || count(get_pages(array('parent' => $post->ID))) || $categories[0]->cat_ID; ?>
	<?php if($render_nav): ?>
	<nav role="navigation" class="widget sidebar-menu">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'sub_menu' => true, 'direct_parent' => 25, 'menu_class' => 'body-menu', 'walker' => new outreach_walker_sub_menu ) ); ?>
	</nav> <!-- .sidebar-menu -->
	<?php endif; ?>
  <?php
		$meta_title = get_post_meta($post->ID, '_outreach_page_sidebar_title', true);
		$meta_content = get_post_meta($post->ID, '_outreach_page_sidebar', true);
	?>
	<?php if($meta_title || $meta_content): ?>
	<div class="widget sidebar-wysiwyg">
		<?php if($meta_title): ?>
		<h4 class="widget-title"><?php echo $meta_title; ?></h4>
		<?php endif; ?>
		<?php if($meta_content): ?>
		<div class="widget-content"><?php echo apply_filters('the_content', $meta_content); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php $sidebar = wp_cache_get('psu-outreach-marketing-sidebar-right-body'); ?>
	<?php if($sidebar): ?>
		<?php echo $sidebar; ?>
	<?php elseif($sidebar !== null): ?>
		<?php dynamic_sidebar( 'sidebar-right-body'); ?>
	<?php endif; ?>
</div> <!-- #sidebar-body -->
<?php endif;
