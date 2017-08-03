<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
 
 ###########################################################
#################### Theme Option #########################
###########################################################
if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_template_directory_uri());

} else {

	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_template_directory_uri());
}

require_once (OF_FILEPATH . '/admin/admin-interface.php');
require_once (OF_FILEPATH . '/admin/theme-options.php');


if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
 
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

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
	
	if ( has_post_thumbnail() ) 
	{ 
    the_post_thumbnail( 'home-size' ); 
	}

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );
	
	/*Add New Image Size For The Home Page Images Of The Models*/
	add_image_size('featuredImageCropped', 250, 200, true);

	
		function wpse_setup_theme() 
		{
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'home-size', 377, 437,true );
		}

		add_action( 'after_setup_theme', 'wpse_setup_theme' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'top-big'    => __( 'Second Menu', 'twentyseventeen' ),
		'get-know'    => __( 'Get Know Us', 'twentyseventeen' ),
		'content'    => __( 'Content', 'twentyseventeen' ),
		'help'    => __( 'Let Us Help You', 'twentyseventeen' ),
		'future'    => __( 'Future Lavish Mate', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
		'casting' => __( 'Casting Page Menu', 'twentyseventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			'sidebar-2' => array(
				'text_business_info',
			),

			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg',
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		'nav_menus' => array(
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	) );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = 700;

	if ( twentyseventeen_is_frontpage() ) {
		$content_width = 1120;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'after_setup_theme', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'twentyseventeen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );



/*Added New Codes For The Banner Section Of The Home Page*/
// Register Custom Post Type
function homepage_banner_post_type() {

	$labels = array(
		'name'                  => _x( 'Home Page Banners', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Home Page Banner', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Home Page Banners', 'text_domain' ),
		'name_admin_bar'        => __( 'Home Page Banner', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Home Page Banner', 'text_domain' ),
		'description'           => __( 'Home Page Banner Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'homepage_banner_post', $args );

}
add_action( 'init', 'homepage_banner_post_type', 0 );


function video_link_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function video_link_add_meta_box() {
	add_meta_box(
		'video_link-video-link',
		__( 'Video Link', 'video_link' ),
		'video_link_html',
		'homepage_banner_post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'video_link_add_meta_box' );

function video_link_html( $post) {
	wp_nonce_field( '_video_link_nonce', 'video_link_nonce' ); ?>

	<p>You Can Add The Video Link.
For the video link section the links can be youtube or any other embed link or the normal links or any external links.</p>

	<p>

		<input type="radio" name="video_link_link_or_embeb" id="video_link_link_or_embeb_0" value="Link" <?php echo ( video_link_get_meta( 'video_link_link_or_embeb' ) === 'Link' ) ? 'checked' : ''; ?>>
<label for="video_link_link_or_embeb_0">Link</label><br>

		<input type="radio" name="video_link_link_or_embeb" id="video_link_link_or_embeb_1" value="Embed" <?php echo ( video_link_get_meta( 'video_link_link_or_embeb' ) === 'Embed' ) ? 'checked' : ''; ?>>
<label for="video_link_link_or_embeb_1">Embed</label><br>
	</p>	<p>
		<label for="video_link_video_link_url"><?php _e( 'Video Link Url', 'video_link' ); ?></label><br>
		<textarea name="video_link_video_link_url" id="video_link_video_link_url" ><?php echo video_link_get_meta( 'video_link_video_link_url' ); ?></textarea>
	
	</p><?php
}

function video_link_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['video_link_nonce'] ) || ! wp_verify_nonce( $_POST['video_link_nonce'], '_video_link_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['video_link_link_or_embeb'] ) )
		update_post_meta( $post_id, 'video_link_link_or_embeb', esc_attr( $_POST['video_link_link_or_embeb'] ) );
	if ( isset( $_POST['video_link_video_link_url'] ) )
		update_post_meta( $post_id, 'video_link_video_link_url', esc_attr( $_POST['video_link_video_link_url'] ) );
}
add_action( 'save_post', 'video_link_save' );

/*
	Usage: video_link_get_meta( 'video_link_link_or_embeb' )
	Usage: video_link_get_meta( 'video_link_video_link_url' )
*/



function select_page_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function select_page_add_meta_box() {
	add_meta_box(
		'select_page-select-page',
		__( 'Select Page Where You Want To Add The Banner', 'select_page' ),
		'select_page_html',
		'homepage_banner_post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'select_page_add_meta_box' );

function select_page_html( $post) {
	wp_nonce_field( '_select_page_nonce', 'select_page_nonce' ); ?>

	<p>From this radio buttons you have to select the page. In that page this slider will be shown.</p>

	<p>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_0" value="Home" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Home' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_0">Home</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_1" value="Escort ladies" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Escort ladies' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_1">Escort ladies</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_2" value="Booking" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Booking' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_2">Booking</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_3" value="Vip" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Vip' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_3">Vip</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_4" value="Casting" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Casting' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_4">Casting</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_5" value="Cities" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Cities' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_5">Cities</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_6" value="Contact" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Contact' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_6">Contact</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_7" value="Rates" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Rates' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_7">Rates</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_8" value="Exotic Fantasises" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Exotic Fantasises' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_8">Exotic Fantasises</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_9" value="News" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'News' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_9">News</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_10" value="Faq" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Faq' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_10">Faq</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_11" value="The prefred lady" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'The prefred lady' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_11">The prefred lady</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_12" value="Mate of the year" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Mate of the year' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_12">Mate of the year</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_13" value="Mate of the month" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Mate of the month' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_13">Mate of the month</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_14" value="Link to us" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Link to us' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_14">Link to us</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_15" value="Events" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Events' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_15">Events</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_16" value="Our Service" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Our Service' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_16">Our Service</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_17" value="About" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'About' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_17">About</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_18" value="My Calendar" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'My Calendar' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_18">My Calendar</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_19" value="Feedback" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Feedback' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_19">Feedback</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_20" value="Members" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Members' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_20">Members</label><br>

		<input type="radio" name="select_page_page_names" id="select_page_page_names_21" value="10 steps to conquer" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === '10 steps to conquer' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_21">10 steps to conquer</label><br>

        <input type="radio" name="select_page_page_names" id="select_page_page_names_22" value="Gentleman FAQ" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Gentleman FAQ' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_22">Gentleman FAQ</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_23" value="Members lounge" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Members lounge' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_23">Members lounge</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_24" value="The Perfect Lady" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'The Perfect Lady' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_24">The Perfect Lady</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_25" value="About LavishMate" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'About LavishMate' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_25">About LavishMate</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_26" value="Gift Ideas" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Gift Ideas' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_26">Gift Ideas</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_27" value="news inner" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Gift Ideas' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_27">news inner</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_28" value="Experience" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Gift Ideas' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_28">Experience</label><br>

<input type="radio" name="select_page_page_names" id="select_page_page_names_29" value="Experience" <?php echo ( select_page_get_meta( 'select_page_page_names' ) === 'Model' ) ? 'checked' : ''; ?>>
<label for="select_page_page_names_29">Model</label><br>

	</p><?php
}

function select_page_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['select_page_nonce'] ) || ! wp_verify_nonce( $_POST['select_page_nonce'], '_select_page_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['select_page_page_names'] ) )
		update_post_meta( $post_id, 'select_page_page_names', esc_attr( $_POST['select_page_page_names'] ) );
}
add_action( 'save_post', 'select_page_save' );

/*
	Usage: select_page_get_meta( 'select_page_page_names' )
*/




// Register Custom Post Type
function Casting_Members() {

	$labels = array(
		'name'                  => _x( 'Casting Members', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Casting Members', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Casting Members', 'text_domain' ),
		'name_admin_bar'        => __( 'Casting Members', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Casting Members', 'text_domain' ),
		'description'           => __( 'Casting Members', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'casting_members', $args );

}
add_action( 'init', 'Casting_Members', 0 );


function extra_profile_fileds_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function extra_profile_fileds_add_meta_box() {
	add_meta_box(
		'extra_profile_fileds-extra-profile-fileds',
		__( 'Extra Profile Fileds', 'extra_profile_fileds' ),
		'extra_profile_fileds_html',
		'casting_members',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'extra_profile_fileds_add_meta_box' );

function extra_profile_fileds_html( $post) {
	wp_nonce_field( '_extra_profile_fileds_nonce', 'extra_profile_fileds_nonce' ); ?>

	<p>Those fields are not in the front end casting form.</p>

	<p>
		<label for="extra_profile_fileds_age"><?php _e( 'Age', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_age" id="extra_profile_fileds_age" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_age' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_bust"><?php _e( 'Bust', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_bust" id="extra_profile_fileds_bust" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_bust' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_waist"><?php _e( 'Waist', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_waist" id="extra_profile_fileds_waist" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_waist' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_hips"><?php _e( 'Hips', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_hips" id="extra_profile_fileds_hips" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_hips' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_hair"><?php _e( 'Hair', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_hair" id="extra_profile_fileds_hair" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_hair' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_eyes"><?php _e( 'Eyes', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_eyes" id="extra_profile_fileds_eyes" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_eyes' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_services"><?php _e( 'Services', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_services" id="extra_profile_fileds_services" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_services' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_ethnicity"><?php _e( 'Ethnicity', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_ethnicity" id="extra_profile_fileds_ethnicity" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_ethnicity' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_sexual_orientation"><?php _e( 'Sexual Orientation', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_sexual_orientation" id="extra_profile_fileds_sexual_orientation" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_sexual_orientation' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_cuisine"><?php _e( 'Cuisine', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_cuisine" id="extra_profile_fileds_cuisine" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_cuisine' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_drinks"><?php _e( 'Drinks', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_drinks" id="extra_profile_fileds_drinks" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_drinks' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_flowers"><?php _e( 'Flowers', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_flowers" id="extra_profile_fileds_flowers" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_flowers' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_hobbies"><?php _e( 'Hobbies', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_hobbies" id="extra_profile_fileds_hobbies" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_hobbies' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_perfumes"><?php _e( 'Perfumes', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_perfumes" id="extra_profile_fileds_perfumes" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_perfumes' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_hand_bags_by"><?php _e( 'Hand bags by', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_hand_bags_by" id="extra_profile_fileds_hand_bags_by" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_hand_bags_by' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_loves_shoes_by"><?php _e( 'Loves shoes by', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_loves_shoes_by" id="extra_profile_fileds_loves_shoes_by" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_loves_shoes_by' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_character_traits"><?php _e( 'Character traits', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_character_traits" id="extra_profile_fileds_character_traits" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_character_traits' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_trips"><?php _e( 'Trips', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_trips" id="extra_profile_fileds_trips" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_trips' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_duo_service"><?php _e( 'Duo Service', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_duo_service" id="extra_profile_fileds_duo_service" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_duo_service' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_clothing_size"><?php _e( 'Clothing Size', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_clothing_size" id="extra_profile_fileds_clothing_size" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_clothing_size' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_shoe_size"><?php _e( 'Shoe size', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_shoe_size" id="extra_profile_fileds_shoe_size" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_shoe_size' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_jeans_size"><?php _e( 'Jeans size', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_jeans_size" id="extra_profile_fileds_jeans_size" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_jeans_size' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_wardrobe"><?php _e( 'Wardrobe', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_wardrobe" id="extra_profile_fileds_wardrobe" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_wardrobe' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_lingerie"><?php _e( 'Lingerie', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_lingerie" id="extra_profile_fileds_lingerie" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_lingerie' ); ?>">
	</p>	<p>
		<label for="extra_profile_fileds_shave"><?php _e( 'Shave', 'extra_profile_fileds' ); ?></label><br>
		<input type="text" name="extra_profile_fileds_shave" id="extra_profile_fileds_shave" value="<?php echo extra_profile_fileds_get_meta( 'extra_profile_fileds_shave' ); ?>">
	</p><?php
}

function extra_profile_fileds_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['extra_profile_fileds_nonce'] ) || ! wp_verify_nonce( $_POST['extra_profile_fileds_nonce'], '_extra_profile_fileds_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['extra_profile_fileds_age'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_age', esc_attr( $_POST['extra_profile_fileds_age'] ) );
	if ( isset( $_POST['extra_profile_fileds_bust'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_bust', esc_attr( $_POST['extra_profile_fileds_bust'] ) );
	if ( isset( $_POST['extra_profile_fileds_waist'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_waist', esc_attr( $_POST['extra_profile_fileds_waist'] ) );
	if ( isset( $_POST['extra_profile_fileds_hips'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_hips', esc_attr( $_POST['extra_profile_fileds_hips'] ) );
	if ( isset( $_POST['extra_profile_fileds_hair'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_hair', esc_attr( $_POST['extra_profile_fileds_hair'] ) );
	if ( isset( $_POST['extra_profile_fileds_eyes'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_eyes', esc_attr( $_POST['extra_profile_fileds_eyes'] ) );
	if ( isset( $_POST['extra_profile_fileds_services'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_services', esc_attr( $_POST['extra_profile_fileds_services'] ) );
	if ( isset( $_POST['extra_profile_fileds_ethnicity'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_ethnicity', esc_attr( $_POST['extra_profile_fileds_ethnicity'] ) );
	if ( isset( $_POST['extra_profile_fileds_sexual_orientation'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_sexual_orientation', esc_attr( $_POST['extra_profile_fileds_sexual_orientation'] ) );
	if ( isset( $_POST['extra_profile_fileds_cuisine'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_cuisine', esc_attr( $_POST['extra_profile_fileds_cuisine'] ) );
	if ( isset( $_POST['extra_profile_fileds_drinks'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_drinks', esc_attr( $_POST['extra_profile_fileds_drinks'] ) );
	if ( isset( $_POST['extra_profile_fileds_flowers'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_flowers', esc_attr( $_POST['extra_profile_fileds_flowers'] ) );
	if ( isset( $_POST['extra_profile_fileds_hobbies'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_hobbies', esc_attr( $_POST['extra_profile_fileds_hobbies'] ) );
	if ( isset( $_POST['extra_profile_fileds_perfumes'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_perfumes', esc_attr( $_POST['extra_profile_fileds_perfumes'] ) );
	if ( isset( $_POST['extra_profile_fileds_hand_bags_by'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_hand_bags_by', esc_attr( $_POST['extra_profile_fileds_hand_bags_by'] ) );
	if ( isset( $_POST['extra_profile_fileds_loves_shoes_by'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_loves_shoes_by', esc_attr( $_POST['extra_profile_fileds_loves_shoes_by'] ) );
	if ( isset( $_POST['extra_profile_fileds_character_traits'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_character_traits', esc_attr( $_POST['extra_profile_fileds_character_traits'] ) );
	if ( isset( $_POST['extra_profile_fileds_trips'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_trips', esc_attr( $_POST['extra_profile_fileds_trips'] ) );
	if ( isset( $_POST['extra_profile_fileds_duo_service'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_duo_service', esc_attr( $_POST['extra_profile_fileds_duo_service'] ) );
	if ( isset( $_POST['extra_profile_fileds_clothing_size'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_clothing_size', esc_attr( $_POST['extra_profile_fileds_clothing_size'] ) );
	if ( isset( $_POST['extra_profile_fileds_shoe_size'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_shoe_size', esc_attr( $_POST['extra_profile_fileds_shoe_size'] ) );
	if ( isset( $_POST['extra_profile_fileds_jeans_size'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_jeans_size', esc_attr( $_POST['extra_profile_fileds_jeans_size'] ) );
	if ( isset( $_POST['extra_profile_fileds_wardrobe'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_wardrobe', esc_attr( $_POST['extra_profile_fileds_wardrobe'] ) );
	if ( isset( $_POST['extra_profile_fileds_lingerie'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_lingerie', esc_attr( $_POST['extra_profile_fileds_lingerie'] ) );
	if ( isset( $_POST['extra_profile_fileds_shave'] ) )
		update_post_meta( $post_id, 'extra_profile_fileds_shave', esc_attr( $_POST['extra_profile_fileds_shave'] ) );
}
add_action( 'save_post', 'extra_profile_fileds_save' );

/*
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_age' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_bust' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_waist' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_hips' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_hair' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_eyes' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_services' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_ethnicity' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_sexual_orientation' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_cuisine' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_drinks' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_flowers' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_hobbies' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_perfumes' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_hand_bags_by' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_loves_shoes_by' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_character_traits' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_trips' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_duo_service' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_clothing_size' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_shoe_size' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_jeans_size' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_wardrobe' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_lingerie' )
	Usage: extra_profile_fileds_get_meta( 'extra_profile_fileds_shave' )
*/
// Register Custom Post Type
function booking_post_type() {

	$labels = array(
		'name'                  => _x( 'Booking', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Booking', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Booking', 'text_domain' ),
		'name_admin_bar'        => __( 'Booking', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Booking', 'text_domain' ),
		'update_item'           => __( 'Update Booking', 'text_domain' ),
		'view_item'             => __( 'View Booking', 'text_domain' ),
		'view_items'            => __( 'View Bookings', 'text_domain' ),
		'search_items'          => __( 'Search Bookings', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Booking', 'text_domain' ),
		'description'           => __( 'Booking Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'booking_post_type', $args );

}
add_action( 'init', 'booking_post_type', 0 );



function booking_forms_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function booking_forms_add_meta_box() {
	add_meta_box(
		'booking_forms-booking-forms',
		__( 'Booking Forms', 'booking_forms' ),
		'booking_forms_html',
		'booking_post_type',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'booking_forms_add_meta_box' );

function booking_forms_html( $post) {
	wp_nonce_field( '_booking_forms_nonce', 'booking_forms_nonce' ); ?>

	<p>The Booking Form Details are stored here</p>

	<p>
		<label for="booking_forms_first_name"><?php _e( 'First Name', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_first_name" id="booking_forms_first_name" value="<?php echo booking_forms_get_meta( 'booking_forms_first_name' ); ?>">
	</p>	<p>
		<label for="booking_forms_age"><?php _e( 'Age', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_age" id="booking_forms_age" value="<?php echo booking_forms_get_meta( 'booking_forms_age' ); ?>">
	</p>	<p>
	</p>	<p>
		<label for="booking_forms_gender"><?php _e( 'Gender', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_gender" id="booking_forms_gender" value="<?php echo booking_forms_get_meta( 'booking_forms_gender' ); ?>">
	</p>	<p>
		<label for="booking_forms_nationality"><?php _e( 'Nationality', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_nationality" id="booking_forms_nationality" value="<?php echo booking_forms_get_meta( 'booking_forms_nationality' ); ?>">
	</p>	<p>
		<label for="booking_forms_email"><?php _e( 'Email', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_email" id="booking_forms_email" value="<?php echo booking_forms_get_meta( 'booking_forms_email' ); ?>">
	</p>	<p>
		<label for="booking_forms_confirm_email"><?php _e( 'Confirm Email', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_confirm_email" id="booking_forms_confirm_email" value="<?php echo booking_forms_get_meta( 'booking_forms_confirm_email' ); ?>">
	</p>	<p>
		<label for="booking_forms_phone_number"><?php _e( 'Phone Number', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_phone_number" id="booking_forms_phone_number" value="<?php echo booking_forms_get_meta( 'booking_forms_phone_number' ); ?>">
	</p>	<p>
		<label for="booking_forms_mobile_phone_number"><?php _e( 'Mobile Phone Number', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_mobile_phone_number" id="booking_forms_mobile_phone_number" value="<?php echo booking_forms_get_meta( 'booking_forms_mobile_phone_number' ); ?>">
	</p>	<p>
		<label for="booking_forms_address"><?php _e( 'Address', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_address" id="booking_forms_address" value="<?php echo booking_forms_get_meta( 'booking_forms_address' ); ?>">
	</p>	<p>
		<label for="booking_forms_city"><?php _e( 'City', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_city" id="booking_forms_city" value="<?php echo booking_forms_get_meta( 'booking_forms_city' ); ?>">
	</p>	<p>
		<label for="booking_forms_zip_code"><?php _e( 'Zip Code', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_zip_code" id="booking_forms_zip_code" value="<?php echo booking_forms_get_meta( 'booking_forms_zip_code' ); ?>">
	</p>	<p>
		<label for="booking_forms_hotel_room"><?php _e( 'Hotel/Room', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_hotel_room" id="booking_forms_hotel_room" value="<?php echo booking_forms_get_meta( 'booking_forms_hotel_room' ); ?>">
	</p>	<p>
		<label for="booking_forms_desired_mate"><?php _e( 'Desired Mate', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_desired_mate" id="booking_forms_desired_mate" value="<?php echo booking_forms_get_meta( 'booking_forms_desired_mate' ); ?>">
	</p>	<p>
		<label for="booking_forms_alternative_mate"><?php _e( 'Alternative Mate', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_alternative_mate" id="booking_forms_alternative_mate" value="<?php echo booking_forms_get_meta( 'booking_forms_alternative_mate' ); ?>">
	</p>	<p>
		<label for="booking_forms_how_many_mates"><?php _e( 'How many mates', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_how_many_mates" id="booking_forms_how_many_mates" value="<?php echo booking_forms_get_meta( 'booking_forms_how_many_mates' ); ?>">
	</p>	<p>
		<label for="booking_forms_date_of_meeting"><?php _e( 'Date of meeting', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_date_of_meeting" id="booking_forms_date_of_meeting" value="<?php echo booking_forms_get_meta( 'booking_forms_date_of_meeting' ); ?>">
	</p>	<p>
		<label for="booking_forms_time_of_meeting"><?php _e( 'Time of Meeting', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_time_of_meeting" id="booking_forms_time_of_meeting" value="<?php echo booking_forms_get_meta( 'booking_forms_time_of_meeting' ); ?>">
	</p>	<p>
		<label for="booking_forms_best_times_to_call"><?php _e( 'Best times to call', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_best_times_to_call" id="booking_forms_best_times_to_call" value="<?php echo booking_forms_get_meta( 'booking_forms_best_times_to_call' ); ?>">
	</p>	<p>
		<label for="booking_forms_duration"><?php _e( 'Duration', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_duration" id="booking_forms_duration" value="<?php echo booking_forms_get_meta( 'booking_forms_duration' ); ?>">
	</p>	<p>
		<label for="booking_forms_any_likes_or_dislikes"><?php _e( 'Any likes or Dislikes', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_any_likes_or_dislikes" id="booking_forms_any_likes_or_dislikes" value="<?php echo booking_forms_get_meta( 'booking_forms_any_likes_or_dislikes' ); ?>">
	</p>	<p>
		<label for="booking_forms_dress_style"><?php _e( 'Dress Style', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_dress_style" id="booking_forms_dress_style" value="<?php echo booking_forms_get_meta( 'booking_forms_dress_style' ); ?>">
	</p>	<p>
		<label for="booking_forms_payment_method"><?php _e( 'Payment Method', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_payment_method" id="booking_forms_payment_method" value="<?php echo booking_forms_get_meta( 'booking_forms_payment_method' ); ?>">
	</p>	<p>
		<label for="booking_forms_how_did_you_find_us_"><?php _e( 'How did you find us?', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_how_did_you_find_us_" id="booking_forms_how_did_you_find_us_" value="<?php echo booking_forms_get_meta( 'booking_forms_how_did_you_find_us_' ); ?>">
	</p>	<p>
		<label for="booking_forms_what_is_your_desired_message_for_your_mate_"><?php _e( 'What is your desired message for your mate?', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_what_is_your_desired_message_for_your_mate_" id="booking_forms_what_is_your_desired_message_for_your_mate_" value="<?php echo booking_forms_get_meta( 'booking_forms_what_is_your_desired_message_for_your_mate_' ); ?>">
	</p>	<p>
		<label for="booking_forms_special_requests"><?php _e( 'Special Requests', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_special_requests" id="booking_forms_special_requests" value="<?php echo booking_forms_get_meta( 'booking_forms_special_requests' ); ?>">
	</p>	<p>
		<label for="booking_forms_payment_status"><?php _e( 'Payment Status', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_payment_status" id="booking_forms_payment_status" value="<?php echo booking_forms_get_meta( 'booking_forms_payment_status' ); ?>">
	</p>	<p>
		<label for="booking_forms_booking_user_name"><?php _e( 'Booking User Name', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_booking_user_name" id="booking_forms_booking_user_name" value="<?php echo booking_forms_get_meta( 'booking_forms_booking_user_name' ); ?>">
	</p>	<p>
		<label for="booking_forms_booking_ip_address"><?php _e( 'Booking Ip Address', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_booking_ip_address" id="booking_forms_booking_ip_address" value="<?php echo booking_forms_get_meta( 'booking_forms_booking_ip_address' ); ?>">
	</p>	<p>
		<label for="booking_forms_booking_time"><?php _e( 'Booking Time', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_booking_time" id="booking_forms_booking_time" value="<?php echo booking_forms_get_meta( 'booking_forms_booking_time' ); ?>">
	</p>	<p>
		<label for="booking_forms_booking_user_id"><?php _e( 'Booking User Id', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_booking_user_id" id="booking_forms_booking_user_id" value="<?php echo booking_forms_get_meta( 'booking_forms_booking_user_id' ); ?>">
	</p>
	
	<p>
		<label for="booking_forms_booking_user_cardnum"><?php _e( 'Booking User Card Number', 'booking_forms' ); ?></label><br>
		<input type="text" name="booking_forms_booking_user_cardnum" id="booking_forms_booking_user_cardnum" value="<?php echo booking_forms_get_meta( 'booking_forms_booking_user_cardnum' ); ?>">
	</p>
	
	
	<?php
}

function booking_forms_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['booking_forms_nonce'] ) || ! wp_verify_nonce( $_POST['booking_forms_nonce'], '_booking_forms_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['booking_forms_first_name'] ) )
		update_post_meta( $post_id, 'booking_forms_first_name', esc_attr( $_POST['booking_forms_first_name'] ) );
	if ( isset( $_POST['booking_forms_age'] ) )
		update_post_meta( $post_id, 'booking_forms_age', esc_attr( $_POST['booking_forms_age'] ) );
	if ( isset( $_POST['booking_forms_gender'] ) )
		update_post_meta( $post_id, 'booking_forms_gender', esc_attr( $_POST['booking_forms_gender'] ) );
	if ( isset( $_POST['booking_forms_nationality'] ) )
		update_post_meta( $post_id, 'booking_forms_nationality', esc_attr( $_POST['booking_forms_nationality'] ) );
	if ( isset( $_POST['booking_forms_email'] ) )
		update_post_meta( $post_id, 'booking_forms_email', esc_attr( $_POST['booking_forms_email'] ) );
	if ( isset( $_POST['booking_forms_confirm_email'] ) )
		update_post_meta( $post_id, 'booking_forms_confirm_email', esc_attr( $_POST['booking_forms_confirm_email'] ) );
	if ( isset( $_POST['booking_forms_phone_number'] ) )
		update_post_meta( $post_id, 'booking_forms_phone_number', esc_attr( $_POST['booking_forms_phone_number'] ) );
	if ( isset( $_POST['booking_forms_mobile_phone_number'] ) )
		update_post_meta( $post_id, 'booking_forms_mobile_phone_number', esc_attr( $_POST['booking_forms_mobile_phone_number'] ) );
	if ( isset( $_POST['booking_forms_address'] ) )
		update_post_meta( $post_id, 'booking_forms_address', esc_attr( $_POST['booking_forms_address'] ) );
	if ( isset( $_POST['booking_forms_city'] ) )
		update_post_meta( $post_id, 'booking_forms_city', esc_attr( $_POST['booking_forms_city'] ) );
	if ( isset( $_POST['booking_forms_zip_code'] ) )
		update_post_meta( $post_id, 'booking_forms_zip_code', esc_attr( $_POST['booking_forms_zip_code'] ) );
	if ( isset( $_POST['booking_forms_hotel_room'] ) )
		update_post_meta( $post_id, 'booking_forms_hotel_room', esc_attr( $_POST['booking_forms_hotel_room'] ) );
	if ( isset( $_POST['booking_forms_desired_mate'] ) )
		update_post_meta( $post_id, 'booking_forms_desired_mate', esc_attr( $_POST['booking_forms_desired_mate'] ) );
	if ( isset( $_POST['booking_forms_alternative_mate'] ) )
		update_post_meta( $post_id, 'booking_forms_alternative_mate', esc_attr( $_POST['booking_forms_alternative_mate'] ) );
	if ( isset( $_POST['booking_forms_how_many_mates'] ) )
		update_post_meta( $post_id, 'booking_forms_how_many_mates', esc_attr( $_POST['booking_forms_how_many_mates'] ) );
	if ( isset( $_POST['booking_forms_date_of_meeting'] ) )
		update_post_meta( $post_id, 'booking_forms_date_of_meeting', esc_attr( $_POST['booking_forms_date_of_meeting'] ) );
	if ( isset( $_POST['booking_forms_time_of_meeting'] ) )
		update_post_meta( $post_id, 'booking_forms_time_of_meeting', esc_attr( $_POST['booking_forms_time_of_meeting'] ) );
	if ( isset( $_POST['booking_forms_best_times_to_call'] ) )
		update_post_meta( $post_id, 'booking_forms_best_times_to_call', esc_attr( $_POST['booking_forms_best_times_to_call'] ) );
	if ( isset( $_POST['booking_forms_duration'] ) )
		update_post_meta( $post_id, 'booking_forms_duration', esc_attr( $_POST['booking_forms_duration'] ) );
	if ( isset( $_POST['booking_forms_any_likes_or_dislikes'] ) )
		update_post_meta( $post_id, 'booking_forms_any_likes_or_dislikes', esc_attr( $_POST['booking_forms_any_likes_or_dislikes'] ) );
	if ( isset( $_POST['booking_forms_dress_style'] ) )
		update_post_meta( $post_id, 'booking_forms_dress_style', esc_attr( $_POST['booking_forms_dress_style'] ) );
	if ( isset( $_POST['booking_forms_payment_method'] ) )
		update_post_meta( $post_id, 'booking_forms_payment_method', esc_attr( $_POST['booking_forms_payment_method'] ) );
	if ( isset( $_POST['booking_forms_how_did_you_find_us_'] ) )
		update_post_meta( $post_id, 'booking_forms_how_did_you_find_us_', esc_attr( $_POST['booking_forms_how_did_you_find_us_'] ) );
	if ( isset( $_POST['booking_forms_what_is_your_desired_message_for_your_mate_'] ) )
		update_post_meta( $post_id, 'booking_forms_what_is_your_desired_message_for_your_mate_', esc_attr( $_POST['booking_forms_what_is_your_desired_message_for_your_mate_'] ) );
	if ( isset( $_POST['booking_forms_special_requests'] ) )
		update_post_meta( $post_id, 'booking_forms_special_requests', esc_attr( $_POST['booking_forms_special_requests'] ) );
	if ( isset( $_POST['booking_forms_payment_status'] ) )
		update_post_meta( $post_id, 'booking_forms_payment_status', esc_attr( $_POST['booking_forms_payment_status'] ) );
	if ( isset( $_POST['booking_forms_booking_user_name'] ) )
		update_post_meta( $post_id, 'booking_forms_booking_user_name', esc_attr( $_POST['booking_forms_booking_user_name'] ) );
	if ( isset( $_POST['booking_forms_booking_ip_address'] ) )
		update_post_meta( $post_id, 'booking_forms_booking_ip_address', esc_attr( $_POST['booking_forms_booking_ip_address'] ) );
	if ( isset( $_POST['booking_forms_booking_time'] ) )
		update_post_meta( $post_id, 'booking_forms_booking_time', esc_attr( $_POST['booking_forms_booking_time'] ) );
	if ( isset( $_POST['booking_forms_booking_user_id'] ) )
		update_post_meta( $post_id, 'booking_forms_booking_user_id', esc_attr( $_POST['booking_forms_booking_user_id'] ) );
	if ( isset( $_POST['booking_forms_booking_user_cardnum'] ) )
		update_post_meta( $post_id, 'booking_forms_booking_user_cardnum', esc_attr( $_POST['booking_forms_booking_user_cardnum'] ) );
}
add_action( 'save_post', 'booking_forms_save' );

/*
	Usage: booking_forms_get_meta( 'booking_forms_first_name' )
	Usage: booking_forms_get_meta( 'booking_forms_age' )
	Usage: booking_forms_get_meta( 'booking_forms_nationality' )
	Usage: booking_forms_get_meta( 'booking_forms_email' )
	Usage: booking_forms_get_meta( 'booking_forms_confirm_email' )
	Usage: booking_forms_get_meta( 'booking_forms_phone_number' )
	Usage: booking_forms_get_meta( 'booking_forms_mobile_phone_number' )
	Usage: booking_forms_get_meta( 'booking_forms_address' )
	Usage: booking_forms_get_meta( 'booking_forms_city' )
	Usage: booking_forms_get_meta( 'booking_forms_zip_code' )
	Usage: booking_forms_get_meta( 'booking_forms_hotel_room' )
	Usage: booking_forms_get_meta( 'booking_forms_desired_mate' )
	Usage: booking_forms_get_meta( 'booking_forms_alternative_mate' )
	Usage: booking_forms_get_meta( 'booking_forms_how_many_mates' )
	Usage: booking_forms_get_meta( 'booking_forms_date_of_meeting' )
	Usage: booking_forms_get_meta( 'booking_forms_time_of_meeting' )
	Usage: booking_forms_get_meta( 'booking_forms_best_times_to_call' )
	Usage: booking_forms_get_meta( 'booking_forms_duration' )
	Usage: booking_forms_get_meta( 'booking_forms_any_likes_or_dislikes' )
	Usage: booking_forms_get_meta( 'booking_forms_dress_style' )
	Usage: booking_forms_get_meta( 'booking_forms_payment_method' )
	Usage: booking_forms_get_meta( 'booking_forms_how_did_you_find_us_' )
	Usage: booking_forms_get_meta( 'booking_forms_what_is_your_desired_message_for_your_mate_' )
	Usage: booking_forms_get_meta( 'booking_forms_special_requests' )
	Usage: booking_forms_get_meta( 'booking_forms_payment_status' )
	Usage: booking_forms_get_meta( 'booking_forms_booking_user_name' )
	Usage: booking_forms_get_meta( 'booking_forms_booking_ip_address' )
	Usage: booking_forms_get_meta( 'booking_forms_booking_time' )
	Usage: booking_forms_get_meta( 'booking_forms_booking_user_id' )
	Usage: booking_forms_get_meta( 'booking_forms_booking_user_cardnum' )
*/

/*Add Function For Getting The Desire Model Images */
add_action("wp_ajax_get_model_image", "get_model_image");
add_action("wp_ajax_nopriv_get_model_image", "get_model_image");

function get_model_image()
{
	
	$model_name = $_REQUEST['model_name'];
	$post = get_page_by_title( $model_name, OBJECT, 'casting_members' );
	//echo $post->ID;
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

							if( class_exists('Dynamic_Featured_Image') ) 
							{

								global $dynamic_featured_image;

								$featured_images = $dynamic_featured_image->get_featured_images($post->ID );

							//print_r($featured_images);

								foreach($featured_images as $featured_image) 
								{

									$fullSizedImage = $dynamic_featured_image->get_image_url($featured_image['attachment_id'], 'full');


								}  

							}
							
							if ( is_user_logged_in() ) 
							{

								$image_link = $fullSizedImage;
							} 
							else 
							{
								$image_link = $image[0];
							}
							echo $image_link;
	exit();
}

add_action("wp_ajax_get_model_image_alt", "get_model_image_alt");
add_action("wp_ajax_nopriv_get_model_image_alt", "get_model_image_alt");

function get_model_image_alt()
{
	
	$model_name = $_REQUEST['model_name_alt'];
	$post = get_page_by_title( $model_name, OBJECT, 'casting_members' );
	//echo $post->ID;
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

							if( class_exists('Dynamic_Featured_Image') ) 
							{

								global $dynamic_featured_image;

								$featured_images = $dynamic_featured_image->get_featured_images($post->ID );

							//print_r($featured_images);

								foreach($featured_images as $featured_image) 
								{

									$fullSizedImage = $dynamic_featured_image->get_image_url($featured_image['attachment_id'], 'full');


								}  

							}
							
							if ( is_user_logged_in() ) 
							{

								$image_link = $fullSizedImage;
							} 
							else 
							{
								$image_link = $image[0];
							}
							echo $image_link;
	exit();
}





/**/
add_action("wp_ajax_save_feedback", "save_feedback");
add_action("wp_ajax_nopriv_save_feedback", "save_feedback");

function save_feedback()
{
	$first_name = $_REQUEST['first_name'];
	$email = $_REQUEST['email'];
	$name_of_lady = $_REQUEST['name_of_lady'];
	$place = $_REQUEST['place'];
	$feedback = $_REQUEST['request'];
	$place_or_not = $_REQUEST['place_or_not'];
	
	 $current_user = wp_get_current_user();
	 $user_name = $current_user->user_login;
	 $user_email = $current_user->user_email;
	 $user_fname = $current_user->user_firstname;
	 $user_lname = $current_user->user_lastname;
	 $user_id = $current_user->ID;
	
	
	$time = current_time('mysql');

	$data = array(
	'comment_post_ID' => $user_id,
	'comment_author' => $user_name,
	'comment_author_email' => $user_email,
	'comment_content' => $feedback,
	'comment_type' => '',
	'comment_parent' => 0,
	'user_id' => $user_id,
	'comment_author_IP' => '127.0.0.1',
	'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
	'comment_date' => $time,
	'comment_approved' => 1,
	);

	wp_insert_comment($data);

exit();
}


add_action("wp_ajax_get_booking", "get_booking");
add_action("wp_ajax_nopriv_get_booking", "get_booking");

function get_booking()
{
	//global $wpdb;
	$post_type = "booking_post_type";
	
	$first_name = $_REQUEST['first_name'];
	$age = $_REQUEST['age'];
	$gender = $_REQUEST['gender'];
	$nationality = $_REQUEST['nationality'];
	$email = $_REQUEST['email'];
	$conemail = $_REQUEST['conemail'];
	$phn = $_REQUEST['phn'];
	$mob_phn = $_REQUEST['mob_phn'];
	$address = $_REQUEST['address'];
	$city = $_REQUEST['city'];
	$zip = $_REQUEST['zip'];
	$hotel = $_REQUEST['hotel'];
	$mate = $_REQUEST['mate'];
	$altmate = $_REQUEST['altmate'];
	$nomate = $_REQUEST['nomate'];
	$date = $_REQUEST['date'];
	$time = $_REQUEST['time'];
	$time_call = $_REQUEST['time_call'];
	$duration = $_REQUEST['duration'];
	$dislike = $_REQUEST['dislike'];
	$dress_type = $_REQUEST['dress_type'];
	$payment = $_REQUEST['payment'];
	$find_us = $_REQUEST['find_us'];
	$message_book = $_REQUEST['message'];
	$spcl_request = $_REQUEST['spcl_request'];
	
	//the array of arguements to be inserted with wp_insert_post
	$new_post = array(
					 'post_title'    => $first_name,
					 'post_status'   => 'publish',          
					 'post_type'     => $post_type 
				   );

	//insert the the post into database by passing $new_post to wp_insert_post
	//store our post ID in a variable $pid
	$pid = wp_insert_post($new_post);

	
	
	
	$user_id = username_exists( $first_name );
	if ( !$user_id and email_exists($email) == false ) 
	{
		$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		//~ $user_id = wp_create_user( $first_name, $random_password, $email );
		$userdata = array(
        'user_login'    =>   $first_name,
        'user_email'    =>   $email,
        'user_pass'     =>   $random_password,
		'first_name'    =>   $first_name,
        );
		
		$lastid = wp_insert_user( $userdata );
		//$lastid = $wpdb->insert_id;
		add_user_meta( $lastid, 'address', $address);
		add_user_meta( $lastid, 'phone', $phn );
		add_user_meta( $lastid, 'mobphone', $mob_phn );
		
		$message = "Thanks For Registration. Your user id is ".$first_name." email is ".$email." password is --- ".$random_password;
		$headers[] = 'From: Me Myself <me@example.net>';
		$headers[] = 'Cc: Aditya <projectsforadi@gmail.com>';
		
		wp_mail( $email, 'New User Resistration', $message,$headers);
	
	}
		add_post_meta($pid, 'booking_forms_first_name', $first_name, true);
		add_post_meta($pid, 'booking_forms_age', $age, true);
		add_post_meta($pid, 'booking_forms_nationality', $nationality, true);
		add_post_meta($pid, 'booking_forms_email', $email, true);
		add_post_meta($pid, 'booking_forms_confirm_email', $conemail, true);
		add_post_meta($pid, 'booking_forms_phone_number', $phn, true);
		add_post_meta($pid, 'booking_forms_mobile_phone_number', $mob_phn, true);
		add_post_meta($pid, 'booking_forms_address', $address, true);
		add_post_meta($pid, 'booking_forms_city', $city, true);
		add_post_meta($pid, 'booking_forms_zip_code', $zip, true);
		add_post_meta($pid, 'booking_forms_hotel_room', $hotel, true);
		add_post_meta($pid, 'booking_forms_desired_mate', $mate, true);
		add_post_meta($pid, 'booking_forms_alternative_mate', $altmate, true);
		add_post_meta($pid, 'booking_forms_how_many_mates', $nomate, true);
		add_post_meta($pid, 'booking_forms_date_of_meeting', $date, true);
		add_post_meta($pid, 'booking_forms_time_of_meeting', $time, true);
		add_post_meta($pid, 'booking_forms_best_times_to_call', $time_call, true);
		add_post_meta($pid, 'booking_forms_duration', $duration, true);
		add_post_meta($pid, 'booking_forms_any_likes_or_dislikes', $dislike, true);
		add_post_meta($pid, 'booking_forms_dress_style', $dress_type, true);
		add_post_meta($pid, 'booking_forms_payment_method', $payment, true);
		add_post_meta($pid, 'booking_forms_how_did_you_find_us_', $find_us, true);
		add_post_meta($pid, 'booking_forms_what_is_your_desired_message_for_your_mate_', $message_book, true);
		add_post_meta($pid, 'booking_forms_special_requests', $spcl_request, true);
		
		
		
		echo $pid.'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
		
		//header('Location: http://onlinedevserver.biz/dev/lavish/'); 
		
		exit();
	}

add_action("wp_ajax_get_experience", "get_experience");
add_action("wp_ajax_nopriv_get_experience", "get_experience");


add_action("wp_ajax_get_booking_events", "get_booking_events");
add_action("wp_ajax_nopriv_get_booking_events", "get_booking_events");

function get_booking_events()
{
	global $wpdb;
	$event_name = $_REQUEST['event_name'];
	$first_name_events = $_REQUEST['first_name_events'];
	$age_events = $_REQUEST['age_events'];
	$gender_events = $_REQUEST['gender_events'];
	$email_events = $_REQUEST['email_events'];
	$phn_events = $_REQUEST['phn_events'];
	$mob_phn_events = $_REQUEST['mob_phn_events'];
	$address_events = $_REQUEST['address_events'];
	$payment_events = $_REQUEST['payment_events'];
	$find_us_events = $_REQUEST['find_us_events'];
	
	$post_name = $event_name."- Event Booking";
	$post_type = "booking_post_type";
	$new_post = array(
					 'post_title'    => $post_name,
					 'post_status'   => 'publish',          
					 'post_type'     => $post_type 
				   );
				   
			   

	//insert the the post into database by passing $new_post to wp_insert_post
	//store our post ID in a variable $pid
	$pid = wp_insert_post($new_post);
	
	
	
		add_post_meta($pid, 'booking_forms_first_name', $first_name_events, true);
		add_post_meta($pid, 'booking_forms_age', $age_events, true);
		//~ add_post_meta($pid, 'booking_forms_nationality', $nationality, true);
		add_post_meta($pid, 'booking_forms_email', $email_events, true);
		//~ add_post_meta($pid, 'booking_forms_confirm_email', $conemail, true);
		add_post_meta($pid, 'booking_forms_phone_number', $phn_events, true);
		add_post_meta($pid, 'booking_forms_mobile_phone_number', $mob_phn_events, true);
		add_post_meta($pid, 'booking_forms_address', $address_events, true);
		//~ add_post_meta($pid, 'booking_forms_city', $city, true);
		//~ add_post_meta($pid, 'booking_forms_zip_code', $zip, true);
		//~ add_post_meta($pid, 'booking_forms_hotel_room', $hotel, true);
		//~ add_post_meta($pid, 'booking_forms_desired_mate', $mate, true);
		//~ add_post_meta($pid, 'booking_forms_alternative_mate', $altmate, true);
		//~ add_post_meta($pid, 'booking_forms_how_many_mates', $nomate, true);
		//~ add_post_meta($pid, 'booking_forms_date_of_meeting', $date, true);
		//~ add_post_meta($pid, 'booking_forms_time_of_meeting', $time, true);
		add_post_meta($pid, 'booking_forms_best_times_to_call', $time_call, true);
		//~ add_post_meta($pid, 'booking_forms_duration', $duration, true);
		//~ add_post_meta($pid, 'booking_forms_any_likes_or_dislikes', $dislike, true);
		//~ add_post_meta($pid, 'booking_forms_dress_style', $dress_type, true);
		add_post_meta($pid, 'booking_forms_payment_method', $payment_events, true);
		add_post_meta($pid, 'booking_forms_how_did_you_find_us_', $find_us_events, true);
		//~ add_post_meta($pid, 'booking_forms_what_is_your_desired_message_for_your_mate_', $message_book, true);
		//~ add_post_meta($pid, 'booking_forms_special_requests', $spcl_request, true);
		
	
	
	$user_id_events = username_exists( $first_name_events );
	if ( !$user_id_events and email_exists($email_events) == false ) 
	{
		$random_password_events = wp_generate_password( $length=12, $include_standard_special_chars=false );
		//~ $user_id = wp_create_user( $first_name, $random_password, $email );
		$userdata_events = array(
        'user_login'    =>   $first_name_events,
        'user_email'    =>   $email_events,
        'user_pass'     =>   $random_password_events,
		'first_name'    =>   $first_name_events,
        );
		
		$user_new = wp_insert_user( $userdata_events );
		$lastid_events = $user_new;
		add_user_meta( $lastid_events, 'address', $address_events);
		add_user_meta( $lastid_events, 'phone', $phn_events );
		add_user_meta( $lastid_events, 'mobphone', $mob_phn_events );
		
		echo $message_events = "Thanks For Registration. Your user id is ".$first_name_events." email is ".$email_events." password is --- ".$random_password_events;
		$headers[] = 'From: Me Myself <me@example.net>';
		$headers[] = 'Cc: Aditya <shourya@uniterrene.com>';
		
		wp_mail( $email_events, 'New User Resistration', $message_events,$headers);
	
	}	
	
	
	
	exit();
	
}



function get_experience()
{
	$selected_val = $_REQUEST['selected_val'];
	
	$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'rand',
	'order' => 'ASC',
	'tag' => $selected_val,
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'experience_post_type',
	'post_status' => 'publish',
	'suppress_filters' => true
	);
	$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
	$j=1;
	
	$opt_emd = array();
	foreach($recent_posts as $recent_posts)
	{
		
		array_push($opt_emd,$recent_posts['ID']);
		
	}
	
	$dadaget = array("embroiderycode"=>$opt_emd);
	echo json_encode($dadaget);
	
	
	exit();
}
function feed_back_add_meta_box() {
	add_meta_box(
		'feed_back-feed-back',
		__( 'Feed Back', 'feed_back' ),
		'feed_back_html',
		'post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'feed_back_add_meta_box' );

function feed_back_html( $post) {
	wp_nonce_field( '_feed_back_nonce', 'feed_back_nonce' ); ?>

	<p>
		<label for="feed_back_customer_feedback"><?php _e( 'Customer Feedback', 'feed_back' ); ?></label><br>
		<textarea name="feed_back_customer_feedback" id="feed_back_customer_feedback" ><?php echo feed_back_get_meta( 'feed_back_customer_feedback' ); ?></textarea>
	
	</p><?php
}

function feed_back_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['feed_back_nonce'] ) || ! wp_verify_nonce( $_POST['feed_back_nonce'], '_feed_back_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['feed_back_customer_feedback'] ) )
		update_post_meta( $post_id, 'feed_back_customer_feedback', esc_attr( $_POST['feed_back_customer_feedback'] ) );
}
add_action( 'save_post', 'feed_back_save' );


add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="address">Address</label></th>

			<td>
				<input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your address.</span>
						
			</td>
			</tr>
			<tr>
			<th><label for="address">Phone</label></th>

			<td>
				<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your phone.</span>
						
			</td>
		</tr>
		<tr>	
			<th><label for="address">Mobile Phone</label></th>

			<td>
				<input type="text" name="mobphone" id="mobphone" value="<?php echo esc_attr( get_the_author_meta( 'mobphone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your mobphone.</span>
					
			</td>
			</tr>
			<tr>
				<th><label for="address">Age</label></th>
			<td>
				<input type="text" name="age" id="age" value="<?php echo esc_attr( get_the_author_meta( 'age', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your age.</span>
					
			</td>
			</tr>
			<tr>
			<th><label for="address">City</label></th>
			<td>
				<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your city.</span>
					
			</td>
			</tr>
			

	</table>
<?php }
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'address', $_POST['address'] );
	update_usermeta( $user_id, 'phone', $_POST['phone'] );
	update_usermeta( $user_id, 'mobphone', $_POST['mobphone'] );
}
/*Remove the dashboard link from the backend for the subscriber user role*/
function sb_remove_dashboard () {
    global $current_user, $menu, $submenu;
    get_currentuserinfo();

    if(  in_array( 'subscriber', $current_user->roles ) ) {
        reset( $menu );
        $page = key( $menu );
        while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
            $page = key( $menu );
        }
        if( __( 'Dashboard' ) == $menu[$page][0] ) {
            unset( $menu[$page] );
        }
        reset($menu);
        $page = key($menu);
        while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
            $page = key( $menu );
        }
        if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) &&
            ( 'index.php' != $menu[$page][2] ) ) {
                wp_redirect( get_option( 'siteurl' ) . '/wp-admin/edit.php');
        }
    }
}
add_action('admin_menu', 'sb_remove_dashboard');

// Register Custom Post Type
function news_post_type() {

	$labels = array(
		'name'                  => _x( 'News', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'News', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'News', 'text_domain' ),
		'name_admin_bar'        => __( 'News', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'News', 'text_domain' ),
		'description'           => __( 'News Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'News', $args );

}
add_action( 'init', 'news_post_type', 0 );

// Register Custom Post Type
function city_post_type() {

	$labels = array(
		'name'                  => _x( 'City', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'City', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'City', 'text_domain' ),
		'name_admin_bar'        => __( 'City', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'City', 'text_domain' ),
		'description'           => __( 'City Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'City', $args );

}
add_action( 'init', 'city_post_type', 0 );



// Register Custom Post Type
function city_sub_post_type() {

	$labels = array(
		'name'                  => _x( 'City Sub', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'City Sub', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'City Sub', 'text_domain' ),
		'name_admin_bar'        => __( 'City Sub', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'City Sub', 'text_domain' ),
		'description'           => __( 'City Sub Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments','custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'City_Sub', $args );

}
add_action( 'init', 'city_sub_post_type', 0 );




// Register Custom Post Type
function event_post_type() {

	$labels = array(
		'name'                  => _x( 'Event', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Event', 'text_domain' ),
		'name_admin_bar'        => __( 'Event', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Event', 'text_domain' ),
		'description'           => __( 'Event Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'event_post_type', $args );

}
add_action( 'init', 'event_post_type', 0 );



function event_dates_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function event_dates_add_meta_box() {
	add_meta_box(
		'event_dates-event-dates',
		__( 'Event Dates', 'event_dates' ),
		'event_dates_html',
		'event_post_type',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'event_dates_add_meta_box' );

function event_dates_html( $post) {
	wp_nonce_field( '_event_dates_nonce', 'event_dates_nonce' ); ?>

	<p>
		<label for="event_dates_date_of_event"><?php _e( 'Date Of Event', 'event_dates' ); ?></label><br>
		<input type="text" name="event_dates_date_of_event" id="event_dates_date_of_event" value="<?php echo event_dates_get_meta( 'event_dates_date_of_event' ); ?>">
	</p>	<p>
		<label for="event_dates_month_and_year_of_event"><?php _e( 'Month and Year Of Event', 'event_dates' ); ?></label><br>
		<input type="text" name="event_dates_month_and_year_of_event" id="event_dates_month_and_year_of_event" value="<?php echo event_dates_get_meta( 'event_dates_month_and_year_of_event' ); ?>">
	</p>
	
	<p>
		<label for="event_dates_day"><?php _e( 'Day', 'event_dates' ); ?></label><br>
		<input type="text" name="event_dates_day" id="event_dates_day" value="<?php echo event_dates_get_meta( 'event_dates_day' ); ?>">
	</p>
	
	
	
	<?php
}

function event_dates_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['event_dates_nonce'] ) || ! wp_verify_nonce( $_POST['event_dates_nonce'], '_event_dates_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['event_dates_date_of_event'] ) )
		update_post_meta( $post_id, 'event_dates_date_of_event', esc_attr( $_POST['event_dates_date_of_event'] ) );
	if ( isset( $_POST['event_dates_month_and_year_of_event'] ) )
		update_post_meta( $post_id, 'event_dates_month_and_year_of_event', esc_attr( $_POST['event_dates_month_and_year_of_event'] ) );
	if ( isset( $_POST['event_dates_day'] ) )
		update_post_meta( $post_id, 'event_dates_day', esc_attr( $_POST['event_dates_day'] ) );
}
add_action( 'save_post', 'event_dates_save' );

/*
	Usage: event_dates_get_meta( 'event_dates_date_of_event' )
	Usage: event_dates_get_meta( 'event_dates_month_and_year_of_event' )
	Usage: event_dates_get_meta( 'event_dates_day' )
*/

// Register Custom Post Type
function event_video_post_type() {

	$labels = array(
		'name'                  => _x( 'Event Video', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Event Video', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Event Video', 'text_domain' ),
		'name_admin_bar'        => __( 'Event Video', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Event Video', 'text_domain' ),
		'description'           => __( 'Event Video', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'event_video_type', $args );

}
add_action( 'init', 'event_video_post_type', 0 );
// Register Custom Post Type
function experience_post_type() {

	$labels = array(
		'name'                  => _x( 'Experience', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Experience', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Experience', 'text_domain' ),
		'name_admin_bar'        => __( 'Experience', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Experience', 'text_domain' ),
		'description'           => __( 'Experience Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'experience_post_type', $args );

}
add_action( 'init', 'experience_post_type', 0 );

// Add a custom user role

$result = add_role( 'Model', __(

'Model' ),

array(

'read' => true, // true allows this capability
'edit_posts' => true, // Allows user to edit their own posts
'edit_pages' => true, // Allows user to edit pages
'edit_others_posts' => true, // Allows user to edit others posts not just their own
'create_posts' => true, // Allows user to create new posts
'manage_categories' => true, // Allows user to manage post categories
'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
'edit_themes' => false, // false denies this capability. User can’t edit your theme
'install_plugins' => false, // User cant add new plugins
'update_plugin' => false, // User can’t update any plugins
'update_core' => false // user cant perform core updates

)

);
add_shortcode( 'VIPREG', 'vip_registration' ); 
function vip_registration( $atts ) {
	ob_start();
	global $wpdb;
	global $reg_errors;
	echo '<pre>';
	print_r($_POST);
	
	echo '</pre>';
	
	if ( isset( $_POST['gg'] ) ) {
		die('xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
        $post = array(
            'first_name' => $_POST['first_nameds'], 
            'post_title'   => $_POST['title']
        );
        $usernameds   =   sanitize_user( $_POST['usernameds'] );
        $password   =   esc_attr( $_POST['password'] );
        $emailds      =   sanitize_email( $_POST['emailds'] );
        $first_nameds =   sanitize_text_field( $_POST['first_nameds'] );
        $last_nameds  =   sanitize_text_field( $_POST['last_nameds'] );
        $age  =   sanitize_text_field( $_POST['age'] );
        $nationality  =   sanitize_text_field( $_POST['nationality'] );
        $address  =   sanitize_text_field( $_POST['address'] );
        $cityds  =   sanitize_text_field( $_POST['cityds'] );
        $zipcode  =   sanitize_text_field( $_POST['zipcode'] );
        $phone  =   sanitize_text_field( $_POST['phone'] );
        $mob_num  =   sanitize_text_field( $_POST['mob_num'] );
        $time_call  =   $_POST['time_call'];
        $explain  =   sanitize_text_field( $_POST['explain'] );
        $hot_spot  =   sanitize_text_field( $_POST['hot_spot'] );
        $toys  =   sanitize_text_field( $_POST['toys'] );
        $gateway  =   sanitize_text_field( $_POST['gateway'] );
        $mem_pln  =   $_POST['member_plans'];
		$total_plans  =   $_POST['total_plan'];
		
		 //~ if ( usernameds_exists( $usernameds ) ){
			  //~ echo $post['first_nameds'].'yyyyyyyyyyyyyyyyyy'.$lastid ;
			  //~ $userdata = array(
        //~ 'user_login'    =>   $usernameds,
        //~ 'user_email'    =>   $email,
        //~ 'user_pass'     =>   $password,
		//~ 'first_nameds'    =>   $first_nameds,
        //~ 'last_nameds'     =>   $last_nameds,
        
        //~ );
        
     
         //~ $userxx = wp_insert_user( $userdata );
         
          //~ $lastid = $wpdb->insert_id;
          
             //~ echo $post['first_nameds'].'yyyyyyyyyyyyyyyyyy'.$lastid ;
	  //~ }
       //~ else{
           //~ echo "Username Not In Use!";
            //~ echo $post['first_nameds'].'xxxxxxxxxxxxxxxx';
	   //~ }
     
     
     
$reg_errors = new WP_Error;
if ( empty( $usernameds ) || empty( $password ) || empty( $emailds ) ) {
    $reg_errors->add('field', 'Required form field is missing');
}
if ( 4 > strlen( $usernameds ) ) {
    $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
}
if ( username_exists( $usernameds ) )
{
    $reg_errors->add('user_name', 'Sorry, that usernameds already exists!');
}
if ( ! validate_username( $usernameds ) ) {
    $reg_errors->add( 'username_invalid', 'Sorry, the usernameds you entered is not valid' );
}
if ( 5 > strlen( $password ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5' );
    }
    if ( !is_email( $emailds ) ) {
    $reg_errors->add( 'email_invalid', 'Email is not valid' );
}
if ( email_exists( $emailds ) ) {
    $reg_errors->add( 'email', 'Email Already in use' );
}

echo count($reg_errors->get_error_messages()).'nnnnnnnnnnnnnnnnn';
 
    }
    ?> 
    <div class="container">
		<div class="vip-form-box">
    <form method = "post">
       <section id="vip-form" class="vip-form-div">
      <div class="vip-form-box-left clearfix">
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> First Name <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input name="first_nameds" placeholder="" value="" type="text"> </div>        
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Last Name <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" name="last_namedsds" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Age <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input name="age" placeholder="" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Nationality <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" name="nationality" value="" type="text"> </div>
       </li>
       
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Address: <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" name="address" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> City: </label> </div>
        <div class="vip-fields"> <input placeholder="" name="cityds" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Zip Code: </label> </div>
        <div class="vip-fields"> <input name="zipcode" placeholder="" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Desired Username: <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" name="usernameds" value="" type="text"> </div>
       </li>
	   <li class="vip-form-box-field">
        <div class="vip-label">
         <label> E-mail <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input name="emailds" placeholder="" value="" type="email"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Confirm E-mail <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input name="conemail" placeholder="" value="" type="email"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Password <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" type="password" name="password" value=""> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Confirm Password <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" type="password" name="conpassword" value="" type="password"> </div>
       </li>
       
      </div> 
      <div class="vip-form-box-right clearfix">
       
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Your phone number </label> </div>
        <div class="vip-fields"> <input placeholder="" name="phone" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Mobile phone number <span class="required">*</span> </label> </div>
        <div class="vip-fields"> <input placeholder="" name="mob_num" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> Best times to call: </label> </div>

         <div class="vip-fields"> 
           <select name="time_call" id="time_call">
             <option name="morning" value="morning">morning</option>
             <option name="afternoon" value="afternoon">afternoon</option>
             <option name="evening" value="evening">evening </option>
           </select> 
        </div>
		</li>
       <li class="vip-form-box-field">
        <div class="vip-label"> <label> If wish not be contacted </label> </div>
        <div class="vip-fields">
         <label> <input name="contacted_yes" value="" type="radio">Yes</label>
         <label> <input name="contacted_no" value="" type="radio">No</label>
        </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label"> <label> Membership <span class="required">*</span></label> </div>
        <div class="vip-fields"> 
           <select name="total_plan" id="total_plans">
             <option name="lavishpln" value="lavishpln" <?php if($pac_name == "lavishpln") echo "selected";?>>Lavish $150</option>
             <option name="sliverpln" value="sliverpln" <?php if($pac_name == "sliverpln") echo "selected";?>>Silver $100k</option>
             <option name="goldpln" value="goldpln" <?php if($pac_name == "goldpln") echo "selected";?>>Gold $250k</option>
             <option name="platinumpln" value="platinumpln" <?php if($pac_name == "platinumpln") echo "selected";?>>Platinum $500k</option>
             <option name="blackpln" value="blackpln" <?php if($pac_name == "blackpln") echo "selected";?>>Black $1mill</option>
           </select> 
        </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label"> <label>How often do you plan on booking your companion?  <span class="required">*</span></label> </div>
        <div class="vip-fields"> 
           <select name="member_plans" id="member_plan">
             <option name="dailypln" value="Daily">Daily</option>
             <option name="weeklypln" value="weekly">weekly</option>
             <option name="monthlypln" value="monthly">monthly</option>
             <option name="otherpln" value="other">other</option>
           </select> 
        </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> If other; please explain </label> </div>
        <div class="vip-fields"> <input placeholder="" name="explain" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> What are your favorite luxury hot spots? </label> </div>
        <div class="vip-fields"> <input placeholder="" name="hot_spot" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> What are your favorite luxyry toys? </label> </div>
        <div class="vip-fields"> <input placeholder="" name="toys" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label">
         <label> What would be your dream getaway? </label> </div>
        <div class="vip-fields"> <input placeholder="" name="gateway" value="" type="text"> </div>
       </li>
       <li class="vip-form-box-field">
        <div class="vip-label"> <label> Would you like to be notified when we have new models? </label> </div>
        <div class="vip-fields">
         <label> <input value="Yes" type="radio">Yes</label>
         <label> <input value="No" type="radio">No</label>
        </div>
       </li>
       <li class="vip-form-box-field mutliSelect-box">
        <div class="vip-label"> <label> Who would your favorite mates be?  </label> </div>
        <div class="vip-fields"> 
		   
		   <dl class="dropdown"> 
  
			<dt>
			<a href="javascript:void(0)">
			  <span class="hida">Select</span>    
			  <p class="multiSel"></p>  
			</a>
			</dt>
		  
			<dd>
				<div class="mutliSelect">
					<ul>
						<li>
						   <label><input type="checkbox" value="Yvonno" />Yvonno </label>
						<li>
							<label><input type="checkbox" value="Angelina" />Angelina</label>
						<li>
							<label><input type="checkbox" value="Angelina" />Angelina</label>
						<li>
							<label><input type="checkbox" value="Yvonno" />Yvonno</label>
						<li>
							<label><input type="checkbox" value="Angelina" />Angelina</label>
						<li>
						   <label> <input type="checkbox" value="Angelina" />Angelina</label>
					</ul>
				</div>
			</dd>
		</dl>
		   
		   
        </div>
       </li>
      </div> 
      <div class="vip-form-text-textarea clearfix">
        <li class="vip-form-box-field-textarea">
        <div class="vip-label"> <label> Why become a member? </label> </div>
        <div class="vip-fields">
         <textarea placeholder="" rows="3" cols="20"></textarea>
        </div>
       </li>
      </div>
      
      <div class="vip-form-submit-btn clearfix">
       <input type="submit" name="submit" value="Register"/>
         <input type="submit" name="gg">
      </div>
   </div>
 </div>
</section>
  </div>
 </div>
      
    </form>
    <?php
return ob_get_clean();
}
// Register Custom Post Type
function vip_account() {

	$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Vip Account', 'text_domain' ),
		'name_admin_bar'        => __( 'Vip Account', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Post Type', 'text_domain' ),
		'description'           => __( 'Vip Account Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'vip_account', $args );

}
add_action( 'init', 'vip_account', 0 );



function vip_account_deatils_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function vip_account_deatils_add_meta_box() {
	add_meta_box(
		'vip_account_deatils-vip-account-deatils',
		__( 'Vip Account Deatils', 'vip_account_deatils' ),
		'vip_account_deatils_html',
		'vip_account',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'vip_account_deatils_add_meta_box' );

function vip_account_deatils_html( $post) {
	wp_nonce_field( '_vip_account_deatils_nonce', 'vip_account_deatils_nonce' ); ?>

	<p>
		<label for="vip_account_deatils_first_name"><?php _e( 'First Name', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_first_name" id="vip_account_deatils_first_name" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_first_name' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_last_name"><?php _e( 'Last Name', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_last_name" id="vip_account_deatils_last_name" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_last_name' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_age"><?php _e( 'Age', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_age" id="vip_account_deatils_age" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_age' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_nationality"><?php _e( 'Nationality', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_nationality" id="vip_account_deatils_nationality" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_nationality' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_address"><?php _e( 'Address', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_address" id="vip_account_deatils_address" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_address' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_city"><?php _e( 'City', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_city" id="vip_account_deatils_city" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_city' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_zip_code"><?php _e( 'Zip Code', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_zip_code" id="vip_account_deatils_zip_code" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_zip_code' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_user_name"><?php _e( 'User Name', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_user_name" id="vip_account_deatils_user_name" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_user_name' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_e_mail"><?php _e( 'E-mail', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_e_mail" id="vip_account_deatils_e_mail" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_e_mail' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_password"><?php _e( 'Password', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_password" id="vip_account_deatils_password" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_password' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_phone_number"><?php _e( 'Phone number', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_phone_number" id="vip_account_deatils_phone_number" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_phone_number' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_mobile_phone_number"><?php _e( 'Mobile phone number', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_mobile_phone_number" id="vip_account_deatils_mobile_phone_number" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_mobile_phone_number' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_best_times_to_call"><?php _e( 'Best times to call', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_best_times_to_call" id="vip_account_deatils_best_times_to_call" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_best_times_to_call' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_if_wish_not_be_contacted"><?php _e( 'If wish not be contacted', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_if_wish_not_be_contacted" id="vip_account_deatils_if_wish_not_be_contacted" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_if_wish_not_be_contacted' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_membership"><?php _e( 'Membership', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_membership" id="vip_account_deatils_membership" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_membership' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_"><?php _e( 'How often do you plan on booking your companion?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_" id="vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_if_other_please_explain"><?php _e( 'If other; please explain', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_if_other_please_explain" id="vip_account_deatils_if_other_please_explain" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_if_other_please_explain' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_what_are_your_favorite_luxury_hot_spots_"><?php _e( 'What are your favorite luxury hot spots?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_what_are_your_favorite_luxury_hot_spots_" id="vip_account_deatils_what_are_your_favorite_luxury_hot_spots_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_what_are_your_favorite_luxury_hot_spots_' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_what_are_your_favorite_luxyry_toys_"><?php _e( 'What are your favorite luxyry toys?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_what_are_your_favorite_luxyry_toys_" id="vip_account_deatils_what_are_your_favorite_luxyry_toys_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_what_are_your_favorite_luxyry_toys_' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_what_would_be_your_dream_getaway_"><?php _e( 'What would be your dream getaway?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_what_would_be_your_dream_getaway_" id="vip_account_deatils_what_would_be_your_dream_getaway_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_what_would_be_your_dream_getaway_' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_"><?php _e( 'Would you like to be notified when we have new models?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_" id="vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_who_would_your_favorite_mates_be_"><?php _e( 'Who would your favorite mates be?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_who_would_your_favorite_mates_be_" id="vip_account_deatils_who_would_your_favorite_mates_be_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_who_would_your_favorite_mates_be_' ); ?>">
	</p>	<p>
		<label for="vip_account_deatils_why_become_a_member_"><?php _e( 'Why become a member?', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_why_become_a_member_" id="vip_account_deatils_why_become_a_member_" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_why_become_a_member_' ); ?>">
	</p>
	
	<p>
		<label for="vip_account_deatils_payment_status"><?php _e( 'Payment Status', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_payment_status" id="vip_account_deatils_payment_status" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_payment_status' ); ?>">
	</p>
	<p>
		<label for="vip_account_deatils_cc"><?php _e( 'Card Number', 'vip_account_deatils' ); ?></label><br>
		<input type="text" name="vip_account_deatils_cc" id="vip_account_deatils_cc" value="<?php echo vip_account_deatils_get_meta( 'vip_account_deatils_cc' ); ?>">
	</p>
	
	
	<?php
}

function vip_account_deatils_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['vip_account_deatils_nonce'] ) || ! wp_verify_nonce( $_POST['vip_account_deatils_nonce'], '_vip_account_deatils_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['vip_account_deatils_first_name'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_first_name', esc_attr( $_POST['vip_account_deatils_first_name'] ) );
	if ( isset( $_POST['vip_account_deatils_last_name'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_last_name', esc_attr( $_POST['vip_account_deatils_last_name'] ) );
	if ( isset( $_POST['vip_account_deatils_age'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_age', esc_attr( $_POST['vip_account_deatils_age'] ) );
	if ( isset( $_POST['vip_account_deatils_nationality'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_nationality', esc_attr( $_POST['vip_account_deatils_nationality'] ) );
	if ( isset( $_POST['vip_account_deatils_address'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_address', esc_attr( $_POST['vip_account_deatils_address'] ) );
	if ( isset( $_POST['vip_account_deatils_city'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_city', esc_attr( $_POST['vip_account_deatils_city'] ) );
	if ( isset( $_POST['vip_account_deatils_zip_code'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_zip_code', esc_attr( $_POST['vip_account_deatils_zip_code'] ) );
	if ( isset( $_POST['vip_account_deatils_user_name'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_user_name', esc_attr( $_POST['vip_account_deatils_user_name'] ) );
	if ( isset( $_POST['vip_account_deatils_e_mail'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_e_mail', esc_attr( $_POST['vip_account_deatils_e_mail'] ) );
	if ( isset( $_POST['vip_account_deatils_password'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_password', esc_attr( $_POST['vip_account_deatils_password'] ) );
	if ( isset( $_POST['vip_account_deatils_phone_number'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_phone_number', esc_attr( $_POST['vip_account_deatils_phone_number'] ) );
	if ( isset( $_POST['vip_account_deatils_mobile_phone_number'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_mobile_phone_number', esc_attr( $_POST['vip_account_deatils_mobile_phone_number'] ) );
	if ( isset( $_POST['vip_account_deatils_best_times_to_call'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_best_times_to_call', esc_attr( $_POST['vip_account_deatils_best_times_to_call'] ) );
	if ( isset( $_POST['vip_account_deatils_if_wish_not_be_contacted'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_if_wish_not_be_contacted', esc_attr( $_POST['vip_account_deatils_if_wish_not_be_contacted'] ) );
	if ( isset( $_POST['vip_account_deatils_membership'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_membership', esc_attr( $_POST['vip_account_deatils_membership'] ) );
	if ( isset( $_POST['vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_', esc_attr( $_POST['vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_'] ) );
	if ( isset( $_POST['vip_account_deatils_if_other_please_explain'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_if_other_please_explain', esc_attr( $_POST['vip_account_deatils_if_other_please_explain'] ) );
	if ( isset( $_POST['vip_account_deatils_what_are_your_favorite_luxury_hot_spots_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_what_are_your_favorite_luxury_hot_spots_', esc_attr( $_POST['vip_account_deatils_what_are_your_favorite_luxury_hot_spots_'] ) );
	if ( isset( $_POST['vip_account_deatils_what_are_your_favorite_luxyry_toys_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_what_are_your_favorite_luxyry_toys_', esc_attr( $_POST['vip_account_deatils_what_are_your_favorite_luxyry_toys_'] ) );
	if ( isset( $_POST['vip_account_deatils_what_would_be_your_dream_getaway_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_what_would_be_your_dream_getaway_', esc_attr( $_POST['vip_account_deatils_what_would_be_your_dream_getaway_'] ) );
	if ( isset( $_POST['vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_', esc_attr( $_POST['vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_'] ) );
	if ( isset( $_POST['vip_account_deatils_who_would_your_favorite_mates_be_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_who_would_your_favorite_mates_be_', esc_attr( $_POST['vip_account_deatils_who_would_your_favorite_mates_be_'] ) );
	if ( isset( $_POST['vip_account_deatils_why_become_a_member_'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_why_become_a_member_', esc_attr( $_POST['vip_account_deatils_why_become_a_member_'] ) );
	if ( isset( $_POST['vip_account_deatils_payment_status'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_payment_status', esc_attr( $_POST['vip_account_deatils_payment_status'] ) );
	
	if ( isset( $_POST['vip_account_deatils_cc'] ) )
		update_post_meta( $post_id, 'vip_account_deatils_cc', esc_attr( $_POST['vip_account_deatils_cc'] ) );


}
add_action( 'save_post', 'vip_account_deatils_save' );

/*
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_first_name' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_last_name' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_age' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_nationality' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_address' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_city' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_zip_code' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_user_name' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_e_mail' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_password' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_phone_number' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_mobile_phone_number' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_best_times_to_call' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_if_wish_not_be_contacted' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_membership' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_how_often_do_you_plan_on_booking_your_companion_' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_if_other_please_explain' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_what_are_your_favorite_luxury_hot_spots_' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_what_are_your_favorite_luxyry_toys_' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_what_would_be_your_dream_getaway_' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_would_you_like_to_be_notified_when_we_have_new_models_' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_who_would_your_favorite_mates_be_' )
	Usage: vip_account_deatils_get_meta( 'vip_account_deatils_why_become_a_member_' )
*/
add_action( 'widgets_init', 'lavish_sidebar_widgets' );
function lavish_sidebar_widgets() {
    register_sidebar( array(
        'name' => __( 'Lavish Tag Widget', 'lavish' ),
        'id' => 'lavish-tag-widget',
        'description' => __( 'Widget to display tags', 'lavish' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}
