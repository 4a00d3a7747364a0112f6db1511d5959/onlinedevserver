<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/loop/title.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>

<h3 class="room-title">
	<a href="<?php echo esc_attr( get_the_permalink( $room->id ) ) ?>">
		<?php printf( '%s', $room->post_title ) ?>
	</a>
</h3>