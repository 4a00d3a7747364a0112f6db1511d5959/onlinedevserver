<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/* set global */
global $opalhotel_shortcodes;

$opalhotel_shortcodes = array();
$opalhotel_shortcodes['rooms'] = new OpalHotel_Shortcode_Rooms();
$opalhotel_shortcodes['checkout'] = new OpalHotel_Shortcode_Checkout();
$opalhotel_shortcodes['availalbe'] = new OpalHotel_Shortcode_Available();
$opalhotel_shortcodes['reservation'] = new OpalHotel_Shortcode_Reservation();
$opalhotel_shortcodes['mini_cart'] = new OpalHotel_Shortcode_Mini_Cart();
$opalhotel_shortcodes['hotel_info'] = new OpalHotel_Shortcode_Hotel_Info();
$opalhotel_shortcodes['hotels'] = new OpalHotel_Shortcode_Hotels();
$opalhotel_shortcodes['single-book-room'] = new OpalHotel_Shortcode_Single_Book_Room();

return $opalhotel_shortcodes;