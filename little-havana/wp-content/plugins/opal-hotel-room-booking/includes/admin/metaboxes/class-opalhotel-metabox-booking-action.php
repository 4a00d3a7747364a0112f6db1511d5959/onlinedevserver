<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_MetaBox_Booking_Action {

	/* render */
	public static function render( $post ) {
		require_once OPALHOTEL_PATH . '/includes/admin/metaboxes/views/booking-actions.php';
	}

	/* save post meta*/
	public static function save( $post_id, $post ) {
		if ( $post->post_type !== 'opalhotel_booking' || empty( $_POST ) ) {
			return;
		}
		$order = OpalHotel_Order::instance( $post_id );

		remove_action( 'save_post', array( __CLASS__, 'save' ), 10, 2 );
		if ( isset( $_POST['_payment_method'] ) ) {
			$method = sanitize_text_field( $_POST['_payment_method'] );
			update_post_meta( $post_id, '_payment_method', $method );
			$payments = OpalHotel()->payment_gateways->get_payments();
			if ( isset( $payments[ $method ] ) ) {
				update_post_meta( $post_id, '_payment_method_title', $payments[ $method ]->title );
			}
		}

		if ( isset( $_POST['_payment_status'] ) ) {
			$status = sanitize_text_field( $_POST['_payment_status'] );
			$statuses = opalhotel_get_order_statuses();
			if ( isset( $statuses[ $status ] ) ) {
				$order->update_status( $status );
			}
		}

		update_post_meta( $post_id, '_arrival', $order->get_arrival_date() );
		update_post_meta( $post_id, '_departure', $order->get_arrival_date() );
		add_action( 'save_post', array( __CLASS__, 'save' ), 10, 2 );
	}

}
