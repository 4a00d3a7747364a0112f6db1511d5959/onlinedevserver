<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/loop/thumbnail.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>

<div class="opalhotel-catalog-thumbnail">
	<div class="room-thumbnail">
		<a href="<?php echo esc_attr( wp_get_attachment_url( get_post_thumbnail_id(  $room->id ) ) ); ?>" class="opalhotel-lightbox" rel="opalhotel-fancybox-<?php echo esc_attr( $room->id ) ?>">
			<?php echo opalhotel_room_get_catalog_thumbnail( $room->id ) ?>
		</a>
	</div>
	<?php opalhotel_get_template( 'search/loop/gallery.php', array( 'room' => $room ) ); ?>
</div>