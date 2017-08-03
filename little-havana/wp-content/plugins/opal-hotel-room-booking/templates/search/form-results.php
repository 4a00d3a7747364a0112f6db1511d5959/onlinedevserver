<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/search/form-results.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/* print notices */
opalhotel_print_notices();

?>

<div class="opalhotel-wrapper">
	<ul class="opalhotel-search-results opalhotel_main rooms">
		<?php foreach ( $rooms as $room ) : ?>
			<?php opalhotel_get_template( 'search/content-room.php', array( 'room' => $room ) ); ?>
		<?php endforeach; ?>
	</ul>

	<?php if( $pagination->total > 1 ): ?> 
	<nav class="opalhotel-pagination">
		<ul class="opalhotel-pagination-available page-numbers">
			<?php
				if ( $pagination->total > 1 && $pagination->paged > 1 ) {
					echo '<li><a href="#" class="prev page-numbers opalhotel-page" data-page="' . esc_attr( $pagination->paged - 1 ) . '" data-arrival="' . esc_attr( $arrival ) . '" data-step="2" data-departure="' . esc_attr( $departure ) . '">' . __( '&larr; Previous', 'opal-hotel-room-booking' ) . '</a></li>';
				}

				for ( $i = 1; $i <= $pagination->total; $i++ ) {
					if ( $i == $pagination->paged ) {
						echo '<li><span class="page-numbers current">' . $i . '</span></li>';
					} else {
						echo '<li><a href="#" class="page-numbers opalhotel-page" data-step="2" data-page="' . esc_attr( $i ) . '" data-arrival="' . esc_attr( $arrival ) . '" data-departure="' . esc_attr( $departure ) . '">' . $i . '</a></li>';
					}
				}

				if ( $pagination->paged < $pagination->total && $pagination->total > 1 ) {
					echo '<li><a href="#" class="next page-numbers opalhotel-page" data-step="2" data-page="' . esc_attr( $pagination->paged + 1 ) . '" data-arrival="' . esc_attr( $arrival ) . '" data-departure="' . esc_attr( $departure ) . '">' . __( 'Next &rarr;', 'opal-hotel-room-booking' ) . '</a></li>';
				}
			?>
		</ul>
	</nav>
	<?php endif ?>
</div>