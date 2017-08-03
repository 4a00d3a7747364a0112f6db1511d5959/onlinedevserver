<?php
/**
 * @Author: brainos
 * @Date:   2016-04-23 22:50:16
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-04-29 22:44:17
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/* admin settings tabs */
if ( ! function_exists( 'opalhotel_admin_settings_tabs' ) ) {

	function opalhotel_admin_settings_tabs() {
		return apply_filters( 'opalhotel_admin_settings_tabs', array() );
	}
}

if ( ! function_exists( 'opalhotel_room_placeholder_image' ) ) {
	function opalhotel_room_placeholder_image() {
		$depend = opalhotel_get_image_size( 'room_thumb' );
		return apply_filters( 'opalhotel_room_placeholder_image', '<img src="'.opalhotel_room_placeholder_image_src().'" alt="'.esc_attr__( 'Placeholder', 'opal-hotel-room-booking' ).'" width="'.$depend['width'].'" height="'.$depend['width'].'" />', $depend );
	}
}

if ( ! function_exists( 'opalhotel_get_image_size' ) ) {
	/* get image size */
	function opalhotel_get_image_size( $image_size ) {
		if ( is_array( $image_size ) ) {
			$width  = isset( $image_size[0] ) ? $image_size[0] : '300';
			$height = isset( $image_size[1] ) ? $image_size[1] : '300';
			$crop   = isset( $image_size[2] ) ? $image_size[2] : 1;

			$size = array(
				'width'  => $width,
				'height' => $height,
				'crop'   => $crop
			);

			$image_size = $width . '_' . $height;

		} elseif ( in_array( $image_size, array( 'room_thumb', 'room_catalog', 'room_gallery' ) ) ) {
			$size           = get_option( $image_size . '_image_size', array() );
			$size['width']  = isset( $size['width'] ) ? $size['width'] : '300';
			$size['height'] = isset( $size['height'] ) ? $size['height'] : '300';
			$size['crop']   = isset( $size['crop'] ) ? $size['crop'] : 0;

		} else {
			$size = array(
				'width'  => '300',
				'height' => '300',
				'crop'   => 1
			);
		}

		return apply_filters( 'opalhotel_get_image_size_' . $image_size, $size );
	}
}

if ( ! function_exists( 'opalhotel_room_placeholder_image_src' ) ) {

	/* placholder room image */
	function opalhotel_room_placeholder_image_src() {
		return apply_filters( 'opalhotel_room_placeholder_image_src', OPALHOTEL_URI . '/assets/images/placeholder.png' );
	}
}
