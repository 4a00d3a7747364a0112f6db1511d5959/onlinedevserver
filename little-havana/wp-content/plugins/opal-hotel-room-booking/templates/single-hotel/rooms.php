<?php
/**
 * The template for displaying hotel content within single
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/single-hotel/title.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$hotel = opalhotel_get_hotel( get_the_ID() );

$rooms = $hotel->get_rooms();
?>

<?php if ( $rooms->have_posts() ) : ?>

	<?php
		remove_action( 'opalhotel_archive_loop_item_detail', 'opalhotel_loop_item_details', 5 );
		add_action( 'opalhotel_archive_loop_item_list_description', 'opalhotel_loop_item_view_details', 6 );
	?>

	<div class="hotel-box">
		<h3 class="title"><?php _e( 'Rooms', 'opal-hotel-room-booking' ); ?></h3>
		<div class="content">
			<?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>

				<?php opalhotel_get_template_part( 'content-room', 'list' ); ?>

			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>

	<?php
		add_action( 'opalhotel_archive_loop_item_detail', 'opalhotel_loop_item_details', 5 );
		remove_action( 'opalhotel_archive_loop_item_list_description', 'opalhotel_loop_item_view_details', 6 );
	?>

<?php endif; ?>
