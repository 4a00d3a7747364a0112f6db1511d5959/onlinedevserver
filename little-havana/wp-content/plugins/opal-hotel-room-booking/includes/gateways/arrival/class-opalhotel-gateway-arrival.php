<?php
/**
 * @Author: brainos
 * @Date:   2016-04-25 23:52:13
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-15 00:21:50
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Gateway_Arrival extends OpalHotel_Abstract_Gateway {

	/* gateway id */
	public $id 		= null;

	/* gateway title */
	public $title 	= null;

	/* description */
	public $description = null;

	public function __construct() {

		/* init gateway id */
		$this->id = 'arrival';

		$this->title = __( 'Offline', 'opal-hotel-room-booking' );

		$this->description = __( 'Pay on Arrival', 'opal-hotel-room-booking' );
	}

	/* get settings */
	public function admin_settings() {
		return array(
				array(
							'type'		=> 'section_start',
							'id'		=> 'offline_settings',
							'title'		=> __( 'Pay on Arrival', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Have your customers pay with cash.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_offline_enable',
							'title'		=> __( 'Enable/Disable', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'Enable payment offline', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'offline_settings'
						)
			);
	}

	/* is enabled. ready to payment */
	public function is_enabled() {
		return get_option( 'opalhotel_offline_enable', 1 );
	}

	/* process payment */
	public function payment_process( $order_id = null, $page = '' ) {
		$order = OpalHotel_Order::instance( $order_id );
		/* change status processing */
		$order->update_status( 'processing' );

		OpalHotel()->cart->empty_cart();

		$result = array(
				'status'	=> true
			);

		if ( $page ) {
			$result['redirect']	= $this->get_return_url( $order );
		} else {
			ob_start();
			echo do_shortcode( '[opalhotel_reservation step="4" order-received="' . $order->id . '"]' );
			$result['reservation'] = ob_get_clean();
		}

		return apply_filters( 'opalhotel_payment_arrival_result', $result, $order );
	}

}
