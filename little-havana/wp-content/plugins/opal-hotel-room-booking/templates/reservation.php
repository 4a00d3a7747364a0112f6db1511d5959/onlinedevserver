<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/reservation.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

do_action( 'opalhotel_before_reservation' );

/* reservation steps */
$steps = apply_filters( 'opalhotel_reservation_steps', array(
		1		=> __( 'Check Availability', 'opal-hotel-room-booking' ),
		2		=> __( 'Choose Room', 'opal-hotel-room-booking' ),
		3		=> __( 'Make A Reservation', 'opal-hotel-room-booking' ),
		4		=> __( 'Confirmation', 'opal-hotel-room-booking' ),
	) );

?>

<div class="opalhotel-reservation-container">
	<header class="opalhotel-reservation-process-steps">

		<?php do_action( 'opalhotel_before_process_step', $atts ); ?>

		<ul>
			<?php foreach ( $steps as $step => $title ) : ?>

				<li class="opalhotel-step<?php echo $atts['step'] == $step ? ' active' : '' ?>">
					<span><?php printf( '%d', $step ) ?></span>
					<h4><?php echo esc_html( $title ); ?></h4>
				</li>

			<?php endforeach; ?>
		</ul>

	</header>

	<?php
		// print all notices
		opalhotel_print_notices();
	?>
	<div class="opalhotel-reservation-step-content">

		 <!-- FISRT STEP CALENDAR DISPLAY -->
		<?php do_action( 'opalhotel_reservation_step', $atts ); ?>

	</div>

	<?php do_action( 'opalhotel_after_reservation' ); ?>

	<?php do_action( 'opalhotel_after_process_step', $atts ); ?>

</div>