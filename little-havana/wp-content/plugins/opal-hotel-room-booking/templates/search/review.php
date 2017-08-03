<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/review.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
 
?>
<div class="opalhotel-reservation-available-review">
<?php if ( $rooms = OpalHotel()->cart->get_rooms() ) : ?>

	<h3 class="widget-title hide"><span><span><?php _e( 'Booking Cart' ,'opal-hotel-room-booking' );?></span></span></h3>
	<?php foreach ( $rooms as $cart_item_id => $room ) : ?>

		<?php $data = $room['data']; ?>

		<div class="opalhotel-available-review-item">

			<div class="opalhotel-reservation-available-room-title">
				<?php printf( '%s(x%s)', esc_html( $data->get_title() ), $room['qty'] ); ?>
				<label class="opalhotel-review-price">
					<?php printf( '%s', opalhotel_format_price( OpalHotel()->cart->get_cart_item_subtotal( $cart_item_id ) ) ) ?>
					<a href="#" class="cart_remove_item" data-id="<?php echo esc_attr( $cart_item_id ) ?>">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				</label>
			</div>
			<div class="room-meta">
				<span class="adult"><?php printf( __( 'Adult: %d' ), $data->adult ) ?></span>
				<span class="children"><?php printf( __( 'Children: %d' ), $data->child ) ?></span>
				<?php if ( ! empty( $room['hotel'] ) && ( $term = get_term( $room['hotel'], 'opalhotel_hotel' ) ) ) : ?>
					<span class="hotel" style="display: block; clear: both"><?php printf( __( 'Hotel: %s' ), $term->name ) ?></span>
				<?php endif; ?>
			</div>
			<?php if ( $packages = OpalHotel()->cart->get_packages( $cart_item_id ) ) : ?>
				<div class="opalhotel_reservation_packages">
					<!-- <h4 class="opalhotel_review_package_title"><?php //_e( 'Packages', 'opal-hotel-room-booking' ); ?></h4> -->
					<?php foreach ( $packages as $package_cart_id => $package ) : ?>
						<div class="opalhotel-reservation-available_package-item">
							<label class="opalhotel_package_title"><?php printf( '%s(x%s)', $package['data']->post_title, $package['qty'] ) ?></label>
							<label class="opalhotel-review-price">
								<?php printf( '%s', opalhotel_format_price( OpalHotel()->cart->get_cart_item_subtotal( $package_cart_id ) ) ) ?>
								<a href="#" class="cart_remove_item" data-id="<?php echo esc_attr( $package_cart_id ) ?>">
									<i class="fa fa-times" aria-hidden="true"></i>
								</a>
							</label>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div class="opalhotel-reservation-subtotal">
				<label><?php _e( 'Subtotal', 'opal-hotel-room-booking' ) ?></label>
				<label class="opalhotel-review-price">
					<?php printf( '%s', opalhotel_format_price( OpalHotel()->cart->get_room_subtotal( $cart_item_id ) ) ) ?>
				</label>
			</div>

		</div>

	<?php endforeach; ?>

	<div class="opalhotel-available-review-item">
		<!-- subtotal -->
		<div class="opalhotel-review-subtotal">
			<label><?php _e( 'Subtotal', 'opal-hotel-room-booking' ) ?></label>
			<label class="opalhotel-review-price">
				<?php printf( '%s', opalhotel_format_price( OpalHotel()->cart->get_cart_subtotal_display() ) ) ?>
			</label>
		</div>

		<?php if ( OpalHotel()->cart->discount_total ) : ?>

			<?php foreach ( OpalHotel()->cart->coupon_discounts as $code => $amount ) : ?>

				<!-- Coupon -->
				<div class="opalhotel-review-subtotal">
					<label><?php printf( __( 'Coupon: %s (<a href="#" class="remove_coupon" data-code="%s">Remove</a>)', 'opal-hotel-room-booking' ), $code, $code ) ?></label>
					<label class="opalhotel-review-price">
						<?php printf( '-%s', opalhotel_format_price( $amount ) ) ?>
					</label>
				</div>

			<?php endforeach; ?>

		<?php endif; ?>

		<?php if ( opalhotel_tax_enable() && ! opalhotel_tax_enable_cart() ) : ?>
			<!-- tax -->
			<div class="opalhotel-review-subtotal">
				<label><?php _e( 'Tax', 'opal-hotel-room-booking' ) ?></label>
				<label class="opalhotel-review-price">
					<?php printf( '%s', opalhotel_format_price( OpalHotel()->cart->get_tax_total() ) ) ?>
				</label>
			</div>
		<?php endif; ?>
		<!-- total -->
		<div class="opalhotel-review-total">
			<label><?php printf( __( 'Total%s', 'opal-hotel-room-booking' ), ( opalhotel_tax_enable() && opalhotel_tax_enable_cart() ? __( '<small>(Included Tax)</small>', 'opal-hotel-room-booking' ) : '' ) ) ?></label>
			<label class="opalhotel-review-price">
				<?php printf( '%s', opalhotel_format_price( OpalHotel()->cart->get_cart_total() ) ) ?>
			</label>
		</div>
	</div>

<?php endif; ?>

</div>
