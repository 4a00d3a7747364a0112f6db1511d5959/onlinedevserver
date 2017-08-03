<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 09:34:10
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-08 14:03:37
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Shortcode_Rooms extends OpalHotel_Abstract_Shortcode {

	/* shortcode name */
	public $shortcode = null;

	public function __construct() {
		$this->shortcode = 'opalhotel_rooms';
		parent::__construct();
	}

	/* render */
	public function render( $atts = array(), $content = null ) {

		$atts = shortcode_atts( array(
				'room_cat'			=> '',
				'room_tag'			=> '',
				'number_of_rooms'	=> 10,
				'order'				=> 'DESC',
				'orderby'			=> 'ID'
			), $atts, 'opalhotel_rooms' );

		$taxonomy = array();
		$atts['post_type']	= 'opalhotel_room';
		if ( $atts['room_cat'] || $atts['room_tag'] ) {

			$room_cat = explode( ',', $atts['room_cat'] );
			if ( count( $room_cat ) > 0 ) {
				if ( ! isset( $atts['tax_query'] ) ) {
					$atts['tax_query']	= array();
				}
				$atts['tax_query'][]	= array(
						'taxonomy'	=> 'opalhotel_room_cat',
						'field'		=> 'slug',
						'terms'		=> $room_cat
					);
			}

			$room_tag = explode( ',', $atts['room_tag'] );
			if ( $room_tag ) {
				if ( ! isset( $atts['tax_query'] ) ) {
					$atts['tax_query']	= array();
				}
				if ( count( $atts['tax_query'] ) > 0 && ! isset( $atts['tax_query']['relation'] ) ) {
					$atts['tax_query']['relation'] = 'OR';
					$atts['tax_query'][]	= array(
						'taxonomy'	=> 'opalhotel_room_tag',
						'field'		=> 'slug',
						'terms'		=> $room_tag
					);
				}
			}
		}

		if ( $atts['number_of_rooms'] ) {
			$atts['posts_per_page']	= absint( $atts['number_of_rooms'] );
		}

		$atts['paged'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		$opalhotel_query = new WP_Query( $atts ); ?>

		<div class="opalhotel-wrapper opalhotel">

			<?php if ( $opalhotel_query->have_posts() ) : ?>

				<?php
					/**
					 * opalhotel_before_room_loop hook.
					 *
					 * @hooked opalhotel_result_count - 20
					 * @hooked opalhotel_catalog_ordering - 30
					 */
					do_action( 'opalhotel_before_room_loop', $opalhotel_query );
				?>

				<ul class="opalhotel-main rooms">
					<?php while ( $opalhotel_query->have_posts() ) : $opalhotel_query->the_post(); ?>

						<?php opalhotel_get_template_part( 'content', 'room' ); ?>

					<?php endwhile; // end of the loop. ?>
				</ul>

				<?php
					/**
					 * opalhotel_after_room_loop hook.
					 *
					 * @hooked opalhotel_archive_pagination - 5
					 */
					do_action( 'opalhotel_after_room_loop', $opalhotel_query );
				?>

			<?php else : ?>

				<?php opalhotel_get_template( 'loop/no-room-found.php' ); ?>

			<?php endif; wp_reset_postdata(); ?>

		</div>
	<?php }

}