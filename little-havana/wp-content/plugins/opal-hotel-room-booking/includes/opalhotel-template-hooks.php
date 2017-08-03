<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

function opalhotel_room_set_display_mode(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'opalhotel_display', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['opalhotel_display'] = trim($_GET['display']);
	}
}

add_action( 'init', 'opalhotel_room_set_display_mode' );

function opalhotel_room_display_mode(){
	if ( isset($_COOKIE['opalhotel_display']) && $_COOKIE['opalhotel_display'] == 'list' ) {  
		return 'room-list';
	}
	return 'room';
}

function opalhotel_loop_display_mode(){
	if ( isset($_COOKIE['opalhotel_display']) && $_COOKIE['opalhotel_display'] == 'list' ) {  
		return 'list';
	}
	return 'grid';
}

add_filter( 'opalhotel_room_display_mode' , 'opalhotel_room_display_mode' );
add_action( 'opalhotel_before_room_loop', 'opalhotel_display_modes' , 10 );

add_action( 'opalhotel_after_process_step', 'opalhotel_after_process_step', 10, 1 );
add_action( 'opalhotel_reservation_step', 'opalhotel_reservation_step', 10, 1 );
// add_action( 'opalhotel_reservation_reviews', 'opalhotel_reservation_reviews', 10 ); // this hook has been removed
/**
 * opalhotel_setup_shorcode_content
 * setup shortcode
 */
add_filter( 'the_content', 'opalhotel_setup_shorcode_content' );
/**
 * the_post opalhotel_template_setup_room
 * post_class
 */
add_action( 'the_post', 'opalhotel_template_setup_room' );
add_filter( 'body_class', 'opalhotel_template_setup_body_class' );
add_filter( 'post_class', 'opalhotel_template_setup_post_class' );

/**
 * Room Summary Box.
 *
 * opalhotel_template_single_title()
 * opalhotel_template_single_price()
 */
add_action( 'opalhotel_single_room_main', 'opalhotel_template_single_title', 5 );
add_action( 'opalhotel_single_room_main', 'opalhotel_template_single_price', 10 );
add_action( 'opalhotel_single_room_main', 'opalhotel_template_single_gallery', 15 );

/*
 * opalhotel_single_room_main hook
 */
add_action( 'opalhotel_single_room_main', 'opalhotel_single_room_details', 20 );
add_action( 'opalhotel_after_main_content', 'opalhotel_single_related_room', 20 );

/*
 * opalhotel_content_single_room_details hook
 */
add_action( 'opalhotel_content_single_room_details', 'opalhotel_single_room_attribute', 5 );
add_action( 'opalhotel_content_single_room_details', 'opalhotel_single_room_description', 10 );

/*
 * opalhotel_before_after_room_reviews hook
 */
add_action( 'opalhotel_single_room_main', 'opalhotel_single_room_pricing_plan', 40 );

/// add_action( 'opalhotel_before_after_room_reviews', 'opalhotel_single_reservation_form', 5 );

/**
 * archive - taxonomy
 */
add_action( 'opalhotel_archive_loop_item_thumbnail', 'opalhotel_loop_item_thumbnail', 5 );
add_action( 'opalhotel_after_room_loop', 'opalhotel_archive_pagination', 5 );

/**
 * archive - taxonomy
 * content-room template
 * opalhotel_archive_loop_item_title
 */
add_action( 'opalhotel_archive_loop_item_title', 'opalhotel_loop_item_title', 5 );

/**
 * opalhotel_archive_loop_item_description hook
 * opalhotel_loop_item_description()
 */
add_action( 'opalhotel_archive_loop_item_description', 'opalhotel_loop_item_description', 5 );

add_action( 'opalhotel_archive_loop_item_list_description', 'opalhotel_loop_item_description', 5 );

/**
 * opalhotel_loop_item_price hook
 * opalhotel_loop_item_price()
 */
add_action( 'opalhotel_archive_loop_item_detail', 'opalhotel_loop_item_details', 5 );

/**
 * opalhotel_loop_item_price hook
 * opalhotel_loop_item_price()
 */
add_action( 'opalhotel_archive_loop_item_price', 'opalhotel_loop_item_price', 5 );

/* ORDER RECEIVED */
add_action( 'opalhotel_reservation_order_confirm', 'opalhotel_reservation_order_confirm_template' );
add_action( 'opalhotel_reservation_order_details', 'opalhotel_reservation_order_details_template' );
add_action( 'opalhotel_reservation_customer_details', 'opalhotel_reservation_customer_details_template' );
/* END ORDER RECEIVED */

/**
 * Hotel Loop content-hotel.php
 */
add_action( 'opalhotel_hotel_loop_item_thumbnail', 'opalhotel_hotel_loop_item_thumbnail', 5 );
add_action( 'opalhotel_hotel_loop_item_title', 'opalhotel_hotel_loop_item_title', 5 );
add_action( 'opalhotel_hotel_loop_item_description', 'opalhotel_hotel_loop_item_description', 5 );
add_action( 'opalhotel_hotel_loop_item_view_details', 'opalhotel_hotel_loop_item_view_details', 5 );
/**
 * End Hotel Loop content-hotel.php
 */

/**
 * Single Hotel
 */
add_action( 'opalhotel_single_hotel_main', 'opalhotel_single_hotel_title', 5 );
add_action( 'opalhotel_single_hotel_main', 'opalhotel_single_hotel_gallery', 10 );
add_action( 'opalhotel_single_hotel_main', 'opalhotel_single_hotel_description', 15 );
add_action( 'opalhotel_single_hotel_main', 'opalhotel_single_hotel_rooms', 20 );
/**
 * End Single Hotel
 */

/* TEMPLATE JS */
add_action( 'wp_footer', 'opalhotel_template_alert_underscore' );