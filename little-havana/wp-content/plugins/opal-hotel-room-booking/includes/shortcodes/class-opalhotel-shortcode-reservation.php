<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Shortcode_Reservation extends OpalHotel_Abstract_Shortcode {

	/* shortcode name */
	public $shortcode = null;

	public function __construct() {
		$this->shortcode = 'opalhotel_reservation';
		parent::__construct();
	}

	/* render */
	public function render( $atts = array(), $content = null ) {

		$atts = wp_parse_args( array(
				'step'		=> isset( $atts['step'] ) ? absint( $atts['step'] ) : 1
			), $atts );

		if ( isset( $atts['arrival_timestamp'], $atts['departure_timestamp'] ) && $atts['arrival_timestamp'] && $atts['departure_timestamp'] ) {
			$atts['arrival'] = $atts['arrival_timestamp'];
			$atts['departure'] = $atts['departure_timestamp'];
		}

		opalhotel_get_template( 'reservation.php', array( 'atts' => $atts ) );

	}

}
