<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/form-check-available.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

global $post;

$arrival = isset( $_REQUEST['arrival_timestamp'] ) ? absint( $_REQUEST['arrival_timestamp'] ) : current_time( 'timestamp' );
$arrival = strtotime( date( 'Y-m-d', $arrival ) );
$departure = isset( $_REQUEST['departure_timestamp'] ) ? absint( $_REQUEST['departure_timestamp'] ) : current_time( 'timestamp' ) + DAY_IN_SECONDS;
$departure = strtotime( date( 'Y-m-d', $departure ) );

$arrival_text = isset( $_REQUEST['arrival'] ) ? sanitize_text_field( $_REQUEST['arrival'] ) : opalhotel_format_date( $arrival );
$departure_text = isset( $_REQUEST['departure'] ) ? sanitize_text_field( $_REQUEST['departure'] ) : opalhotel_format_date( $departure );
$adult = isset( $_REQUEST['adult'] ) ? absint( $_REQUEST['adult'] ) : 0;
$child = isset( $_REQUEST['child'] ) ? absint( $_REQUEST['child'] ) : 0;
$room_type_selected = isset( $_REQUEST['room_type'] ) ? absint( $_REQUEST['room_type'] ) : '';

$current_page_id = 0;
if ( $post && $post->ID ) {
	$current_page_id = $post->ID;
}
if ( isset( $_REQUEST['current_page_id'] ) ) {
	$current_page_id = absint( $_REQUEST['current_page_id'] );
}

?>

<div class="opalhotel_form_section">

	<form action="<?php echo esc_attr( opalhotel_get_reservation_url() ) ?>" method="GET" name="opalhotel_check_availability" class="opalhotel_check_availability opalhotel_datepick_wrap">
		<div class="horizontal-form clearfix">
				<header class="heading-form">
					<h3><?php _e( 'Book', 'opal-hotel-room-booking' ) ?> <span><?php _e( 'A Room', 'opal-hotel-room-booking' ) ?></span></h3>
				</header>
				<div class="form-content">
					<!-- reviews disabled -->
					<?php // do_action( 'opalhotel_reservation_reviews' ); ?>
					<!-- before hook -->
					<?php do_action( 'opalhotel_before_reservation_form' ) ?>
					<!-- arrival date -->
					<div class="opalhotel-form-field checkin-input">
						<label class="opalhotel-form-lable"><?php _e( 'Check In', 'opal-hotel-room-booking' ); ?></label>
						<div class="opalhotel-form-field-group">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<input class="opalhotel_arrival_date opalhotel-has-datepicker" name="arrival" placeholder="<?php esc_attr_e( 'Arrival Date', 'opal-hotel-room-booking' ); ?>" data-end="opalhotel-departure-date" value="<?php echo esc_attr( $arrival_text ) ?>"/>
							<?php if ( isset( $arrival ) && $arrival ) : ?>
								<input type="hidden" name="arrival_timestamp" value="<?php echo esc_attr( $arrival ) ?>" />
							<?php endif; ?>
						</div>
					</div>
					<!-- end arrival date -->

					<!-- departure date -->
					<div class="opalhotel-form-field checkout-input">
						<label class="opalhotel-form-lable"><?php _e( 'Check Out', 'opal-hotel-room-booking' ); ?></label>
						<div class="opalhotel-form-field-group">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<input class="opalhotel-departure-date opalhotel-has-datepicker" name="departure" placeholder="<?php esc_attr_e( 'Departure Date', 'opal-hotel-room-booking' ); ?>" data-start="opalhotel_arrival_date" value="<?php echo esc_attr( $departure_text ) ?>"/>
							<?php if ( isset( $departure ) && $departure ) : ?>
								<input type="hidden" name="departure_timestamp" value="<?php echo esc_attr( $departure ) ?>" />
							<?php endif; ?>
						</div>
					</div>
					<!-- end departure date -->

					<!-- max adult -->
					<div class="opalhotel-form-field adults-input">
						<label class="opalhotel-form-lable"><?php _e( 'Adults', 'opal-hotel-room-booking' ); ?></label>
						<?php $max_adult = opalhotel_get_max_adults(); ?>
						<div class="opalhotel-form-field-group">
							<?php
								printf( '%s', opalhotel_select_number( array(
									'name'	=> 'adult',
									'class'	=> 'adult',
									'min'	=> 1,
									'max'	=> $max_adult,
									// 'none'	=> __( 'Adult', 'opal-hotel-room-booking' ),
									'class'	=> 'opalhotel_adult',
									'selected'	=> $adult
								) ) );
							?>
						</div>
					</div>
					<!-- end max adult -->

					<?php if ( isset( $display_childrens ) && $display_childrens ) : ?>

						<!-- max child -->
						<div class="opalhotel-form-field children-input">
							<label class="opalhotel-form-lable"><?php _e( 'Children', 'opal-hotel-room-booking' ); ?></label>
							<?php $max_child = opalhotel_get_max_childs();?>
							<div class="opalhotel-form-field-group">
								<?php
									printf( '%s', opalhotel_select_number( array(
										'name'	=> 'child',
										'class'	=> 'child',
										'min'	=> 0,
										'max'	=> $max_child,
										// 'none'	=> __( 'Children', 'opal-hotel-room-booking' ),
										'class'	=> 'opalhotel_children',
										'selected'	=> $child
									) ) );
								?>
							</div>
						</div>
						<!-- end max child -->

					<?php endif; ?>

					<?php if ( $room_type ) : ?>

						<div class="opalhotel-form-field room-type-input">
							<label class="opalhotel-form-lable"><?php _e( 'Room Type', 'opal-hotel-room-booking' ); ?></label>
							<div class="opalhotel-form-field-group">
								<?php
									printf( '%s', opalhotel_select_room_types(array(
											'name'		=> 'room_type',
											'none_select'	=> __( 'Select Room Type', 'opal-hotel-room-booking' ),
											'selected'	=> $room_type_selected
										)) );
								?>
							</div>
						</div>

					<?php endif; ?>

					<!-- before hook -->
					<?php do_action( 'opalhotel_after_reservation_form' ) ?>
					<footer class="opalhotel-form-field button-wrap">
						<input type="hidden" name="step" value="2" />
						<input type="hidden" name="current_page_id" value="<?php echo esc_attr( $current_page_id ) ?>" />
						<button type="submit" class="opalhotel-button-submit button button-theme button-block"><?php _e( 'Check Availability', 'opal-hotel-room-booking' ); ?></button>
					</footer>
				</div>	
		</div>		
	</form>

</div>