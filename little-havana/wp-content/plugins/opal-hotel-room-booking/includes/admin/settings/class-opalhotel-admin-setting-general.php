<?php
/**
 * @Author: brainos
 * @Date:   2016-04-23 23:05:04
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-15 00:56:22
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'OpalHotel_Admin_Setting_General' ) ) {

	class OpalHotel_Admin_Setting_General extends OpalHotel_Admin_Setting_Page {

		public $id = 'general';

		public $title = null;

		function __construct() {

			$this->title = __( 'General', 'opal-hotel-room-booking' );

			parent::__construct();
		}

		/* setting fields */
		public function get_settings() {
			return apply_filters( 'opalhotel_admin_setting_fields_' . $this->id, array(

					array(
							'type'		=> 'section_start',
							'id'		=> 'general_settings',
							'title'		=> __( 'Page Settings', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Pages default of system.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'select_page',
							'id'		=> 'opalhotel_reservation_page_id',
							'title'		=> __( 'Reservation Page', 'opal-hotel-room-booking' )
						),

					// array(
					// 		'type'		=> 'select_page',
					// 		'id'		=> 'opalhotel_available_page_id',
					// 		'title'		=> __( 'Check Available Page', 'opal-hotel-room-booking' ),
					// 		'desc'		=> __( 'Available results', 'opal-hotel-room-booking' )
					// 	),

					// array(
					// 		'type'		=> 'select_page',
					// 		'id'		=> 'opalhotel_cart_page_id',
					// 		'title'		=> __( 'Cart Review', 'opal-hotel-room-booking' ),
					// 		'desc'		=> __( 'Review room selected', 'opal-hotel-room-booking' )
					// 	),

					// array(
					// 		'type'		=> 'select_page',
					// 		'id'		=> 'opalhotel_account_page_id',
					// 		'title'		=> __( 'Account Page', 'opal-hotel-room-booking' )
					// 	),

					array(
							'type'		=> 'select_page',
							'id'		=> 'opalhotel_terms_page_id',
							'title'		=> __( 'Terms And Conditions Page', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_terms_require',
							'title'		=> __( 'Term require', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'general_settings'
						),

					array(
							'type'		=> 'section_start',
							'id'		=> 'reservation_settings',
							'title'		=> __( 'Resevation Settings', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Resevation default of system.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'number',
							'id'		=> 'opalhotel_search_available_max_adult',
							'title'		=> __( 'Max Adult Available Search', 'opal-hotel-room-booking' ),
							'default'	=> '',
							'min'		=> 0,
							'step'		=> 1
						),

					array(
							'type'		=> 'number',
							'id'		=> 'opalhotel_search_available_max_child',
							'title'		=> __( 'Max Children Available Search', 'opal-hotel-room-booking' ),
							'default'	=> '',
							'min'		=> 0,
							'step'		=> 1
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'reservation_settings'
						),

					array(
							'type'		=> 'section_start',
							'id'		=> 'currency_settings',
							'title'		=> __( 'Currency Settings', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'The following options affect how prices are displayed on the frontend.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'select',
							'id'		=> 'opalhotel_currency',
							'desc'		=> __( 'This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.', 'opal-hotel-room-booking' ),
							'title'		=> __( 'Currency', 'opal-hotel-room-booking' ),
							'options'	=> opalhotel_currencies(),
							'default'	=> 'USD'
						),

					array(
							'type'		=> 'select',
							'id'		=> 'opalhotel_price_currency_position',
							'desc'		=> __( 'The following options affect how prices are displayed on the frontend.', 'opal-hotel-room-booking' ),
							'title'		=> __( 'Currency Position', 'opal-hotel-room-booking' ),
							'options'	=> array(
									'left'		=> __('Left ( $69.99 )', 'opal-hotel-room-booking'),
									'right'		=> __('Right ( 69.99$ )', 'opal-hotel-room-booking'),
									'left_with_space'	=> __('Left with space ( $ 69.99 )', 'opal-hotel-room-booking'),
									'right_with_space'	=> __('Right with space ( 69.99 $ )', 'opal-hotel-room-booking')
								),
							'default'	=> 'left'
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_price_thousands_separator',
							'title'		=> __( 'Thousands Separator', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'This sets the thousand separator of displayed prices.', 'opal-hotel-room-booking' ),
							'default'	=> ','
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_price_decimals_separator',
							'title'		=> __( 'Decimals Separator', 'opal-hotel-room-booking' ),
							'desc'     => __( 'This sets the decimal separator of displayed prices.', 'opal-hotel-room-booking' ),
							'default'	=> '.'
						),

					array(
							'type'		=> 'number',
							'id'		=> 'opalhotel_price_number_of_decimal',
							'title'		=> __( 'Number of decimal', 'opal-hotel-room-booking' ),
							'desc'     => __( 'This sets the number of decimal points shown in displayed prices.', 'opal-hotel-room-booking' ),
							'default'	=> 1,
							'min'		=> 0,
							'max'		=> 3,
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'currency_settings'
						),
				) );
		}

	}

}

return new OpalHotel_Admin_Setting_General();