<?php
/**
 * outreach-psu functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package outreach-psu
 */

require_once('widgets/recent_posts/widget-posts-recent.php');

require_once('widgets/contact_info/contact-info.php');

if ( ! function_exists( 'outreach_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function outreach_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on outreach-psu, use a find and replace
     * to change 'outreach-psu' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'outreach-psu', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'outreach-psu' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ) );

    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

}
endif;
add_action( 'after_setup_theme', 'outreach_setup' );

/*
*   Enqueue styles and scripts specific to this site
*/
function outreach_enqueue_styles() {
    // Custom fonts
    wp_enqueue_style( 'wpb-google-fonts-roboto', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700', false );
    wp_enqueue_style( 'wpb-google-fonts-opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700', false );
  } // outreach_enqueue_styles()
  add_action( 'wp_enqueue_scripts', 'outreach_enqueue_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function outreach_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'outreach_content_width', 640 );
}
add_action( 'after_setup_theme', 'outreach_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function outreach_widgets_init() {
    register_sidebar( array(
      'name'          => esc_html__( 'Body Sidebar', 'outreach-psu' ),
      'id'            => 'sidebar-right-body',
      'description'   => '',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
      'name'          => esc_html__( 'Calls to Action', 'outreach-psu' ),
      'id'            => 'utility',
      'description'   => '',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
      'name'          => esc_html__( 'Footer Contact Information', 'outreach-psu' ),
      'id'            => 'footer-contact-info',
      'description'   => '',
      'before_widget' => '<div id="footer-contact-info" class="%2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>'
    ) );
    register_sidebar( array(
      'name'          => esc_html__( 'Footer Nav Column 1', 'outreach-psu' ),
      'id'            => 'footer-nav-col-1',
      'description'   => '',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
      'name'          => esc_html__( 'Footer Nav Column 2', 'outreach-psu' ),
      'id'            => 'footer-nav-col-2',
      'description'   => '',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    ) );
      register_sidebar( array(
      'name'          => esc_html__( 'Footer Nav Column 3', 'outreach-psu' ),
      'id'            => 'footer-nav-col-3',
      'description'   => '',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'outreach_widgets_init' );

// add tag support to pages
function tags_support_all() {
    register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
    if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');

/**
 * Enqueue scripts and styles.
 */
function outreach_scripts() {
    // Footables
    wp_enqueue_style( 'outreach-footables-css', get_template_directory_uri() . '/css/footable.standalone.min.css' );
    wp_enqueue_script( 'outreach-footables-js', get_template_directory_uri() . '/js/footable.js', array( 'jquery' ));
    wp_enqueue_script( 'outreach-footables-launcher', get_template_directory_uri() . '/js/ooe-footable-launcher.js', array( 'jquery' ));

    wp_enqueue_style( 'outreach-psu-style', get_stylesheet_uri() );
    wp_enqueue_style( 'outreach-psu-mlpm-component', get_template_directory_uri() . '/component.css' );

    // Add Font Awesome icons (http://fontawesome.io)
    wp_enqueue_style( 'popperscores-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    wp_enqueue_script( 'outreach-psu-navigation', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20120206', true );
    wp_enqueue_script( 'outreach-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array( 'jquery' ), '20120206', true );
    wp_enqueue_script( 'outreach-psu-mlpm-modernizer', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '20120206', true );
    wp_enqueue_script( 'outreach-psu-mlpm-classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), '20120206', true );
    wp_enqueue_script( 'outreach-psu-mlpm-mlpushmenu', get_template_directory_uri() . '/js/mlpushmenu.js', array( 'jquery' ), '20120206', true );
    wp_localize_script( 'outreach-psu-navigation', 'screenReaderText', array(
       'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'outreach-psu' ) . '</span>',
       'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'outreach-psu' ) . '</span>',
    ) );
    wp_enqueue_script( 'outreach-psu-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

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
        esc_html_x( '%s', 'post date', 'outreach_psu' ), $time_string
    );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'outreach_psu' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<div class="meta-content">';
    echo '<span class="posted-on">' . $posted_on . ' </span>'; // WPCS: XSS OK.
    echo '</div><!-- .meta-content -->';

}

/**
 * Bring in favicon CHANGE THE PATH TO THE FAVICON TO LIVE .css FOLDER SO WE CAN CHANGE THEM ALL IN ONE PLACE
 */
function blog_favicon() { ?>
    <link rel="shortcut icon" href="//www.outreach.psu.edu/wp-content/themes/outreach/images/favicon.png" >
<?php }
add_action('wp_head', 'blog_favicon');

add_action( 'wp_enqueue_scripts', 'outreach_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function get_menu_parent( $menu, $post_id = null ) {
  $post_id        = $post_id ? : get_the_ID();
  $menu_items     = wp_get_nav_menu_items( $menu );
  $parent_item_id = wp_filter_object_list( $menu_items, array( 'ID' => $post_id ), 'and', 'menu_item_parent' );

  if ( ! empty( $parent_item_id ) ) {
    $parent_item_id = array_shift( $parent_item_id );
    $parent_post_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'object_id' );

    if ( ! empty( $parent_post_id ) ) {
      $parent_post_id = array_shift( $parent_post_id );

      return get_post( $parent_post_id );
      }
    }
    return false;
  }

class outreach_walker_nav_menu extends Walker_Nav_Menu {

    static $count = 0;

    // add classes to ul sub-menus
    function start_lvl( &$output, $depth ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<div class="mp-level">' . ( $display_depth < 2 ? '<a class="mp-back" href="#">Back</a>' : '' ) . '<ul class="' . $class_names . '">' . "\n";
    }
    // add classes to ul sub-menus
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent

        // build html
        $output .= "\n" . $indent . '</ul></div>' . "\n";
    }

    // add main/sub classes to li's and links
     function start_el( &$output, $item, $depth, $args ) {
        global $wp_query;

        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        if ($depth==0) self::$count=0;  // reset var when we are in first level

        if ( $depth!=0 && ($depth == self::$count) ) {  // if we are in submenu and items count is 1...
            $current_item = get_post($item->object_id);
            if( $item->type == 'taxonomy' ) {
              $parent = get_menu_parent(2, $item->ID);
            }
            else
            {
              $parent = get_post($current_item->post_parent);
            }
            // Add parent to list
            $output .= $indent . '<li class="nav-menu-parent"><a href="' . get_permalink($parent->ID) . '">' . $parent->post_title . '</a></li>';
        }

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth,
            ( $args->has_children ? 'icon-arrow-left' : '')
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $class_names . ' ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . ($item->current ? ' active' : '' ) . '"';

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        self::$count++;  // increase counter
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

}

/**
 * Register meta box(es).
 */
function outreach_page_sidebar_meta_box() {
    add_meta_box('outreach_page_sidebar', 'Sidebar Content', 'outreach_page_sidebar', 'page', 'normal', 'default');
} // outreach_page_sidebar_meta_box()
add_action('add_meta_boxes', 'outreach_page_sidebar_meta_box');

/**
 * Meta box display callback.
 *
 * @param WP_Page $page Current page object.
 */
function outreach_page_sidebar( $page ) {
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'outreach_page_sidebar-nonce' );

    $sidebar_title = get_post_meta( $page->ID, '_outreach_page_sidebar_title', false ); ?>
    <div id="titlediv">
        <label class="sidebar-title screen-reader-text" for="sidebar_title">Sidebar Title</label>
        <input id="title" type="text" name="_outreach_page_sidebar_title" value="<?php echo htmlspecialchars($sidebar_title[0]); ?>" />
    </div>
    <?php
    $sidebar_content = get_post_meta( $page->ID, '_outreach_page_sidebar', false );
    wp_editor( $sidebar_content[0], '_outreach_page_sidebar' );
} // outreach_page_sidebar()

/**
 * Save meta box content.
 *
 * @param int $page_id Page ID
 */
function outreach_page_sidebar_save_meta_box( $post_id ) {
    // Verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( ( isset ( $_POST['outreach_page_sidebar-nonce'] ) ) && ( ! wp_verify_nonce( $_POST['outreach_page_sidebar-nonce'], plugin_basename( __FILE__ ) ) ) )
      return;

    // Check permissions
    if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
          return;
        }
    }
    else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
          return;
        }
    }

    // OK, we're authenticated: we need to find and save the data
    if ( isset ( $_POST['_outreach_page_sidebar'] ) ) {
        update_post_meta( $post_id, '_outreach_page_sidebar', $_POST['_outreach_page_sidebar'] );
    }
    if ( isset ( $_POST['_outreach_page_sidebar_title'] ) ) {
        update_post_meta( $post_id, '_outreach_page_sidebar_title', $_POST['_outreach_page_sidebar_title'] );
    }
} // outreach_page_sidebar_save_meta_box
add_action( 'save_post', 'outreach_page_sidebar_save_meta_box' );

// add hook
add_filter( 'wp_nav_menu_objects', 'outreach_menu_objects_sub_menu', 10, 2 );
// filter_hook function to react on sub_menu flag

function outreach_is_current_menu_item($item) {
    if(is_single()) return reset(get_the_category())->term_id == $item->object_id;
    return $item->current;
}

function outreach_menu_parent($menu_items, $item) {
    if($item->menu_item_parent == 0) return $item->ID;
    return outreach_menu_parent($menu_items, $menu_items[$item->menu_item_parent]);
}

/*
*   A way to filter out all the items in the navigation menu that don't relate to the current section
*   being displayed
*/
function outreach_menu_objects_sub_menu( $sorted_menu_items, $args ) {
    // Even still, let's make sure we want to be here
    if ( !isset( $args->sub_menu ) ) {
        return $sorted_menu_items;
    }

    // Get the current menu item
    $current_item = reset(array_filter($sorted_menu_items,'outreach_is_current_menu_item'));

    // In order to get the top-level parent, we really need to rekey this array as menu_item_parent is NOT the same value as the object_id
    $rekeyed_menu_items = array();
    foreach($sorted_menu_items as $key => $item) {
        $rekeyed_menu_items[$item->ID] = $item;
    } // foreach

    // Now find the top-level parent, recursively
    $ancestor_id = outreach_menu_parent($rekeyed_menu_items, $current_item);

    // Only keep menu items that are the top-level parent, are directly below the top level parent, or are the current menu item (third-level item)
    $sorted_menu_items = array_filter($sorted_menu_items,function($item) USE ($ancestor_id, $current_item) {
        return $item->ID == $ancestor_id || $item->menu_item_parent == $ancestor_id || $item->ID == $current_item->ID;
    });

    // If there is only one menu item, in the case of a top-level navigation with no children, wipe out the submenu
    if(count($sorted_menu_items) == 1) $sorted_menu_items = array();

    return $sorted_menu_items;
} // outreach_menu_objects_sub_menu()

/*
*   A custom menu walker that allows us to add custom HTML to the menu render
*   We're using it primarily to add the "active" class to menu links
*/
class outreach_walker_sub_menu extends Walker_Nav_Menu {

	protected $_first = true;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth ); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=1 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    } // start_lvl()

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $li_attributes = '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        // If we are on the current page, add the active class to that menu item.
        $classes[] = ($item->current) ? 'active' : 'not-active';

        //Make sure you still add all of the Wordpress classes.
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
        //Add attributes to link element.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' depth="' . $depth . '"';
        $attributes .= ($item->current) ? ' class="active"' : '';

        // If we're on a post page (get_the_category()), make the active item the post category
        if(is_single() && $item->object_id == reset(get_the_category())->term_id) {
            $attributes  .= ' class="active"';
        }

        $item_output = $args->before;
        if($this->_first) {
            $item_output .= '<h4>This Section</h4>';
            $this->_first = false;
        }
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } // start_el()

}

// add hook
add_filter( 'wp_nav_menu_objects', 'outreach_menu_objects_breadcrumbs', 10, 2 );
// filter_hook function to react on breadcrumbs flag

function outreach_menu_parents($menu_items, $item, $parents) {
    $parents[] = $item->ID;
    if($item->menu_item_parent == 0) return $parents;
    return outreach_menu_parents($menu_items, $menu_items[$item->menu_item_parent], $parents);
}

/*
*   A way to filter out all the items in the breadcrumbs that don't relate to the current queried object
*/
function outreach_menu_objects_breadcrumbs( $sorted_menu_items, $args ) {

    // Even still, let's make sure we want to be here
    if ( !isset( $args->breadcrumbs ) ) {
        return $sorted_menu_items;
    }

    // Get the current menu item
    $current_item = reset(array_filter($sorted_menu_items,'outreach_is_current_menu_item'));

    // In order to get the parents, we really need to rekey this array as menu_item_parent is NOT the same value as the object_id
    $rekeyed_menu_items = array();
    foreach($sorted_menu_items as $key => $item) {
        $rekeyed_menu_items[$item->ID] = $item;
    } // foreach

    if( empty($current_item) && get_queried_object()->post_type == 'event' ) {
        $current_item = $rekeyed_menu_items[4198];
    }

    $current_item->direct = 1;

    // Now find the parents of this item, recursively
    $parents = outreach_menu_parents($rekeyed_menu_items, $current_item, array());

    // Only keep menu items that are the top-level parent, are directly below the top level parent, or are the current menu item (third-level item)
    $sorted_menu_items = array_filter($sorted_menu_items,function($item) USE ($parents) {
        return in_array($item->ID, $parents);
    });

    return $sorted_menu_items;
} // outreach_menu_objects_breadcrumbs()

/*
*   A custom menu walker that allows us to add custom HTML to the menu render
*   We're using it primarily to add the "active" class to menu links
*/
class outreach_walker_breadcrumbs extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '';
    } // start_lvl()

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
        if(is_single() && $item->direct) {
            $post = get_queried_object();
            $output .= '<li class="separator">&rsaquo;</li>';
            $output .= '<li>' . $post->post_title . '</li>';
        }
    } // end_el()

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if($depth == 0 && $item->menu_item_parent == 0) {
            $output .= '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">Home</a></li>';
        }
        $output .= '<li class="separator">&rsaquo;</li>';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $classes[] = 'bread-item-' . $item->ID;

        $output .= '<li' . $value . '>';
        //Add attributes to link element.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';

        $output .= $item->current ? $item->title : '<a'. $attributes .'>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</a>';

    } // start_el()

}

/**
 * Load Breadcrumbs to WP without plugin
 */
function custom_breadcrumbs($breadcrumbs_id = 'breadcrumbs', $breadcrumbs_class = 'breadcrumbs', $separator = '&gt;') {
  global $post;

  $template = '<ul class="' . $breadcrumbs_class . '" id="' . $breadcrumbs_id . '">';
  $template .= '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">Home</a></li>';
  $template .= '<li class="separator">&rsaquo;</li><li>';
  $template .= '{placeholder}';
  $template .= '</li></ul>';

  $output = wp_nav_menu( array( 'theme_location' => 'primary', 'breadcrumbs' => true, 'menu_id' => $breadcrumbs_id, 'menu_class' => $breadcrumbs_class, 'walker' => new outreach_walker_breadcrumbs, 'echo' => false ));

  if (is_search()) {
    $output = str_replace('{placeholder}', 'Search results for: ' . get_search_query(), $template);
  }
  elseif(is_404()) {
    $output = str_replace('{placeholder}', 'Error 404', $template);
  }
  elseif(empty($output)) {
    $output = str_replace('{placeholder}', $post->post_title, $template);
  }
  if (! is_front_page()) {
    echo $output;
  }
} // custom_breadcrumbs()


/**
 * Placeholder: Start moving functions from child theme to parent
 *
 *
 *
 */


/**
 * Ajax Add This Button
 */
function ajax_add_this() {

  if(is_author()){
    $author = get_the_author_meta('ID');
    echo do_shortcode('[ajax_load_more author="'.$author.'" posts_per_page="10" pause="true" scroll="false" button_label="Load More Articles" offset="10"]');
  }

  if(is_category()){
    $cat = get_category( get_query_var( 'cat' ) );
    $category = $cat->slug;
    echo do_shortcode('[ajax_load_more category="'.$category.'" posts_per_page="10" pause="true" scroll="false" button_label="Load More Articles" offset="10"]');
  }

  if(is_tag()){
    $tag = get_query_var('tag');
    echo do_shortcode('[ajax_load_more tag="'.$tag.'" posts_per_page="10" pause="true" scroll="false" button_label="Load More Articles" offset="10"]');
  }

  $year = get_the_date('Y');
  $month = get_the_date('m');
  $day = get_the_date('d');

  if(is_year()){
    echo do_shortcode('[ajax_load_more year="' . $year . '" posts_per_page="10" pause="true" scroll="false" button_label="Load More Articles" offset="10"]');
  }
  elseif(is_month()){
    echo do_shortcode('[ajax_load_more year="' . $year . '" month="' . $month . '" posts_per_page="10" pause="true" scroll="false" button_label="Load More Articles" offset="10"]');
  }
  elseif(is_day()){
    echo do_shortcode('[ajax_load_more year="' . $year . '" month="' . $month . '" day="' . $day . '" posts_per_page="10" pause="true" scroll="false" button_label="Load More Articles" offset="10"]');
  }
} // ajax_add_this()


/**
 * Remove 'Category:', 'Tag:', 'Author:' from the_archive_title
 */
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    }
    elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;

});


/**
 * Link featured images to post page
 */
if ( ! function_exists ( 'wpb_autolink_featured_images' ) ) {
  function wpb_autolink_featured_images( $html, $post_id, $post_image_id ) {
    if (! is_singular()) {
      $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
      return $html;
    }
    else {
      return $html;
    }
  }
}
add_filter( 'post_thumbnail_html', 'wpb_autolink_featured_images', 10, 3 );


/**
 * Add page attributes to Post to set order of category page
 */
add_post_type_support( 'post', 'page-attributes' );


/**
 * Add Excerpt field to Pages
 */
add_action( 'init', 'add_excerpts_to_pages' );
function add_excerpts_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}


//Pagination for search template
function blog_numeric_posts_nav() {
	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="previous-page">%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="next-page">%s</li>' . "\n", get_next_posts_link() );

	echo '</ul>' . "\n";

}

/**
 * Disable buttons and styles in the TinyMCE WYSIWYG editor
 */

// remove horizontal rule from row 1 of editor
function remove_tinymce1_buttons( $buttons ) {
  $remove = array( 'hr' );
  return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons','remove_tinymce1_buttons' );

// remove underline, justify, and font color from row 2 of editor
function remove_tinymce2_buttons( $buttons ) {
  $remove = array( 'underline', 'alignjustify', 'forecolor' );
  return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons_2','remove_tinymce2_buttons' );

// include only p, h2, h3, and h4 in style selector
function tiny_mce_remove_unused_formats( $init ) {
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
  return $init;
}
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );

/**
 * Removes the WordPress CMS version meta tag from the DOM.
 *
 * @see https://codex.wordpress.org/Function_Reference/remove_action
 */
add_action('init', function() {
	remove_action('wp_head', 'wp_generator');
});

/**
 * Adds a portable CSS class to the body element based upon the current page.  This allows for more robust styling on
 * a per-page basis by relying on the page slug, rather than natural ID to uniquely identify the current page.
 *
 * @param array $classes An array of body classes.
 *
 * @return array
 *
 * @see https://developer.wordpress.org/reference/hooks/body_class/
 * @see https://codex.wordpress.org/Function_Reference/get_post_type
 * @see https://codex.wordpress.org/Function_Reference/get_post_field
 */
add_filter('body_class', function($classes) {
	if(is_page() or is_single() or is_category()) {
		$slug = get_post_field('post_name', get_post());
		if(!empty($slug)) {
			$classes[] = "psu-page-$slug";
		}

		// Is the left sidebar empty?
		if(!is_active_sidebar('sidebar-right-body')) {
			$classes[]= 'full-width';
		}
	}
	return $classes;
});

/**
 * Filters whether a dynamic sidebar is considered "active".
 *
 * @param boolean $is_active_sidebar Whether or not the sidebar should be considered "active". In other words, whether the sidebar contains any widgets.
 * @param int|string $index Index, name, or ID of the dynamic sidebar.
 *
 * @return boolean
 *
 * @see https://codex.wordpress.org/Function_Reference/is_active_sidebar
 */
add_filter('is_active_sidebar', function($is_active_sidebar, $index) {
		$cache_key = "psu-outreach-marketing-$index";

	// Check for widgets that may be excluded from rendering by the widget-options plugin
	if($is_active_sidebar && wp_cache_get($cache_key) === false) {

		// Even if the WordPress core says that the sidebar is active, the
		// widget-options plugin can still conditionally not render the
		// widgets contained therein which will cause a condition where
		// the side-bar has no content, yet is considered active by WP core.
		//
		// This filter performs an early rendering of the sidebar HTML and stores
		// it in the volatile wp_cache mechanism for the lifetime of this request.

		// Instead of rendering the content directly, buffer the result.
		ob_start();

		dynamic_sidebar($index);

		// Grab the buffer content and store it in a variable
		$sidebar = ob_get_contents();

		// Set the buffer content (or null) in the cache
		if($sidebar) {
			wp_cache_set($cache_key, $sidebar);
		} else {
			wp_cache_set($cache_key, null);

			// This sidebar contains no renderable widgets.
			$is_active_sidebar = false;

		}

		// Destroy the temporary buffer
		ob_end_clean();
	}

	global $post;

	// Check for a navigation widget
	if($post->post_parent || count(get_pages(array('parent' => $post->ID)))) {
		$is_active_sidebar = true;
	}

	// Check for content in the meta-boxes added by the parent theme
	$parent_sidebar_title   = get_post_meta($post->ID, '_outreach_page_sidebar_title', true);
	$parent_sidebar_content = get_post_meta($post->ID, '_outreach_page_sidebar', true);

	if($parent_sidebar_title || $parent_sidebar_content) {
		$is_active_sidebar = true;
	}

	return $is_active_sidebar;
}, 10, 2);

function get_search_form_with_context($context = '', $echo = true) {
	$GLOBALS['psu_search_form_context'] = $context;
	get_search_form($echo);
	unset($GLOBALS['psu_search_form_context']);
}

function my_remove_meta_boxes() {
  global $wp_meta_boxes; // Get access to the meta boxes data structure
  // Replace the Page Attributes callback with my own function and wait for the fun to begin.
  $wp_meta_boxes["page"]["side"]["core"]["pageparentdiv"]["callback"] = "my_page_attributes_meta_box";
}
// Use the add_meta_boxes filter to get into the render process early enough yo modify callback
add_action( 'add_meta_boxes', 'my_remove_meta_boxes' );

// Literally copied the original page_attributes_meta_box function from the meta-boxes.php and modified to do my bidding
function my_page_attributes_meta_box($post) {
  if ( is_post_type_hierarchical( $post->post_type ) ) :
		$dropdown_args = array(
			'post_type'        => $post->post_type,
			'exclude_tree'     => $post->ID,
			'selected'         => $post->post_parent,
			'name'             => 'parent_id',
			'show_option_none' => __('(no parent)'),
			'sort_column'      => 'menu_order, post_title',
			'echo'             => 0,
		);

		/**
		 * Filters the arguments used to generate a Pages drop-down element.
		 *
		 * @since 3.3.0
		 *
		 * @see wp_dropdown_pages()
		 *
		 * @param array   $dropdown_args Array of arguments used to generate the pages drop-down.
		 * @param WP_Post $post          The current WP_Post object.
		 */
		$dropdown_args = apply_filters( 'page_attributes_dropdown_pages_args', $dropdown_args, $post );
		$pages = wp_dropdown_pages( $dropdown_args );
		if ( ! empty($pages) ) :
?>
<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="parent_id"><?php _e( 'Parent' ); ?></label></p>
<?php echo $pages; ?>
<?php
		endif; // end empty pages check
	endif;  // end hierarchical check.

	if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
		$template = ! empty( $post->page_template ) ? $post->page_template : false;
		?>
<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="page_template"><?php _e( 'Template' ); ?></label><?php
	/**
	 * Fires immediately after the label inside the 'Template' section
	 * of the 'Page Attributes' meta box.
	 *
	 * @since 4.4.0
	 *
	 * @param string  $template The template used for the current post.
	 * @param WP_Post $post     The current post.
	 */
	do_action( 'page_attributes_meta_box_template', $template, $post );
?></p>
<select name="page_template" id="page_template" class="test231">
<?php
/**
 * Filters the title of the default page template displayed in the drop-down.
 *
 * @since 4.1.0
 *
 * @param string $label   The display value for the default page template title.
 * @param string $context Where the option label is displayed. Possible values
 *                        include 'meta-box' or 'quick-edit'.
 */
$default_title = apply_filters( 'default_page_template_title',  __( 'Default Template' ), 'meta-box' );
?>
<option value="default"><?php echo esc_html( $default_title ); ?></option>
<?php my_page_template_dropdown( $template, $post->post_type, $post->ID ); ?>
</select>
<?php endif; ?>
<?php if ( post_type_supports( $post->post_type, 'page-attributes' ) ) : ?>
<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="menu_order"><?php _e( 'Order' ); ?></label></p>
<input name="menu_order" type="text" size="4" id="menu_order" value="<?php echo esc_attr( $post->menu_order ); ?>" />
<?php if ( 'page' == $post->post_type && get_current_screen()->get_help_tabs() ) : ?>
<p><?php _e( 'Need help? Use the Help tab above the screen title.' ); ?></p>
<?php endif;
	endif;
}

/**
 * Print out option HTML elements for the page templates drop-down.
 *
 * @since 1.5.0
 * @since 4.7.0 Added the `$post_type` parameter.
 *
 * @param string $default   Optional. The template file name. Default empty.
 * @param string $post_type Optional. Post type to get templates for. Default 'post'.
 */
 // Once again copied page_template_dropdown and modified it for my own personal gain
function my_page_template_dropdown( $default = '', $post_type = 'page', $post_id ) {
  $frontpage_id = get_option('page_on_front');
	$templates = get_page_templates( null, $post_type );
	ksort( $templates );
	foreach ( array_keys( $templates ) as $template ) {
    // Converse Implication. hide templates with homepage in the template name from non-frontpage posts/pages
    if ((($frontpage_id != $post_id) && (stripos($template, "homepage") === false)) || ($frontpage_id == $post_id)) {
		  $selected = selected( $default, $templates[ $template ], false );
		  echo "\n\t<option value='" . esc_attr( $templates[ $template ] ) . "' $selected>" . esc_html( $template ) . "</option>";
    }
	}
}
