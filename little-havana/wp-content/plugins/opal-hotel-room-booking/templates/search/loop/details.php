<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/loop/attributes.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
$opalhotel_room = $room;
?>
<div class="room-content">
	<!-- title -->
	<?php opalhotel_get_template( 'search/loop/title.php', array( 'room' => $room ) ); ?>

	<div class="room-meta-info">
		<div class="inner">
			<ul class="opalhotel-room-meta">
				<?php if ( $opalhotel_room->adults ) : ?>
					<li class="meta-adults">
						<span class="meta-label"><?php _e( 'People', 'opal-hotel-room-booking' ); ?></span>
						<span class="meta-text"><?php printf( '%s', $opalhotel_room->adults ); ?></span>
					</li>
				<?php endif; ?>
				<?php if ( $opalhotel_room->room_size ) : ?>
					<li class="meta-size">
						<span class="meta-label"><?php _e( 'Room Size', 'opal-hotel-room-booking' ); ?></span>
						<span class="meta-text"><?php printf( '%s', $opalhotel_room->room_size ); ?></span>
					</li>
				<?php endif; ?>
				<?php if ( $opalhotel_room->bed ) : ?>
					<li class="meta-bed">
						<span class="meta-label"><?php _e( 'Bed', 'opal-hotel-room-booking' ); ?></span>
						<span class="meta-text"><?php printf( '%s', $opalhotel_room->bed ); ?></span>
					</li>
				<?php endif; ?>
				<?php if ( $opalhotel_room->view ) : ?>
					<li class="meta-view">
						<span class="meta-label"><?php _e( 'View', 'opal-hotel-room-booking' ); ?></span>
						<span class="meta-text"><?php printf( '%s', $opalhotel_room->view ); ?></span>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<div class="room-except">
		<?php echo $room->data->post_excerpt;?>
	</div>
	
</div>