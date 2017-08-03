<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/no-room-found.php.
 *
 * When search have no results
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>

<div class="opalhotel-notice-error">
	<?php printf( __( 'No room found with arrival %s and departure %s.', 'opal-hotel-room-booking' ), opalhotel_format_date( $arrival ), opalhotel_format_date( $departure ) ); ?>
</div>