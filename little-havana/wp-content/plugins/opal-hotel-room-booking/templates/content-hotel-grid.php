<?php
/**
 * The template for displaying room hotel within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/content-hotel.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$class = opalhotel_get_loop_class();

?>

<div <?php post_class( $class ); ?>>
	<div class="hotel-grid">
		<div class="hotel-top-wrap clearfix">
			<?php
				/**
				 * opalhotel_archive_loop_item_thumbnail hook.
				 * opalhotel_hotel_loop_item_thumbnail - 5
				 */
				do_action( 'opalhotel_hotel_loop_item_thumbnail' );
			?>
		</div>

		<?php
			/**
			 * opalhotel_before_archive_loop_item_title hook.
			 * opalhotel_hotel_loop_item_title - 5
			 */
			do_action( 'opalhotel_hotel_loop_item_title' );
		?>
		<footer>
			<?php

				/**
				 * opalhotel_hotel_loop_item_description hook.
				 *
				 * @hooked opalhotel_hotel_loop_item_description - 5
				 */
				do_action( 'opalhotel_hotel_loop_item_description' );

				/**
				 * opalhotel_hotel_loop_item_view_details hook.
				 *
				 * @hooked opalhotel_hotel_loop_item_view_details - 5
				 */
				do_action( 'opalhotel_hotel_loop_item_view_details' );
			?>
		</footer>

		<?php
			/**
			 * opalhotel_after_archive_loop_item hook.
			 */
			do_action( 'opalhotel_after_archive_loop_item' );
		?>
	</div>
</div>