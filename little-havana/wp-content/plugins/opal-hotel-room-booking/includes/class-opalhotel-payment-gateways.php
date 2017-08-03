<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// if not existed class OpalHotel_Payment_Gateway
if ( ! class_exists( 'OpalHotel_Payment_Gateway' ) ) {

	class OpalHotel_Payment_Gateways{

		/* gateways */
		static $gateways = null;

		/* instance */
		static $instance = null;

		public function __construct() {
			self::get_payments();
		}

		/* get payments enable */
		public static function get_payments() {
			return self::$gateways = apply_filters( 'opalhotel_payment_gateway', array(
					'offline' 	=> new OpalHotel_Gateway_Arrival(),
					'paypal' 	=> new OpalHotel_Gateway_Paypal(),
					'stripe'	=> new OpalHotel_Gateway_Stripe()
				) );
		}

		/* get payment process */
		public static function get_payment_process( $method = null) {
			$payments = self::get_payments();
			if ( isset( $payments[ $method ] ) ) {
				return $payments[ $method ];
			}
		}

		/* get instance */
		public static function instance() {
			if ( ! self::$instance ) {
				return self::$instance = new self();
			}

			return self::$instance;
		}

	}

}
