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

// opalhotel_get_template_part( 'content-hotel', opalhotel_loop_display_mode() );

// We only have grid style right now.
opalhotel_get_template_part( 'content-hotel', 'grid' );