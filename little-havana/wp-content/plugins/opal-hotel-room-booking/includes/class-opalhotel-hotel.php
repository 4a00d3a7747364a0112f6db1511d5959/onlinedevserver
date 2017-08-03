<?php
/**
 * @Author: brainos
 * @Date:   2016-04-28 20:40:37
 * @Last Modified by:   someone
 * @Last Modified time: 2016-12-16 22:59:32
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Hotel extends OpalHotel_Abstract_Service {

	/* $id property */
	public $id = null;

	// instance insteadof new class
	static $instance = null;

	/* constructor set object data */
	public function __construct( $id = null ) {
		parent::__construct( $id );
	}

	/* get galleries full image */
	public function get_gallery_image_item( $id = null ) {
		return wp_get_attachment_image( $id, 'room_gallery', true );
	}

	/* get galleries url image */
	public function get_gallery_image_item_url( $id = null ) {
		$src = wp_get_attachment_image_src( $id, 'room_gallery', true );
		return $src[0];
	}

	/* get galleries thumb image */
	public function get_gallery_thumb_item( $id = null ) {
		return wp_get_attachment_image( $id, 'room_thumb', true );
	}

	/* get catalog thumbnail */
	public function get_catalog_thumbnail() {
		$attachment_id = get_post_thumbnail_id( $this->id );
		return get_the_post_thumbnail( $this->id, 'room_catalog', true );
	}

	public function get_rooms( $number = 5 ) {
		$args = array(
				'post_type'			=> 'opalhotel_room',
				'post_status'		=> 'publish',
				'posts_per_page'	=> $number,
				'meta_key'			=> '_hotel',
				'meta_value'		=> $this->id
			);
		return new WP_Query( apply_filters( 'opalhotel_get_hotel_rooms', $args ) );
	}

	/**
	 * instance insteadof new class
	 * @param  $hotel optional Eg: id, object
	 * @return object
	 */
	public static function instance( $hotel = null ) {
		$id = null;
		if ( $hotel instanceof WP_POST ) {
			$id = $hotel->ID;
		} else if ( is_numeric( $hotel ) ) {
			$id = $hotel;
		} else if ( is_object( $hotel ) && isset( $hotel->ID ) ) {
			$id = $hotel->ID;
		}

		if ( empty( self::$instance[ $id ] ) ) {
			self::$instance[ $id ] = new self( $id );
		}

		return self::$instance[ $id ];

	}

}
