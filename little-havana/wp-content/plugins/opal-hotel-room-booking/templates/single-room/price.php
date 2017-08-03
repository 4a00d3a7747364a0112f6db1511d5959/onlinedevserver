<?php
/**
 * The template for displaying room content within single
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/single-room/price.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

global $opalhotel_room;
?>

<div class="opalhotel-price">
	<span class="price-value"><?php printf( __( '%s', 'opal-hotel-room-booking' ), opalhotel_format_price( $opalhotel_room->base_price() ) ) ?></span>
	<span class="price-title"><?php _e( 'From', 'opal-hotel-room-booking' ); ?></span> / <span class="price-unit"><?php _e( ' per night', 'opal-hotel-room-booking' ) ?></span>
</div>
