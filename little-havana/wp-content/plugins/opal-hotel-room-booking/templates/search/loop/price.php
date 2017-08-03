<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/loop/price.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
$base_price = $room->base_price() * opalhotel_count_nights( $room->arrival, $room->departure );
?>

<div class="inner">
	<div class="opalhotel-room-price">

		<!-- has sale -->
		<?php if ( $base_price > $room->get_price() ) : ?>
			<del>
				<span class="price-value base-price">
				<?php printf( __( '%s', 'opal-hotel-room-booking' ), opalhotel_format_price( $base_price ) ) ?>
				</span>
			</del>
		<?php endif; ?>

		<ins>
			<span class="price-value">
				<?php printf( __( '%s', 'opal-hotel-room-booking' ), opalhotel_format_price( $room->get_price_display( $room->get_price() ) ) ) ?>
			</span>
		</ins>
		<span class="price-title"><?php _e( 'From', 'opal-hotel-room-booking' ); ?></span> / <span class="price-unit"><?php _e( ' per night', 'opal-hotel-room-booking' ) ?></span>
	</div>
	<a href="#opalhotel-modal-pricing-<?php echo $room->data->ID;?>" class="opalhotel-view-price opalhotel-fancybox"><?php _e( 'Price Details', 'opal-hotel-room-booking' ); ?></a>
</div>
