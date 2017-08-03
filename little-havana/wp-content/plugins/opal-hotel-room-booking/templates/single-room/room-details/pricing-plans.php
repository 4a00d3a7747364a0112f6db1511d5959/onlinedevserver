<?php
/**
 * The template for displaying room content within single
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/single-room/room-details/pricing-plans.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
global $opalhotel_room;

global $wp_locale;

$packages = $opalhotel_room->get_packages();
$hotels = $opalhotel_room->get_hotels();

?>

<?php if( $hotels && ! is_wp_error( $hotels ) ): ?>
	<div class="room-box">
		<div class="room-optional-packages">
			<h4><?php _e( 'Hotel Availability', 'opal-hotel-room-booking' ); ?></h4>
			<div class="inner">
				<div class="opalhotel-room-packages">
					<?php foreach ( $hotels as $hotel ) : setup_postdata( $hotel ); ?>

						<div class="package-item <?php if( $hotel->post_excerpt ) : ?> has-content<?php endif; ?>">
							<?php echo get_the_post_thumbnail( $hotel->ID ); ?>
							<div class="package-content">
								<!-- each package -->
								<h4><?php echo esc_html( $hotel->post_title ); ?></h4>
								<!-- end each package -->
							</div>	
							<?php if( $hotel->post_excerpt ) : ?>
							<div class="package-description">
								<?php echo wp_strip_all_tags($hotel->post_excerpt); ?>
							</div>
							<?php endif ; ?>
						</div>
				<?php endforeach; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="room-box">
	<?php if( $packages ): ?>
		<div class="room-optional-packages">
			<h4><?php _e( 'Optional Packages', 'opal-hotel-room-booking' ); ?></h4>
			<div class="inner">
				<div class="opalhotel-room-packages">
					<?php foreach ( $packages as $k => $package ) :   ?>

						<div class="package-item <?php if( $package->post_content ) : ?> has-content<?php endif; ?>">
							<?php echo get_the_post_thumbnail( $package->id); ?>
							<div class="package-content">
								<!-- each package -->
								<h4><?php echo esc_html( $package->post_title ); ?></h4>
						 
								<!-- price -->
								<div class="opalhotel-package-price">
									<span class="price-value">
										<?php printf( __( '%s', 'opal-hotel-room-booking' ), opalhotel_format_price( $package->get_price_display( $package->get_price() ) ) ) ?>
									</span>
									<span class="price-unit"><?php printf( ' / %s', opalhotel_get_package_label( $package->id ) ) ?></span>
								</div>
								<!-- end each package -->
							</div>	
							<?php if( $package->post_content ) : ?>
							<div class="package-description">
								<?php echo apply_filters( 'the_content', $package->post_content ); ?>
							</div>
							<?php endif ; ?>
						</div>	
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?> 

	<?php
	$discounts = $opalhotel_room->get_discounts_prices_info();
	if( $discounts ): ?>
		<div class="room-discounts-info">
			<div class="alert alert-success">
				<h4><?php _e('Discount','opal-hotel-room-booking'); ?></h4>
				<?php foreach( $discounts as $discount ): ?>
		 
				<div class="discount-item"> <i class="fa fa-check" aria-hidden="true"></i>

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
				</div>	
		 
				<?php endforeach; ?>

			</div>
		</div>	
	<?php endif;  ?>

	<?php if ( $prices = $opalhotel_room->get_extras_all_details() ) : ?>
		<div class="opalhotel-price-day">
			<div class="alert alert-danger">
				<h4><?php _e( 'Extra Price', 'opal-hotel-room-booking' ); ?></h4>
				<div class="content">
					<ul>
						<?php if ( isset( $prices['adult'] ) ) : ?>
							<?php foreach ( $prices['adult'] as $adult => $price ) : ?>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php printf( translate_nooped_plural( _n_noop( '%1$s adult +<span>%2$s/room</span>', '%1$s adults +<span>%2$s/room</span>' ), 'opal-hotel-room-booking' ), $adult, opalhotel_format_price( $price ) ); ?>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
						<?php if ( isset( $prices['child'] ) ) : ?>
							<?php foreach ( $prices['child'] as $child => $price ) : ?>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php printf( translate_nooped_plural( _n_noop( '%1$s child +<span>%2$s</span>', '%1$s child +<span>%2$s/room</span>' ), 'opal-hotel-room-booking' ), $child, opalhotel_format_price( $price ) ); ?>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>	
		</div>
	<?php endif;  ?>
</div>

<div class="room-box">
	<?php $pricing_plans = opalhotel_get_current_week_pricing( get_the_ID() ); ?>
	<?php if ( $pricing_plans ) : ?>
		<h4><?php _e( 'Pricing Plans', 'opal-hotel-room-booking' ); ?></h4>
		<div class="grid-row">
		<div class="room-pricing-plans grid-column grid-column-6">
				<h5><?php _e( 'This Week' , 'opal-hotel-room-booking' ); ?></h5>
				<?php foreach ( $pricing_plans as $day => $price ) : ?>
					<?php $day = date_i18n( 'l', $day ); ?>

					<div class="pricing-day">
						<span class="day_name meta-label"><?php printf( '%s', $wp_locale->weekday_abbrev[$day] ); ?></span>	
						<span class="day_price meta-text pull-right"><?php printf( '%s', opalhotel_format_price( $price ) ); ?></span>
					</div>
				<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php $pricing_plans = opalhotel_get_next_week_pricing( get_the_ID() );?>
	<?php if ( $pricing_plans ) : ?>

		<div class="room-pricing-plans grid-column grid-column-6">
				<h5><?php _e( 'Next Week' , 'opal-hotel-room-booking' ); ?></h5>
				<?php foreach ( $pricing_plans as $day => $price ) : ?>
					<?php $day = date_i18n( 'l', $day ); ?>

					<div class="pricing-day">
						<span class="day_name meta-label"><?php printf( '%s', $wp_locale->weekday_abbrev[$day] ); ?></span>	
						<span class="day_price meta-text pull-right"><?php printf( '%s', opalhotel_format_price( $price ) ); ?></span>
					</div>
				<?php endforeach; ?>
		</div>
	<?php endif; ?>
	</div>
</div>