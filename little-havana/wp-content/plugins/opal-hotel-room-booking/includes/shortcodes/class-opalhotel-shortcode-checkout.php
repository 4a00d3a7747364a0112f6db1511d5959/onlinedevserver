<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Shortcode_Checkout extends OpalHotel_Abstract_Shortcode {

	/* shortcode name */
	public $shortcode = null;

	public function __construct() {
		$this->shortcode = 'opalhotel_checkout';
		parent::__construct();
	}

	/* render */
	public function render( $atts = array(), $content = null ) {

		do_action( 'opalhotel_before_checkout' );

		do_action( 'opalhotel_checkout_room_available' );

		global $wp;
		$page_name = $wp->query_vars;
		if ( isset( $wp->query_vars['pagename'], $wp->query_vars['reservation-received'] ) && $wp->query_vars['pagename'] === 'opal-hotel-checkout' && $wp->query_vars['reservation-received'] ) {
			$order_id = absint( $wp->query_vars['reservation-received'] );
			/* order received */
			opalhotel_get_template( 'checkout/order-received.php', array( 'order' => OpalHotel_Order::instance( $order_id ) ) );
		} else if ( isset( $atts['order-received'] ) && get_post( $atts['order-received'] ) ) {
			/* order received */
			opalhotel_get_template( 'checkout/order-received.php', array( 'order' => OpalHotel_Order::instance( $atts['order-received'] ) ) );
		} else if ( OpalHotel()->cart->is_empty || empty( OpalHotel()->cart->cart_contents ) ) {
			/* cart is empty */
			opalhotel_get_template( 'checkout/empty.php' );
		} else {
			/* cart is not empty */
			opalhotel_get_template( 'checkout/checkout.php' );
		}

	}

}