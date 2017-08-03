<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_MetaBox_Booking_Data {

	/* render */
	public static function render( $post ) {
		require_once OPALHOTEL_PATH . '/includes/admin/metaboxes/views/booking-customer-data.php';
	}

	/* save post meta*/
	public static function save( $post_id, $post ) {
		if ( $post->post_type !== 'opalhotel_booking' || empty( $_POST ) ) {
			return;
		}

		remove_action( 'save_post', array( __CLASS__, 'save' ), 10, 2 );

		foreach ( $_POST as $name => $value ) {
			if ( strpos( $name, '_customer_' ) === 0 || $name === '_transaction_id' ) {
				if ( $name === '_customer_notes' ) {
					wp_update_post( array(
							'ID' 		=> $post_id,
							'post_content'	=> $value
						) );
				} else {
					update_post_meta( $post_id, $name, $value );
				}
			}
		}

		add_action( 'save_post', array( __CLASS__, 'save' ), 10, 2 );
	}

}