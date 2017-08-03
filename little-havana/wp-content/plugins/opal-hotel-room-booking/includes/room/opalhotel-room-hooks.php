<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

add_filter( 'manage_opalhotel_room_posts_columns', 'opalhotel_room_manage_posts_columns', 99 );
if ( ! function_exists( 'opalhotel_room_manage_posts_columns' ) ) {

	// manage add room post type columns
	function opalhotel_room_manage_posts_columns( $columns ) {

		unset( $columns['title'] );
		unset( $columns['author'] );
		unset( $columns['comments'] );

		$add_columns = array(
				'cb'				=> '<input type="checkbox" />',
				'title'			=> __( 'Name', 'opal-hotel-room-booking' ),
				'thumb'				=> '<span class="opalhotel_tiptip" data-tip="' . esc_attr__( 'Image', 'opal-hotel-room-booking' ) . '"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>',
				'base_price'		=> __( 'Base Price', 'opal-hotel-room-booking' ),
				'room_cat'			=> __( 'Categories', 'opal-hotel-room-booking' ),
				'room_tag'			=> __( 'Tags', 'opal-hotel-room-booking' ),
			);

		return array_merge( $add_columns, $columns );
	}
}
add_action( 'manage_opalhotel_room_posts_custom_column', 'opalhotel_room_manage_posts_custom_columns', 1 );
if ( ! function_exists( 'opalhotel_room_manage_posts_custom_columns' ) ) {

	/* room custom columns */
	function opalhotel_room_manage_posts_custom_columns( $column ) {
		global $post; global $opalhotel_room;
		switch ( $column ) {
			case 'thumb':
				echo '<a href="' . get_edit_post_link( $post->ID ) . '">'
					. ( $opalhotel_room->has_discounts() ? '<img class="sale_icon" src="' . OPALHOTEL_URI . '/assets/images/sale_icon.png' . '" />' : '' )
					. opalhotel_room_placeholder_image( 'room_thumb' )
					. '</a>';
				break;

			case 'title':
				echo '<a href="' . get_edit_post_link( $post->ID ) . '"><strong>' . get_the_title( $post->ID ) . '</strong></a>';
				break;

			case 'base_price':
				printf( '%s', opalhotel_format_price( $opalhotel_room->base_price() ) );
				break;

			case 'room_cat':
				$terms = wp_get_post_terms( $post->ID, 'opalhotel_room_cat' );
				if ( $terms ) {
					$html = array();
					foreach ( $terms as $term ) {
						$html[] = '<a href="' . get_edit_term_link( $term->term_id, $term->taxonomy ) . '">' . $term->name . '</a>';
					}
					echo implode( ', ', $html );
				} else {
					echo '---';
				}
				break;

			case 'room_tag':
				$terms = wp_get_post_terms( $post->ID, 'opalhotel_room_tag' );
				if ( $terms ) {
					$html = array();
					foreach ( $terms as $term ) {
						$html[] = '<a href="' . get_edit_term_link( $term->term_id, $term->taxonomy ) . '">' . $term->name . '</a>';
					}
					echo implode( ', ', $html );
				} else {
					echo '---';
				}
				break;

			default:
				# code...
				break;
		}
	}
}
