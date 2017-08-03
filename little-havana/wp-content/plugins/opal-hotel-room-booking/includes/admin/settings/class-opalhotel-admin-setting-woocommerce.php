<?php
/**
 * @Author: brainos
 * @Date:   2016-04-25 23:47:24
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-14 21:53:50
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'OpalHotel_Admin_Setting_WooCommercer' ) ) {

	class OpalHotel_Admin_Setting_WooCommercer extends OpalHotel_Admin_Setting_Page {

		public $id = 'woocommerce';

		public $title = null;

		function __construct() {

			$this->title = __( 'WooCommerce', 'opal-hotel-room-booking' );

			parent::__construct();
		}

		public function get_settings() {
			return apply_filters( 'opalhotel_admin_setting_fields_' . $this->id, array(

					array(
							'type'		=> 'section_start',
							'id'		=> 'woocommercer_general_setting',
							'title'			=> __( 'WooCommerce payment', 'opal-hotel-room-booking' ),
							'desc'			=> __( 'WooCommerce payment gateways.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_enable_woo_payment',
							'title'		=> __( 'Enable', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Enable woocommerce payment', 'opal-hotel-room-booking' ),
							'default'	=> 12,
							'min'		=> 1,
						),
					array(
							'type'		=> 'section_end',
							'id'		=> 'woocommercer_general_setting'
						)

				) );
		}

	}

}

return new OpalHotel_Admin_Setting_WooCommercer();