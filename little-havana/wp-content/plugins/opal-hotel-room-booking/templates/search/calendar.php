<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/calendar.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/* print notices */
opalhotel_print_notices();

// $arrival = isset( $_REQUEST['arrival_timestamp'] ) ? absint( $_REQUEST['arrival_timestamp'] ) : '';
// $departure = isset( $_REQUEST['departure_timestamp'] ) ? absint( $_REQUEST['departure_timestamp'] ) : '';

do_shortcode( '[opalhotel_check_available layout="horizontal"]' ); // || opalhotel_get_template( 'search/horizontal-form-check-available.php' );	

?>

<!-- <div id="opalhotel_check_availability" class="opalhotel-datpicker" data-arrival="<?php //echo esc_attr( $arrival ) ?>" data-departure="<?php //echo esc_attr( $departure ) ?>"></div> -->
