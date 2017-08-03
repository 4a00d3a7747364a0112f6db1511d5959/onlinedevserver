<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/content-single-room.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}


/**
 * opalhotel_before_single_room hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'opalhotel_before_single_room' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

?>

<div class="opalhotel-wrapper">

	<div id="opalhotel-room-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
			/**
			 * opalhotel_before_single_hotel_main hook.
			 */
			do_action( 'opalhotel_before_single_hotel_main' );
		?>

		<div class="opalhotel-main">

			<?php

				/**
				 * opalhotel_single_hotel_main hook.
				 *
				 * @hooked opalhotel_single_hotel_title - 5
				 * @hooked opalhotel_single_hotel_gallery - 10
				 * @hooked opalhotel_single_hotel_description - 15
				 * @hooked opalhotel_single_hotel_rooms - 15
				 */
				do_action( 'opalhotel_single_hotel_main' );
			?>

		</div><!-- .summary -->

		<?php
			/**
			 * opalhotel_after_single_hotel_main hook.
			 *
			 * @hooked opalhotel_output_hotel_data_tabs - 10
			 */
			do_action( 'opalhotel_after_single_hotel_main' );
		?>

	</div><!-- #opalhotel-room-<?php the_ID(); ?> -->

	<?php do_action( 'opalhotel_after_single_room' ); ?>

</div>
<!-- dynamic search form -->