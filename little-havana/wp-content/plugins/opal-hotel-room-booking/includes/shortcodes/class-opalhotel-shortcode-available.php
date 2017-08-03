<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Shortcode_Available extends OpalHotel_Abstract_Shortcode {

	/* shortcode name */
	public $shortcode = null;

	public function __construct() {
		$this->shortcode = 'opalhotel_check_available';
		parent::__construct();
	}

	/* render */
	public function render( $atts = array(), $content = null ) {
		$atts = shortcode_atts( array(
				'template'				=> 'form-check-available',
				'display_childrens'		=> true,
				'arrival'				=> isset( $atts['arrival_timestamp'] ) ? absint( $atts['arrival_timestamp'] ) : current_time( 'timestamp', 1 ),
				'arrival_text'			=> isset( $atts['arrival'] ) ? sanitize_text_field( $atts['arrival'] ) : false,
				'departure'				=> isset( $atts['departure_timestamp'] ) ? absint( $atts['departure_timestamp'] ) : current_time( 'timestamp', 1 ) + DAY_IN_SECONDS,
				'departure_text'		=> isset( $atts['departure'] ) ? sanitize_text_field( $atts['departure'] ) : false,
				'adult'					=> isset( $atts['adult'] ) ? absint( $atts['adult'] ) : false,
				'child'					=> isset( $atts['child'] ) ? absint( $atts['child'] ) : false,
				'room_type'				=> true,
				'paged'					=> 1,
				'layout'				=> ''
			), $atts );

		/* cart is empty */
		if ( $atts['template'] === 'form-results' ) {
			$arrival = strtotime( date( 'Y-m-d', $atts['arrival'] ) );
			$departure = strtotime( date( 'Y-m-d', $atts['departure'] ) );

			$results = opalhotel_get_room_available( array(
					'arrival'		=> $arrival,
					'departure'		=> $departure,
					'adult'			=> $atts['adult'],
					'child'			=> $atts['child'],
					'room_type'		=> $atts['room_type']
				) );

			/* no room found valid */
			if ( empty( $results ) ) {
				$atts['template'] = 'no-room-found';
			} else {
				$paged = isset( $atts['paged'] ) ? absint( $atts['paged'] ) : 1;
				$posts_per_page = get_option( 'posts_per_page', 1 );

				$pagination = new stdClass();
				$pagination->paged = max( 1, $paged );
				$pagination->total = ceil( count( $results ) / $posts_per_page );
				$results = array_slice( $results, ( $paged - 1 ) * $posts_per_page, $posts_per_page );
				$atts['rooms'] = $results;
				$atts['pagination']	= $pagination;
				$atts['step']		= 2;
				$atts['arrival']	= $arrival;
				$atts['departure']	= $departure;
			}
			opalhotel_get_template( 'search/' . $atts['template'] . '.php' , $atts );
		} else {
			if( isset( $atts['layout'] ) && $atts['layout'] === 'horizontal' ){
				opalhotel_get_template( 'search/horizontal-form-check-available.php', $atts );		
			} else {
				opalhotel_get_template( 'search/form-check-available.php', $atts );
			}
		}

		do_action( 'opalhotel_available_form', $atts, $content );
	}

}
