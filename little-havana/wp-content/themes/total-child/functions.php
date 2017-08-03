<?php
add_filter( 'automatic_updater_disabled', '__return_true' );
function total_theme_enqueue_styles() {
	$parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	
	wp_enqueue_style( 'res-style', get_stylesheet_directory_uri() . '/responsive.css');
}
add_action( 'wp_enqueue_scripts', 'total_theme_enqueue_styles' );


//custom post type for Portfolios
function sb_total_cpt_posttype() {
    register_post_type( 'total_bar',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Bars' ),
                'singular_name' => __( 'Bar' )
                ),
            'public' => true,
            'has_archive' => true,
			'menu_icon' => get_stylesheet_directory_uri().'/images/bar-icon.png',
            'rewrite' => array('slug' => 'total_bar'),
            'supports' => array( 'title', 'thumbnail', 'editor' ),
            )
        );
		
		register_post_type( 'total_events',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Event' )
                ),
            'public' => true,
            'has_archive' => true,
			'menu_icon' => get_stylesheet_directory_uri().'/images/event-icon.png',
            'rewrite' => array('slug' => 'total_events'),
            'supports' => array( 'title', 'thumbnail','editor' ),
            )
        );
		
		register_post_type( 'total_tours',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Tours' ),
                'singular_name' => __( 'Tour' )
                ),
            'public' => true,
            'has_archive' => true,
			'menu_icon' => get_stylesheet_directory_uri().'/images/tours-icon.png',
            'rewrite' => array('slug' => 'total_tours'),
            'supports' => array( 'title', 'thumbnail', 'editor' ),
            )
        );
		
		register_post_type( 'total_bachelor_party',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Bachelor Parties' ),
                'singular_name' => __( 'Bachelor Party' )
                ),
            'public' => true,
            'has_archive' => true,
			'menu_icon' => get_stylesheet_directory_uri().'/images/bach-party-icon.png',
            'rewrite' => array('slug' => 'total_bachelor_party'),
            'supports' => array( 'title', 'thumbnail','editor' ),
            )
        );
}
add_action( 'init', 'sb_total_cpt_posttype' );



/*--write your code above this end tag--*/?>