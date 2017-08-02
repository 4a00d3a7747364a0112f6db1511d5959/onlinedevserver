<?php
/**
 * Custom Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Custom Theme 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Custom Theme only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Custom Theme 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kulan' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	//image size for inner banner
	function sb_inner_banner_size() {
	   add_theme_support( 'post-thumbnails' );
	   add_image_size( 'inner-banner', 2200, 526, true);
	}
	//add_action( 'after_setup_theme', 'sb_inner_banner_size' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'location-menu' => __( 'Location Menu', 'kulan' ),
		'header-menu' => __( 'Header Menu', 'kulan' ),
		'footer-buy-menu'  => __( 'Footer Buy Menu', 'kulan' ),
		'footer-sell-menu'  => __( 'Footer Sell Menu', 'kulan' ),
		'footer-rent-menu'  => __( 'Footer Rent Menu', 'kulan' ),
		'footer-explore-menu'  => __( 'Footer Explore Menu', 'kulan' ),
		'footer-agents-menu'  => __( 'Footer Agents Menu', 'kulan' ),
		'footer-about-menu'  => __( 'Footer About Menu', 'kulan' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Custom Theme 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.

	/**
	 * Filter Custom Theme custom-header support arguments.
	 *
	 * @since Custom Theme 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-color     		Default color of the header.
	 *     @type string $default-attachment     Default attachment of the header.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Custom Theme 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {

	//Twitter Widget
	register_sidebar( array(
		'name' => __( 'Twitter Sidebar', 'kulan' ),
		'id' => 'twitter-sidebar',
		'description' => __( 'This sidebar contains recent tweets from Twitter', 'kulan' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	//Estate Sharing Widget
	register_sidebar( array(
		'name' => __( 'Social Sharing Sidebar', 'kulan' ),
		'id' => 'social-sharing-sidebar',
		'description' => __( 'This sidebar contains Social Sharing Features', 'kulan' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	/*//Estate Related Listing Widget
	register_sidebar( array(
		'name' => __( 'Related Listing Sidebar', 'kulan' ),
		'id' => 'related-listing-sidebar',
		'description' => __( 'This sidebar contains Social Sharing Features', 'kulan' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );*/

}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Custom Theme.
 *
 * @since Custom Theme 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'kulan' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'kulan' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'kulan' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'kulan' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Custom Theme 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Custom Theme 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	//wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	//wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'kulan' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'kulan' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Custom Theme 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyfifteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Custom Theme 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Custom Theme 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Custom Theme 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Custom Theme 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Custom Theme 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Custom Theme 1.0
 */
require get_template_directory() . '/inc/customizer.php';


//Enqueue CSS & JS
function custom_theme_enqueue_style() {
	//CSS	
	wp_enqueue_style( 'brick-style', get_template_directory_uri() . '/css/brick-style.css', false );
	wp_enqueue_style( 'bxslider-css', get_template_directory_uri() . '/css/jquery.bxslider.css', false );	
	wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/css/custom.css', false );	
	wp_enqueue_style( 'responsive-css', get_template_directory_uri() . '/css/responsive.css', false );	
	wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );		
	wp_enqueue_style( 'google-css', 'https://fonts.googleapis.com/css?family=Lato:400,700' );
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/css/slick.css', false );

	//JS
	//wp_enqueue_script('lib-js', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', true);
	wp_enqueue_script( 'ewp2dce-js', get_template_directory_uri() . '/js/ewp2dce.js', true );	
    wp_enqueue_script( 'bxslider-js', get_template_directory_uri() . '/js/jquery.bxslider.js', array( 'jquery' ) );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', true );
	wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/js/parallax.js', true );
    wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.custom.10291.js', true );
    wp_enqueue_script( 'scrollspy-js', get_template_directory_uri() . '/js/jquery-scrollspy.js', true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', true );

}
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_style' );

//woocommerce support in custom theme
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

//limit excerpt length
function get_content_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" ([.*?])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 90);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
	return $excerpt;
}

//using CMB2 for metabox fields for pages and posts
//require_once dirname( __FILE__ ) . '/includes/CMB2/init.php';
//require_once dirname( __FILE__ ) . '/includes/CMB2/cmb2-functions.php';

//excerpt support to pages
add_post_type_support( 'page', 'excerpt' );

//disabling plugin update of ACF
function sb_stop_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'sb_stop_plugin_updates' );

//assigning agents to listings
add_action( 'add_meta_boxes', 'sb_add_agent_meta_box' );
function sb_add_agent_meta_box( $post ) {
    add_meta_box(
        'Agent Meta Box', // ID, should be a string.
        'Assign Agents', // Meta Box Title.
        'sb_agent_meta_box', // Your call back function
        'estate_listings', // The post type you want this to show up on
        'side', // The placement of your meta box, can be normal or side.
        'core' // The priority in which this will be displayed.
    );
}
    
 function sb_agent_meta_box($post) {
    wp_nonce_field( 'my_awesome_nonce', 'awesome_nonce' );    
    $checkboxMeta = get_post_meta( $post->ID );
    
    $args = array(
	 'numberposts' => -1,
	 'offset' => 0,
	 'category' => 0,
	 'order' => 'ASC',
	 
	 'exclude' => '',
	 'meta_key' => '',
	 'meta_value' =>'',
	 'post_type' => 'estate_agents',
	 'post_status' => 'publish',
	 'suppress_filters' => true
	);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
 
 $bobc=$recent_posts['ID'];
    ?>

    <input type="checkbox" name="<?php echo $recent_posts['ID'];?>" id="<?php echo $recent_posts['ID'];?>" value="<?php echo $recent_posts['post_title'];?>" <?php if ( isset ( $checkboxMeta[$bobc] ) ) checked( $checkboxMeta[$bobc][0], $recent_posts['post_title'] ); ?> /><?php echo $recent_posts['post_title'];?><br />
    
<?php 
}
}
add_action( 'save_post', 'save_agent_meta_box' );
    function save_agent_meta_box( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;
        if ( ( isset ( $_POST['my_awesome_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['my_awesome_nonce'], plugin_basename( __FILE__ ) ) ) )
            return;
        if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }    
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
        
        $args = array(
		 'numberposts' => -1,
		 'offset' => 0,
		 'category' => 0,
		 'order' => 'ASC',		 
		 'exclude' => '',
		 'meta_key' => '',
		 'meta_value' =>'',
		 'post_type' => 'estate_agents',
		 'post_status' => 'publish',
		 'suppress_filters' => true
		);

	$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
	$j=1;
	$input = array();
	foreach($recent_posts as $recent_posts){
	 
	 $bobc=$recent_posts['ID'];
	 $post_type = get_post_type( $post_id );
	  if($post_type =="estate_listings")
	  {

	    //saves bob's value
	    if( isset( $_POST[ $bobc] ) ) {
	        update_post_meta( $post_id, $bobc, $recent_posts['post_title'] );
	    } else {
	        update_post_meta( $post_id, $bobc, 'Null Data' );
	    }
	 }
	}
}

//php code to run in text widget
function sb_php_execute($html){
	if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}
add_filter('widget_text','sb_php_execute',100);
/*--end tags--*/ ?>