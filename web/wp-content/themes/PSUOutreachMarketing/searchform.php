<?php
	$key = 'psu_search_form_context';
	$context = isset($GLOBALS[$key]) ? $GLOBALS[$key] : '';
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label for="search-field<?php if($context): ?>-<?php echo $context; ?><?php endif; ?>">
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    </label>
    <input id="search-field<?php if($context): ?>-<?php echo $context; ?><?php endif; ?>" type="search" class="search-field"
        placeholder="<?php echo esc_attr_x( 'Search this site', 'placeholder' ) ?>"
        value="<?php echo get_search_query() ?>" name="s"
        title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <button type="submit" class="responsive-submit" title="Search" aria-label="Search Button"></button>
</form> <!-- .search-form -->
