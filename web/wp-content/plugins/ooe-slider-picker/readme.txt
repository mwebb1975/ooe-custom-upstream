=== OOE Slider Picker ===
Contributors: PSU Outreach Marketing

Parent theme slider picker.

== Description ==

# Fixed Width, Separate Text Slider
## Browser Support (tested on the following)
 * IE10+
 * Edge
 * Firefox
 * Chrome
 * Opera
 * Safari
 * IOS
 * IE9 - slight degradation, slide transition effects do not work
## Customization Points
 * The post thumbnail markup can be modified by a child theme
 * The post title markup can be modified by a child theme
 * The post excerpt markup can be modified by a child theme
 * The call to action markup can be modified by a child theme
 * The call to action link can be modified by a child theme
## Exposed Filters
### psu_slider_post_thumbnail
Allows the post thumbnail markup to be modified on a slide
```php
<?php // htdocs/wp-content/themes/child_theme/functions.php

function child_theme_psu_slider_post_thumbnail($thumbnail) {
    // Wrap the thumbnail in an anchor
    return '<a href="http://www.google.com">' . $thumbnail . '</a>';
}

add_filter('psu_slider_post_thumbnail', 'child_theme_psu_slider_post_thumbnail');
```
### psu_slider_post_title
Allows the post to be modified on a slide
```php
<?php // htdocs/wp-content/themes/child_theme/functions.php

function child_theme_psu_slider_post_title($post_title) {
    // Truncate the title at 80 characters and add ellipses if needed
    if ( strlen( $post_title ) > 80 ) {
		return substr( $post_title, 0, 80 ) . '&hellip;';
	}
	return $post_title;
}

add_filter('psu_slider_post_title', 'child_theme_psu_slider_post_title');
```
### psu_slider_post_excerpt
Allows the post excerpt to be modified on a slide
```php
<?php // htdocs/wp-content/themes/child_theme/functions.php

function child_theme_psu_slider_post_excerpt($post_excerpt) {
    // Truncate the excerpt at 100 characters and add ellipses if needed
    if ( strlen( $post_excerpt ) > 100 ) {
		return substr( $post_title, 0, 100 ) . '&hellip;';
	}
	return $post_excerpt;
}

add_filter('psu_slider_post_excerpt', 'child_theme_psu_slider_post_excerpt');
```
### psu_slider_call_to_action
Allows the call to action text to be modified on a slide
```php
<?php // htdocs/wp-content/themes/child_theme/functions.php

function child_theme_psu_slider_call_to_action($text) {
    return __('Sign Up', 'child_theme');
}

add_filter('psu_slider_call_to_action', 'child_theme_psu_slider_call_to_action');
```
### psu_slider_call_to_action_link
Allows the call to action "href" attribute to be modified on a slide
```php
<?php // htdocs/wp-content/themes/child_theme/functions.php

function child_theme_psu_slider_call_to_action_link($link) {
    return 'http://www.google.com';
}

add_filter('psu_slider_call_to_action_link', 'child_theme_psu_slider_call_to_action_link');
```

== Installation ==

1. Place this plugin at "/wp-content/plugins".
2. Activate the plugin through the "Plugins" menu in WordPress.
