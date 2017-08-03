<?php
/**
 * @Author: brainos
 * @Date:   2016-04-28 21:09:07
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-04-29 22:34:40
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}


if ( ! class_exists( 'OpalHotel_Admin_Setting_Room' ) ) {

	class OpalHotel_Admin_Setting_Room extends OpalHotel_Admin_Setting_Page {

		public $id = 'room';

		public $title = null;

		function __construct() {

			$this->title = __( 'Rooms', 'opal-hotel-room-booking' );

			parent::__construct();
		}

		public function get_settings() {
			return apply_filters( 'opalhotel_admin_setting_fields_' . $this->id, array(

					array(
							'type'		=> 'section_start',
							'id'		=> 'room_setting',
							'title'		=> __( 'Room Images', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Appear image size on the frontend.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'image_size',
							'id'		=> 'opalhotel_room_catalog_image_size',
							'title'		=> __( 'Catalog Image', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Set thumbnail image size on search results, archive, taxonomy page.', 'opal-hotel-room-booking' ),
							'options'	=> array(
									'width'		=> 360,
									'height'	=> 360
								),
							'default'	=> array(
									'width'		=> 360,
									'height'	=> 360
								)
						),

					// array(
					// 		'type'		=> 'image_size',
					// 		'id'		=> 'opalhotel_room_gallery',
					// 		'title'		=> __( 'Room Gallery Image', 'opal-hotel-room-booking' ),
					// 		'desc'		=> __( 'Set full image size on single room page.', 'opal-hotel-room-booking' ),
					// 		'options'	=> array(
					// 				'width'		=> 850,
					// 				'height'	=> 550
					// 			),
					// 		'default'	=> array(
					// 				'width'		=> 850,
					// 				'height'	=> 550
					// 			)
					// 	),

					array(
							'type'		=> 'image_size',
							'id'		=> 'opalhotel_room_thumbnail',
							'title'		=> __( 'Room Thumbnail Gallery Image', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Set thumbnail image size on single room page.', 'opal-hotel-room-booking' ),
							'options'	=> array(
									'width'		=> 84,
									'height'	=> 84
								),
							'default'	=> array(
									'width'		=> 84,
									'height'	=> 84
								)
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_room_lightbox_enable',
							'title'		=> __( 'Enable Lightbox Search Results', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Allows customers view gallery of room.', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'room_setting'
						),

					array(
							'type'		=> 'section_start',
							'id'		=> 'room_review',
							'title'		=> __( 'Review', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Enable review on single room.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_enabled_rating',
							'title'		=> __( 'Enable Review and rating', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Allows customers add comment and rating room.', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_enabled_require_rating',
							'title'		=> __( 'Require rating to post review.', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'room_review'
						),

				) );
		}

	}

}

return new OpalHotel_Admin_Setting_Room();