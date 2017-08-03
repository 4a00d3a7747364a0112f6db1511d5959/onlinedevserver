<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/loop/pricing.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>

<div class="opalhotel-modal-pricing" style="display:none" id="opalhotel-modal-pricing-<?php echo $room->data->ID;?>">

	<div class="opalhotel-pricing-details">

		<div class="opalhotel-pricing-content">
			<div class="opalhtel-price-day">

				<div class="content">
					<?php if ( $prices = $room->get_pricing() ) : ?>

						<ul>
							<?php foreach ( $prices as $timestamp => $price ) : ?>
								<li>
									<?php printf( '%s -', opalhotel_format_date( $timestamp ) ); ?>
									<span><?php printf( '%s', opalhotel_format_price( $price ) ) ?></span>
								</li>
							<?php endforeach; ?>
						</ul>

					<?php endif; ?>
				</div>

			</div>
			<?php $prices = $room->get_extras_details(); if ( $prices && ( $room->need_calculate_adult_price() || $room->need_calculate_child_price() ) ) : ?>
				<div class="opalhtel-price-day">
					<h5><?php _e( 'Extra Price', 'opal-hotel-room-booking' ); ?></h5>
					<div class="content">
						<ul>
							<?php if ( ! empty( $prices['adult'] ) ) : ?>
								<?php foreach ( $prices['adult'] as $adult => $price ) : ?>
									<li>
										<?php printf( translate_nooped_plural( _n_noop( '%1$s adult +<span>%2$s/room</span>', '%1$s adults +<span>%2$s/room</span>' ), 'opal-hotel-room-booking' ), $adult, opalhotel_format_price( $price ) ); ?>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if ( ! empty( $prices['child'] ) ) : ?>
								<?php foreach ( $prices['child'] as $child => $price ) : ?>
									<li>
										<?php printf( translate_nooped_plural( _n_noop( '%1$s child +<span>%2$s</span>', '%1$s child +<span>%2$s/room</span>' ), 'opal-hotel-room-booking' ), $child, opalhotel_format_price( $price ) ); ?>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $discount = $room->get_discounts_details() ) : ?>

				<div class="opalhtel-price-day">
					<h5><?php _e( 'Discount Price', 'opal-hotel-room-booking' ); ?></h5>
					<div class="content">
						<ul>
							<li>
								<?php if ( $discount['type'] === 'before' ) : ?>

									<?php printf( __( 'Book before %s', 'opal-hotel-room-booking' ), opalhotel_days_display( $discount['unit'] ), $discount['amount'] ) ?>

								<?php elseif ( $discount['type'] === 'live' ) : ?>

									<?php printf( __( 'Duration %s', 'opal-hotel-room-booking' ), opalhotel_days_display( $discount['unit'] ) ) ?>

								<?php endif; ?>

								<?php if ( $discount['sale_type'] === 'subtract' ) : ?>
									<?php printf( __( ' - %s/room', 'opal-hotel-room-booking' ), opalhotel_format_price( $discount['amount'] ) ) ?>
								<?php else : ?>
									<?php printf( __( ' - %s%s/room', 'opal-hotel-room-booking' ), $discount['amount'], '%' ) ?>
								<?php endif; ?>
							</li>
						</ul>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
	<div class="opalhotel-modal-close">
		<i class="fa fa-close"></i>
	</div>

</div>