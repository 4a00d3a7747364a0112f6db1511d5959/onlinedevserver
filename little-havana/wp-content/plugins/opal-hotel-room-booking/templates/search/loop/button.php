<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/loop/button.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>

<?php wp_nonce_field( 'opalhotel_add_to_cart', 'opalhotel-add_to-cart' ); ?>
<input type="hidden" name="arrival" value="<?php echo esc_attr( $room->arrival ) ?>" />
<input type="hidden" name="departure" value="<?php echo esc_attr( $room->departure ) ?>" />
<input type="hidden" name="id" value="<?php echo esc_attr( $room->id ) ?>" />
<input type="hidden" name="action" value="opalhotel_add_to_cart" />
<button type="subbmit" class="button opalhotel-button-submit button-primary-inverse button-block"><?php _e( 'Book This Room', 'opal-hotel-room-booking' ); ?></button>