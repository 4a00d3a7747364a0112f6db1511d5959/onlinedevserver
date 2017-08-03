<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! function_exists( 'opalhotel_enable_review' ) ) {
	/* enable review*/
	function opalhotel_enable_review() {
		return apply_filters( 'opalhotel_enable_review', get_option( 'opalhotel_room_enable_review' ) );
	}
}

if ( ! function_exists( 'opalhotel_get_room' ) ) {
	/* get room */
	function opalhotel_get_room( $room_id = null, $args = array() ) {
		return new OpalHotel_Room( $room_id, $args );
	}
}

if ( ! function_exists( 'opalhotel_room_discount_types' ) ) {

	/* return dicount types */
	function opalhotel_room_discount_types() {
		return apply_filters( 'opalhotel_room_discount_types', array(
				'before'		=> __( 'Before Days', 'opal-hotel-room-booking' ), // before day book
				'live'			=> __( 'Stay Days', 'opal-hotel-room-booking' ) // time stay
			) );
	}
}

if ( ! function_exists( 'opalhotel_room_discount_sale_types' ) ) {

	/* return dicount sale types */
	function opalhotel_room_discount_sale_types() {
		return apply_filters( 'opalhotel_room_discount_sale_types', array(
				'subtract'		=> __( 'Subtract Price', 'opal-hotel-room-booking' ),
				'decrease'		=> __( 'Decrease % Price', 'opal-hotel-room-booking' )
			) );
	}
}

if ( ! function_exists( 'opalhotel_room_get_package_details' ) ) {

	/* return package of room */
	function opalhotel_room_get_package_details( $room_id = null ) {
		if ( ! $room_id ) { return; }

		$package_ids = get_post_meta( $room_id, '_package_id' );

		if ( ! $package_ids ) { return; }

		$packages = array();
		foreach ( $package_ids as $k => $id ) {
			if ( get_post( $id ) && get_post_status( $id ) ) {
				$packages[] = OpalHotel_Package::instance( $id );
			}
		}
		wp_reset_postdata();
		return apply_filters( 'opalhotel_room_get_package_details', $packages, $package_ids );
	}

}

if ( ! function_exists( 'opalhotel_days_display' ) ) {

	/* convert days => weeks, month display in discounts */
	function opalhotel_days_display( $days = null ) {
		$html = array();
		if ( $days >= 1 && $days < 7  ) {
			$html[] = sprintf( translate_nooped_plural( _n_noop( '%s day', '%s days' ), $days, 'opal-hotel-room-booking' ), $days );
		} else if ( $days >= 7 && $days < 31 ) {
			$unit =  floor( $days / 7 );
			$html[] = sprintf( translate_nooped_plural( _n_noop( '%s week', '%s weeks' ), $unit, 'opal-hotel-room-booking' ), $unit );
			if ( $days % 7 !== 0 ) {
				$days = floor( $days - $unit * 7 );
				$html[] = sprintf( translate_nooped_plural( _n_noop( '%s day', '%s days' ), $days, 'opal-hotel-room-booking' ), $days );
			}
		} else if ( $days >= 31 ) {
			$unit = floor( $days / 31 );
			$html[] = sprintf( translate_nooped_plural( _n_noop( '%s month', '%s months' ), $unit, 'opal-hotel-room-booking' ), $unit );
			$days = $days - $unit * 31;
			if ( $days >= 7 ) {
				$unit = floor( $days / 7 );
				if ( $unit <= 3 ) {
					$html[] = sprintf( translate_nooped_plural( _n_noop( '%s week', '%s weeks' ), $unit, 'opal-hotel-room-booking' ), $unit );
					$days = $days - $unit * 7;
				}

				if ( $days <= 7 ) {
					$html[] = sprintf( translate_nooped_plural( _n_noop( '%s day', '%s days' ), $unit, 'opal-hotel-room-booking' ), $days );
				}
			} else {
				$html[] = sprintf( translate_nooped_plural( _n_noop( '%s day', '%s days' ), $days, 'opal-hotel-room-booking' ), $days );
			}
		}

		return implode( ' ', $html );
	}

}

if ( ! function_exists( 'opalhotel_room_get_catalog_thumbnail' ) ) {

	/* get the thumbnail catalog */
	function opalhotel_room_get_catalog_thumbnail( $post_id = null ) {
		$room = null;
		if ( ! $post_id ) {
			global $opalhotel_room;
			$room = $opalhotel_room;
		} else {
			$room = OpalHotel_Room::instance( $post_id );
		}
		return $room->get_catalog_thumbnail();
	}

}

if ( ! function_exists( 'opalhotel_get_room_available' ) ) {

	/**
	 * opalhotel_get_room_available
	 * get room availabel in storge
	 * number of room - room booked - block room
	 * @param  array( 'start' => timestamp, 'end' => timestamp )
	 * @return array room object available
	 */
	function opalhotel_get_room_available( $args = array() ) {
		global $wpdb;
		/* arrival and departure */
		$arrival = isset( $args['arrival'] ) ? absint( $args['arrival'] ) : current_time( 'mysql', 1 );
		$departure = isset( $args['departure'] ) ? absint( $args['departure'] )  : current_time( 'mysql', 1 );
		$arrival = strtotime( date( 'Y-m-d', $arrival ) );
		$departure = strtotime( date( 'Y-m-d', $departure ) );
		$night = opalhotel_count_nights( $arrival, $departure );
		$adult = isset( $args['adult'] ) ? absint( $args['adult'] ) : 0;
		$child = isset( $args['child'] ) ? absint( $args['child'] ) : 0;

		$terms = get_terms( 'opalhotel_room_cat', array(
				'hide_empty'	=> false
			) );

		$room_types = array();
		foreach ( $terms as $term ) {
			$room_types[] = $term->term_id;
		}

		if ( isset( $args['room_type'] ) && ( $room_type = absint( $args['room_type'] ) ) && $room_type ) {
			$room_types = array_intersect( $room_types, array( $args['room_type'] ) );
		}

		$args = compact( $arrival, $departure, $night, $adult, $child, $room_types );

		$unavailable = $wpdb->prepare("
			(
				SELECT COALESCE( SUM( meta.meta_value ), 0 ) FROM $wpdb->opalhotel_order_itemmeta AS meta
					INNER JOIN $wpdb->opalhotel_order_items AS item ON meta.opalhotel_order_item_id = item.order_item_id AND meta.meta_key = %s
					INNER JOIN $wpdb->posts AS ordered ON ordered.ID = item.order_id
					INNER JOIN $wpdb->opalhotel_order_itemmeta AS arrival ON arrival.opalhotel_order_item_id = item.order_item_id AND arrival.meta_key = %s
					INNER JOIN $wpdb->opalhotel_order_itemmeta AS departure ON departure.opalhotel_order_item_id = item.order_item_id AND departure.meta_key = %s
					INNER JOIN $wpdb->opalhotel_order_itemmeta AS itemmeta ON item.order_item_id = itemmeta.opalhotel_order_item_id AND itemmeta.meta_key = %s
				WHERE
					itemmeta.meta_value = rooms.ID
					AND (
						( arrival.meta_value >= %d AND arrival.meta_value <= %d )
						OR ( departure.meta_value > %d AND departure.meta_value <= %d )
						OR ( arrival.meta_value <= %d AND departure.meta_value > %d )
					)
					AND ordered.post_type = %s
					AND ordered.post_status IN ( %s, %s, %s, %s )
			)
			", 'qty', 'arrival', 'departure', 'product_id',
				$arrival, $departure,
				$arrival, $departure,
				$arrival, $departure,
				'opalhotel_booking', 'opalhotel-on-hold', 'opalhotel-pending', 'opalhotel-processing', 'opalhotel-completed'
			);

		$unavailable = apply_filters( 'opalhotel_check_available_subquery', $unavailable, $args );

		$select = apply_filters( 'opalhotel_check_available_select', "rooms.*, ( total.meta_value - $unavailable ) AS available FROM $wpdb->posts AS rooms", $args );

		$join = $wpdb->prepare("
			INNER JOIN $wpdb->postmeta AS adult ON adult.post_id = rooms.ID AND adult.meta_key = %s
			INNER JOIN $wpdb->postmeta AS child ON child.post_id = rooms.ID AND child.meta_key = %s
			INNER JOIN $wpdb->postmeta AS total ON total.post_id = rooms.ID AND total.meta_key = %s
			INNER JOIN $wpdb->postmeta AS night ON night.post_id = rooms.ID AND night.meta_key = %s
		", '_adults', '_childrens', '_qty', '_min_night');
		if ( isset( $args['room_type'] ) && ( $room_type = absint( $args['room_type'] ) ) && $room_type ) {
			$join .= "INNER JOIN $wpdb->term_relationships AS term ON term.object_id = rooms.ID";
		}
		$join = apply_filters( 'opalhotel_check_available_join', $join, $args );

		$where = $wpdb->prepare("
			rooms.post_type = %s
			AND rooms.post_status = %s
			AND ( ( night.meta_value = null OR night.meta_value = 0 ) OR night.meta_value <= %d )
		", 'opalhotel_room', 'publish', $night );

		$setup_max_adult = get_option( 'opalhotel_search_available_max_adult' );
		$setup_max_child = get_option( 'opalhotel_search_available_max_child' );
		if ( ! $setup_max_adult && ! $setup_max_child ) {
			$where .= $wpdb->prepare("
					AND ( adult.meta_value = null OR adult.meta_value >= %d )
					AND ( child.meta_value = null OR child.meta_value >= %d )
				", $adult, $child);
		}

		if ( isset( $args['room_type'] ) && ( $room_type = absint( $args['room_type'] ) ) && $room_type ) {
			$where .= "AND term.term_taxonomy_id IN ( ".implode(',', $room_types)." )";
		}
		$where = apply_filters( 'opalhotel_check_available_where', $where, $args );

		$sql = "SELECT $select $join WHERE $where GROUP BY rooms.ID HAVING available > 0";

		$sql_results = apply_filters( 'opalhotel_sql_results', $wpdb->get_results( $sql ), $sql, $args );

		$results = array();
		if ( $sql_results ) {
			foreach ( $sql_results as $k => $result ) {
				$results[] = OpalHotel_Room::instance( $result->ID, array(
						'arrival'		=> $arrival,
						'departure'		=> $departure,
						'max_qty'		=> $result->available,
						'adult'			=> $adult,
						'child'			=> $child,
						'quantity'		=> 1
					) );
			}
		}

		return apply_filters( 'opalhotel_get_room_available', $results, $args );
	}

}

if ( ! function_exists( 'opalhotel_room_check_available' ) ) {

	/* check room available beetwen arrival date and departure date */
	function opalhotel_room_check_available( $room_id = null, $arrival = null, $departure = null, $qty = 1 ) {
		global $wpdb;
		$arrival = strtotime( date( 'Y-m-d', $arrival ) );
		$departure = strtotime( date( 'Y-m-d', $departure ) );

		$sql = $wpdb->prepare("
				SELECT COALESCE( SUM( meta.meta_value ), 0 ) AS unavailable, COALESCE( roommeta.meta_value, 0 ) AS total, ordered.ID FROM $wpdb->opalhotel_order_itemmeta AS meta
					INNER JOIN $wpdb->opalhotel_order_items AS item ON meta.opalhotel_order_item_id = item.order_item_id AND meta.meta_key = %s
					INNER JOIN $wpdb->posts AS ordered ON ordered.ID = item.order_id
					INNER JOIN $wpdb->opalhotel_order_itemmeta AS arrival ON arrival.opalhotel_order_item_id = item.order_item_id AND arrival.meta_key = %s
					INNER JOIN $wpdb->opalhotel_order_itemmeta AS departure ON departure.opalhotel_order_item_id = item.order_item_id AND departure.meta_key = %s
					INNER JOIN $wpdb->opalhotel_order_itemmeta AS itemmeta ON item.order_item_id = itemmeta.opalhotel_order_item_id AND itemmeta.meta_key = %s
					INNER JOIN $wpdb->posts AS room ON room.ID = itemmeta.meta_value
					INNER JOIN $wpdb->postmeta AS roommeta ON roommeta.post_id = room.ID AND roommeta.meta_key = %s
				WHERE
					room.ID = %d
					AND (
						( arrival.meta_value >= %d AND arrival.meta_value <= %d )
						OR ( departure.meta_value > %d AND departure.meta_value <= %d )
						OR ( arrival.meta_value <= %d AND departure.meta_value > %d )
					)
					AND ordered.post_type = %s
					AND ordered.post_status IN ( %s, %s, %s, %s )
				HAVING ordered.ID IS NOT NULL;
			", 'qty', 'arrival', 'departure', 'product_id', '_qty', absint( $room_id ),
				$arrival, $departure,
				$arrival, $departure,
				$arrival, $departure,
				'opalhotel_booking', 'opalhotel-on-hold', 'opalhotel-pending', 'opalhotel-processing', 'opalhotel-completed'
			);

		$results = $wpdb->get_row( $sql );
		if ( $results ) {
			$results->total = $results->total ? $results->total : get_post_meta( $room_id, '_qty', true );
			$available = $results->total - $results->unavailable;
			if ( ! $available || $available < $qty ) {
				return false;
			}
			return $available;
		}
		$room = OpalHotel_Room::instance( $room_id );
		return $room->qty;
	}

}

if ( ! function_exists( 'opalhotel_count_nights' ) ) {

	function opalhotel_count_nights( $start = null, $end = null ) {
		if ( ! $start ) {
			$start = time();
		}

		if ( ! $end ) {
			$end = time();
		}

		$end = strtotime( date( 'Y-m-d', $end ) );
		$start = strtotime( date( 'Y-m-d', $start ) );

		if ( $end < $start ) {
			throw new Exception( __( 'Start day must before end day.', 'opal-hotel-room-booking' ) );
		}
		$days = floor( ( $end - $start ) / ( 24 * HOUR_IN_SECONDS ) );

		return $days;
	}
}

if ( ! function_exists( 'opalhotel_select_room_types' ) ) {

	function opalhotel_select_room_types( $args = array() ) {
		$args = wp_parse_args( $args, array(
				'name'		=> '',
				'id'		=> '',
				'class'		=> '',
				'selected'	=> '',
				'none_select'	=> ''
			) );

		$terms = get_terms( 'opalhotel_room_cat', apply_filters( 'opalhotel_select_room_type_args', array(
				'hide_empty'	=> false
			) ) );

		?>
			<select name="<?php echo esc_attr( $args['name'] ) ?>" <?php echo isset( $args['id'] ) ? 'id="'.esc_attr( $args['id'] ).'"' : '' ?> <?php echo isset( $args['class'] ) ? 'class="'.esc_attr( $args['class'] ).'"' : '' ?>>
				<?php if ( $args['none_select'] ) : ?>
					<option value="0"><?php echo esc_html( $args['none_select'] ) ?></option>
				<?php endif; ?>
				<?php foreach ( $terms as $term ) : ?>
					<option value="<?php echo esc_attr( $term->term_id ); ?>"<?php selected( $args['selected'], $term->term_id ) ?>><?php echo esc_html( $term->name ) ?></option>
				<?php endforeach; ?>
			</select>
		<?php
	}
}

if ( ! function_exists( 'opalhotel_get_room_price_by_day' ) ) {
	function opalhotel_get_room_price_by_day( $args = array() ) {
		global $wpdb;
        $args = wp_parse_args( $args, array(
                'room_id'   => '',
                'arrival'   => current_time( 'timestamp', 1 )
            ) );
        $arrival = date( 'Y-m-d', $args['arrival'] );
		$sql = $wpdb->prepare("
				SELECT price FROM $wpdb->opalhotel_pricing WHERE room_id = %d AND date( arrival ) = %s
			", absint( $args['room_id'] ), $arrival );

		$price = $wpdb->get_var( $sql );
		if ( $price === null ) {
			$room = OpalHotel_Room::instance( $args['room_id'] );
			$price = $room->base_price();
			unset( $room );
		}

		return apply_filters( 'opalhotel_room_price_by_day', $price, $args );
	}
}

if ( ! function_exists( 'opalhotel_remove_price_by_day' ) ) {
    /* remove room pricing by day */
    function opalhotel_remove_price_by_day( $args = array() ) {
        global $wpdb;
        $args = wp_parse_args( $args, array(
                'room_id'   => '',
                'arrival'   => current_time( 'timestamp' )
            ) );
        $arrival = date( 'Y-m-d H:i:s', $args['arrival'] );
        if ( ! isset( $args['departure'] ) ) {
            $sql = $wpdb->prepare("
                    DELETE FROM {$wpdb->prefix}opalhotel_pricing
                    FROM $wpdb->opalhotel_pricing
                    WHERE room_id = %d AND arrival = %s
                ", $room_id, $arrival );
        } else {
            $days = opalhotel_count_nights( $args['arrival'], $args['departure'] );
            $arrival_range = array();
            for ( $i = 0; $i < $days; $i++ ) {
                $arrival_range[] = $arrival + $i * DAY_IN_SECONDS;
            }

            $sql = $wpdb->prepare("
                    SELECT FROM {$wpdb->prefix}opalhotel_pricing
                    FROM $wpdb->opalhotel_pricing
                    WHERE room_id = %d AND arrival IN ( %s )
                ", $room_id, implode( ',', $arrival ) );
        }
        return apply_filters( 'opalhotel_remove_price_by_day', $wpdb->query( $sql ) );
    }
}

if ( ! function_exists( 'opalhotel_update_pricing' ) ) {
    /* update pricing */
    function opalhotel_update_pricing( $room_id = null, $arrival = null, $price = 0 ) {
        if ( ! $room_id || ! $arrival ) {
            return;
        }

        $arrival = date( 'Y-m-d H:i:s', $arrival );
        global $wpdb;
        $wpdb->replace(
                $wpdb->prefix . 'opalhotel_pricing',
                array(
                        'room_id'       => $room_id,
                        'arrival'       => $arrival,
                        'price'         => $price
                    ),
                array(
                        '%d',
                        '%s',
                        '%s'
                    )
            );
        return apply_filters( 'opalhotel_update_pricing', $wpdb->insert_id );
    }

}

if ( ! function_exists( 'opalhotel_get_room_prices' ) ) {

	function opalhotel_get_room_prices( $room_id = null ) {
		global $wpdb;
		$sql = $wpdb->prepare("
				SELECT arrival, price FROM $wpdb->opalhotel_pricing WHERE room_id = %d
			", $room_id );
		$results = $wpdb->get_results( $sql );
		return apply_filters( 'opalhotel_get_room_prices', $results, $room_id );
	}
}

if ( ! function_exists( 'opalhotel_get_current_week_pricing' ) ) {

	function opalhotel_get_current_week_pricing( $id = null ) {
		if ( ! $id ) { return; }
		// $mon_day = strtotime( date( 'Y-m-d', strtotime('monday this week', time()) ) );
		// $sun_day = strtotime( date( 'Y-m-d', strtotime('sunday this week', time()) ) );

		$mon_day = strtotime( date( 'Y-m-d', strtotime('monday this week', time()) ) );
		$sun_day = $mon_day + 6 * DAY_IN_SECONDS;
		$results = array();
		$date_range = opalhotel_count_nights( $mon_day, $sun_day );
		for ( $i = 0; $i <= $date_range; $i++ ) {
			$arrival = $mon_day + $i * DAY_IN_SECONDS;
			$results[ $arrival ] = opalhotel_get_room_price_by_day( array(
					'room_id' 	=> $id,
					'arrival'	=> $arrival
				) );
		}
		return $results;
	}

	function opalhotel_get_next_week_pricing( $id = null ) {
		if ( ! $id ) { return; }
		// $mon_day = strtotime( date( 'Y-m-d', strtotime('monday next week', time()) ) );
		// $sun_day = strtotime( date( 'Y-m-d', strtotime('sunday next week', time()) ) );

		$mon_day = strtotime( date( 'Y-m-d', strtotime('monday next week', time()) ) );
		$sun_day = $mon_day + 6 * DAY_IN_SECONDS;
		$results = array();
		$date_range = opalhotel_count_nights( $mon_day, $sun_day );
		for ( $i = 0; $i <= $date_range; $i++ ) {
			$arrival = $mon_day + $i * DAY_IN_SECONDS;
			$results[ $arrival ] = opalhotel_get_room_price_by_day( array(
					'room_id' 	=> $id,
					'arrival'	=> $arrival
				) );
		}
		return $results;
	}

}

if ( ! function_exists( 'opalhotel_get_related_room' ) ) {
	function opalhotel_get_related_room( $room_id = null ) {
		$terms = wp_get_object_terms( $room_id, array( 'opalhotel_room_cat', 'opalhotel_room_tag' ), array('fields' => 'ids') );

		$args = array(
			'post_type' 		=> 'opalhotel_room',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 3,
			'orderby' 			=> 'rand',
			'tax_query' => array(
			    'relation' => 'OR',
			    array(
			        'taxonomy' => 'opalhotel_room_cat',
			        'field' => 'id',
			        'terms' => $terms
			    ),
			    array(
			        'taxonomy' => 'opalhotel_room_tag',
			        'field' => 'id',
			        'terms' => $terms
			    ),
			),
			'post__not_in' => array( $room_id )
		);
		$results = new WP_Query( apply_filters( 'opalhotel_related_room_args', $args ) );
		wp_reset_postdata();
		return $results;
	}
}