<?php
/**
 * @Author: brainos
 * @Date:   2016-04-25 23:24:31
 * @Last Modified by:   opalhotel_remove_extra
 * @Last Modified time: 2016-04-27 22:52:57
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'OpalHotel_Admin_Setting_Hotel' ) ) {

	class OpalHotel_Admin_Setting_Hotel extends OpalHotel_Admin_Setting_Page {

		public $id = 'hotel';

		public $title = null;

		function __construct() {

			$this->title = __( 'Hotel', 'opal-hotel-room-booking' );

			parent::__construct();
		}

		/* setting fields */
		public function get_settings() {
			return apply_filters( 'opalhotel_admin_setting_fields_' . $this->id, array(

					array(
							'type'			=> 'section_start',
							'id'			=> 'opalhotel_infomation',
							'title'			=> __( 'Your hotel information','opal-hotel-room-booking' ),
							'desc'			=> __( 'Setup your hotel imformation, maybe attach when customer recive image.' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_name',
							'title'			=> __( 'Hotel Name', 'opal-hotel-room-booking' ),
							'default'		=> 'OpalHotel',
							'desc'     		=> __( 'This sets hotel name email infomation.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_address',
							'title'			=> __( 'Hotel Address', 'opal-hotel-room-booking' ),
							'default'		=> 'Ha Noi',
							'desc'     		=> __( 'This sets hotel address.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_city',
							'title'		=> __( 'City', 'opal-hotel-room-booking' ),
							'default'		=> 'Ha Noi',
							'desc'     		=> __( 'This sets hotel city.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_state',
							'title'		=> __( 'State', 'opal-hotel-room-booking' ),
							'default'		=> 'Hanoi Daewoo Hotel',
							'desc'     		=> __( 'This sets hotel state.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_country',
							'title'			=> __( 'Country', 'opal-hotel-room-booking' ),
							'default'		=> 'Vietnam',
							'desc'     		=> __( 'This sets hotel country.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_zip_code',
							'title'			=> __( 'Zip / Postal Code', 'opal-hotel-room-booking' ),
							'default'		=> 10000,
							'desc'     		=> __( 'This sets hotel Zip / Postal Code.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_phone_number',
							'title'			=> __( 'Phone Number', 'opal-hotel-room-booking' ),
							'default'		=> '0123456789',
							'desc'     		=> __( 'This sets hotel\'s phone number.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_fax_number',
							'title'			=> __( 'Fax', 'opal-hotel-room-booking' ),
							'default'		=> '9876543210',
							'desc'     		=> __( 'This sets hotel\'s fax number.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'text',
							'id'			=> 'opalhotel_hotel_email_address',
							'title'			=> __( 'Email', 'opal-hotel-room-booking' ),
							'default'		=> get_option( 'admin_email' ),
							'desc'     		=> __( 'This sets hotel\'s email address public to your customer.', 'opal-hotel-room-booking' )
						),

					array(
							'type'			=> 'section_end',
							'id'			=> 'opalhotel_infomation'
						)

				) );
		}

	}

}

return new OpalHotel_Admin_Setting_Hotel();