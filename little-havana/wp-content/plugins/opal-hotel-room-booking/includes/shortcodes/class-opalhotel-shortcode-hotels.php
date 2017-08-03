<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Shortcode_Hotels extends OpalHotel_Abstract_Shortcode {

	/* shortcode name */
	public $shortcode = null;

	public function __construct() {
		$this->shortcode = 'opalhotel_hotels_grid';
		parent::__construct();
	}

	/* render */
	public function render( $atts = array(), $content = null ) {
		
		$atts = shortcode_atts( array(
				'posts_per_page'	=> 5,
				'category'			=> null,
				'order'				=> 'DESC',
				'ordeby'			=> 'date',
				'post__in'			=> array(),
				'columns'			=> 3
			), $atts );
		extract( $atts );
		if ( $category ) {
			if ( is_string( $category ) ) {
				$category = array_map( 'trim', explode( ',', $category ) );
			}
		}
		$args = array(
				'post_type'	=> 'opalhotel_hotel',
				'posts_per_page'	=> absint( $posts_per_page ),
				'order'			=> $order,
				'orderby'		=> $ordeby
			);

		if ( $category ) {
			$args['tax_query'] = array();
			$args['tax_query'][] = array(
					'taxonomy'	=> 'opalhotel_hotel_cat',
					'field'		=> 'term_id',
					'terms'		=> $category,
					'operator'	=> 'IN'
				);
		}

		if ( $post__in ) {
			if ( is_string( $post__in ) ) {
				$post__in = array_map( 'trim', explode( ',', $post__in ) );
			}
			$args['post__in'] = $post__in;
		}

		global $opalhotel_loop;
		$opalhotel_loop['columns'] = $columns;
		$query = new WP_Query( apply_filters( 'opalhotel_shortcode_hotels', $args ) );
		opalhotel_get_template( 'shortcodes/hotel-grid.php', array( 'query' => $query ) );
		unset( $opalhotel_loop['columns'] );
	}

}
