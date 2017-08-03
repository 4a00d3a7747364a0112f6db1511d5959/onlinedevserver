<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/* get packages */
$packages = $room->get_packages();
$hotels = $room->get_hotels();

$extra_details = $room->get_extras_all_details();
$max_adult = $room->get_max_adults_allowed();
$max_child = $room->get_max_childrens_allowed();

?>

<!-- package wraper -->
<div class="opalhotel-room-packages room-choose-packages" id="room-packages-<?php echo esc_attr( $room->id ); ?>">
	<!-- collapse title -->
	<div class="opalhotel-room-package-wrapper">
		<h5><?php _e( 'Optional', 'opal-hotel-room-booking' ); ?></h5>
		<div class="opalhotel-room-package-item grid-row">
			<div class="clearfix grid-column-6 grid-column">
				<h6 class="package-title pull-left">
					<span for="package-id-<?php echo esc_attr( $room->id ) ?>">
						<?php _e( 'Adults', 'opal-hotel-room-booking' ); ?>
					</span>
				</h6>
			</div>
			<div class="clearfix grid-column-6 grid-column">
				<h6 class="package-title pull-left">
					<select name="adult">
						<?php for ( $i = 0; $i <= $max_adult; $i++ ) : ?>
							<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $room->adult, $i ); ?>><?php echo absint( $i ); ?></option>
						<?php endfor; ?>
						<?php if ( $max_adult && ! empty( $extra_details['adult'] ) ) : ?>
							<?php foreach ( $extra_details['adult'] as $qty => $price ) : ?>
								<option value="<?php echo esc_attr( $max_adult + $qty ); ?>"<?php selected( $room->adult, $max_adult + $qty ); ?>><?php echo absint( $max_adult + $qty ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</h6>
			</div>
		</div>
		<div class="opalhotel-room-package-item grid-row">
			<div class="clearfix grid-column-6 grid-column">
				<h6 class="package-title pull-left">
					<span for="package-id-<?php echo esc_attr( $room->id ) ?>">
						<?php _e( 'Children', 'opal-hotel-room-booking' ); ?>
					</span>
				</h6>
			</div>
			<div class="clearfix grid-column-6 grid-column">
				<h6 class="package-title pull-left">
					<select name="child">
						<?php for ( $i = 0; $i <= $max_child; $i++ ) : ?>
							<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $room->child, $i ); ?>><?php echo absint( $i ); ?></option>
						<?php endfor; ?>
						<?php if ( $max_child && ! empty( $extra_details['child'] ) ) : ?>
							<?php foreach ( $extra_details['child'] as $qty => $price ) : ?>
								<option value="<?php echo esc_attr( $max_child + $qty ); ?>" <?php selected( $room->adult, $max_child + $qty ); ?>><?php echo absint( $max_child + $qty ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</h6>
			</div>
		</div>
		<?php if ( ! empty( $packages ) ) : ?>
			<h5><?php _e('Option Packages', 'opal-hotel-room-booking');?></h5>
			<?php foreach ( $packages as $k => $package ) : ?>

				<!-- each package -->
				<div class="opalhotel-room-package-item grid-row">

					<div class="clearfix grid-column-6 grid-column">

						<h6 class="package-title pull-left">
							<span for="package-id-<?php echo esc_attr( $package->id ) ?>-<?php echo esc_attr( $room->id ) ?>">
								<?php echo esc_html( $package->post_title ); ?>
							</span>
						</h6>
						<a href="#package-id-<?php echo esc_attr( $package->id ) ?>-<?php echo esc_attr( $room->id ) ?>" class="opalhotel-view-package-details opalhotel-popup-inline"></a>
						<div class="opalhotel-package-desc hide">
							<?php printf( '%s', apply_filters( 'the_content', $package->post_content ) ) ?>
						</div>

					</div>

					<div class="opalhotel-room-package-content grid-column-4 grid-column">

						<!-- price -->
						<div class="opalhotel-package-price">
							<?php if ( $package->package_type === 'package' ) : ?>

								<span class="price-title">
									<input type="number" min="1" step="1" name="packages[qty][<?php echo esc_attr( $package->id ) ?>]" value="1" />
								</span>

							<?php endif; ?>
							<span class="price-value">
								<?php printf( __( '%s', 'opal-hotel-room-booking' ), opalhotel_format_price( $package->get_price_display( $package->get_price() ) ) ) ?>
							</span>
							<span class="price-unit"><?php printf( ' / %s', opalhotel_get_package_label( $package->id ) ) ?></span>
						</div>
						<!-- end price -->
					</div>
					<div class="opalhotel-room-checked grid-column-2 grid-column">
						<input type="checkbox" class="pull-right" name="packages[checked][<?php echo esc_attr( $package->id ) ?>]" id="package-id-<?php echo esc_attr( $package->id ) ?>-<?php echo esc_attr( $room->id ) ?>" />
					</div>
				</div>
				<!-- end each package -->

			<?php endforeach; ?>
		<?php endif; ?>
		<?php if ( ! empty( $hotels ) ) : ?>
			<h5><?php _e('Option Hotels', 'opal-hotel-room-booking');?></h5>
			<?php $i = 0; foreach ( $hotels as $k => $hotel ) : setup_postdata( $hotel ); ?>

				<!-- each package -->
				<div class="opalhotel-room-package-item grid-row">

					<div class="clearfix grid-column-10 grid-column">

						<h6 class="package-title pull-left">
							<a href="<?php echo get_permalink( $hotel->ID ); ?>" target="_blank">
								<span for="hotel-id-<?php echo esc_attr( $hotel->ID ) ?>-<?php echo esc_attr( $room->id ) ?>">
									<?php echo esc_html( $hotel->post_title ); ?>
								</span>
							</a>
						</h6>

					</div>
					<div class="opalhotel-room-checked grid-column-2 grid-column">
						<input type="radio" class="pull-right" name="hotel-id" value="<?php echo esc_attr( $hotel->ID ) ?>" id="hotel-id-<?php echo esc_attr( $hotel->ID ) ?>-<?php echo esc_attr( $room->id ) ?>"<?php echo ( $i == 0 ) ? ' checked="checked"' : '' ?> />
					</div>
				</div>
				<!-- end each package -->

			<?php $i++; endforeach; wp_reset_postdata(); ?>
		<?php endif; ?>
		<div class="button-actions clearfix">
			<div class="pull-right">
			<?php opalhotel_get_template( 'search/loop/button.php', array( 'room' => $room ) ); ?>
			</div>
		</div>
	</div>

</div>
<!-- end package wraper -->
