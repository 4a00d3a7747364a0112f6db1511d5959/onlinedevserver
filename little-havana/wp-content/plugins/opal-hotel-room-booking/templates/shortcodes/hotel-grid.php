<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/shortcodes/hotel-grid.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( $query->have_posts() ) : ?>

	<div class="opalhotel-main hotels opal-hotel-grid">
		<div class="grid-row">
			<?php while ( $query->have_posts() ) {
				$query->the_post();

				opalhotel_get_template_part( 'content-hotel', 'grid' );

			} wp_reset_postdata(); ?>
		</div>
	</div>

<?php endif; ?>