<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>
<a href="<?php echo esc_attr( get_the_permalink() ) ?>" class="opalhotel-hotel-details">
	<?php _e( 'View Details','opal-hotel-room-booking' ); ?>
</a>
