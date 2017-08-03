<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_MetaBox_Booking_Item {

	/* render */
	public static function render( $post ) {
		require_once OPALHOTEL_PATH . '/includes/admin/metaboxes/views/booking-items-data.php';
	}

	/* save post meta*/
	public static function save( $post_id, $post ) {
		if ( $post->post_type !== 'opalhotel_booking' || empty( $_POST ) ) {
			return;
		}

	}

}