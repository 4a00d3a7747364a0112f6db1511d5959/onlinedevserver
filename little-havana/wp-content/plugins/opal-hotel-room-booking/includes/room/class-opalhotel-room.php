<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Room extends OpalHotel_Abstract_Service {

	/* uniqid key */
	public $uniqid_key = null;

	/* $id property */
	public $id = null;

	// instance insteadof new class
	static $instance = null;

	/* quantity */
	public $quantity = 1;

	/* arrival date */
	public $arrival = null;

	/* departure date */
	public $departure = null;

	public $night = 1;

	/* constructor set object data */
	public function __construct( $id = null, $args = array() ) {
		parent::__construct( $id, $args );

		$this->uniqid_key = opalhotel_generate_uniqid_hash( $args );

		$this->arrival = strtotime( date( 'Y-m-d', $this->arrival ) );
		$this->departure = strtotime( date( 'Y-m-d', $this->departure ) );

		$this->night = opalhotel_count_nights( $this->arrival, $this->departure );
	}

	/* get base price */
	public function base_price() {
		return apply_filters( 'opalhotel_room_base_price', floatval( get_post_meta( $this->id, '_base_price', true ) ) );
	}

	/* get price */
	public function get_price() {
		/* get extra price */
		$extra_prices = $this->get_extras_details();
		/* get discounts details */
		$discount = $this->get_discounts_details();

		/* price */
		$adult = $this->adult - $this->get_max_adults_allowed();
		$child = $this->child - $this->get_max_childrens_allowed();
		// $price = $this->base_price();
		$price = array_sum( $this->get_pricing() );
		if ( $extra_prices ) {
			foreach ( $extra_prices as $k => $extra ) {
				/* $k is 'adult' or 'child' */
				if ( $k === 'adult' && array_key_exists( $adult, $extra ) ) {
					$price += $extra[ $adult ];
				} else if( $k === 'child' && array_key_exists( $child, $extra ) ) {
					$price += $extra[ $child ];
				}
			}
		}

		/* each discount and subtract base price */
		if ( $discount ) {
			if ( $discount['sale_type'] === 'subtract' ) {
				$discount_amount = floatval( $discount['amount'] );
				if ( $price > $discount_amount ) {
					$price -= $discount_amount * $this->quantity;
				}
			} else if ( $discount['sale_type'] === 'decrease' ) {
				$discount_amount = ( $price * floatval( $discount['amount'] ) ) / 100;
				$price -= $discount_amount * $this->quantity;
			}
		}
		return apply_filters( 'opalhotel_room_price', floatval( $price ), $this->id );
	}

	public function get_discounts_prices_info() {
	 	$types 		= opalhotel_room_discount_types(); // discount types
		$sale_types = opalhotel_room_discount_sale_types(); // sale types

		$discounts = $this->get_discounts();

		if( $discounts ){
			foreach( $discounts as $key => $discount ) {
				$discount['type_label'] = isset( $types[$discount['type']] ) ? $types[$discount['type']] : __( 'Unknown Type', 'opal-hotel-room-booking' );
				$discount['sale_type_label'] = isset( $sale_types[$discount['sale_type']] ) ? $sale_types[$discount['sale_type']] : __( 'Unknown Sale Type', 'opal-hotel-room-booking' );
				$discounts[$key] = $discount;
			}
		}

		return $discounts;
	}

	/* return true if has discount */
	public function has_discounts() {
		return apply_filters( 'opalhotel_room_has_discounts', ! empty( $this->discounts ), $this->id );
	}

	/* get discounts */
	public function get_discounts() {
		return apply_filters( 'opalhotel_room_get_discounts', $this->discounts, $this->id );
	}

	/* get price by arrival date and departure date */
	public function get_pricing( $arrival = null, $departure = null ) {
		$results = array();
		if ( ! $arrival ) {
			$arrival = $this->arrival;
		}
		if ( ! $departure ) {
			$departure = $this->departure;
		}
		$date_range = opalhotel_count_nights( $arrival, $departure );
		for ( $i = 0; $i < $date_range; $i++ ) {
			$n_arrival = $arrival + $i * DAY_IN_SECONDS;
			$results[ $n_arrival ] = opalhotel_get_room_price_by_day( array(
					'room_id' 	=> $this->id,
					'arrival'	=> $n_arrival
				) );
		}
		return $results;
	}

	/* get discount details */
	public function get_discounts_details() {
		if ( ! $this->has_discounts() ) {
			return false;
		}
		$current_time = time();
		$make_book_before = false;
		if ( $current_time + DAY_IN_SECONDS <= $this->arrival ) {
			$make_book_before = opalhotel_count_nights( $current_time, $this->arrival );
		}
		$discount_amount = false;

		foreach ( $this->discounts as $k => $discount ) {
			if ( $discount_amount ) continue;
			if ( $discount[ 'type' ] === 'before' ) {
				if ( $make_book_before && $make_book_before >= $discount['unit'] ) {
					$discount_amount = $discount;
				}
			} else if ( $discount[ 'type' ] === 'live' ) {
				if ( $this->night >= $discount['unit'] ) {
					$discount_amount = $discount;
				}
			}
		}

		return apply_filters( 'opalhotel_discount_details', $discount_amount, $this );
	}

	/* extra price. Eg. Adults, Childs*/
	public function has_extras() {
		return apply_filters( 'opalhotel_has_package', ! empty( $this->extra_adults ) || ! empty( $this->extra_childs ), $this->id );
	}

	/* get extras */
	public function get_extras_details() {
		$extras = array();
		$surplus_adult = $this->adult - $this->get_max_adults_allowed();
		$surplus_child = $this->child - $this->get_max_childrens_allowed();
		if ( $surplus_adult > 0 && $this->extra_adults ) {
			$adults = array();
			foreach ( $this->extra_adults as $k => $adult ) {
				if ( $adult['qty'] == absint( $surplus_adult ) ) {
					$adults[ $surplus_adult ] = floatval( $adult['price'] ) * $this->night * $this->quantity;
				}
			}
			if ( ! empty( $adults ) ) {
				$extras['adult'] = $adults;
			}
		}
		if ( $surplus_child > 0 && $this->extra_childs ) {
			$childs = array();
			foreach ( $this->extra_childs as $k => $child ) {
				if ( $child['qty'] == absint( $surplus_child ) ) {
					$childs[ $surplus_child ] = floatval( $child['price'] ) * $this->night * $this->quantity;
				}
			}
			if ( ! empty( $childs ) ) {
				$extras['child'] = $childs;
			}
		}

		return apply_filters( 'opalhotel_extras_details', $extras, $this );
	}

	public function get_extras_all_details() {
		$extras = array();

		if ( $this->extra_adults ) {
			$adults = array();
			foreach ( $this->extra_adults as $k => $adult ) {
				if ( empty( $adult['qty'] ) ) continue;
				$adults[ $adult['qty'] ] = floatval( $adult['price'] );
			}
			if ( ! empty( $adults ) ) {
				$extras['adult'] = $adults;
			}
		}
		if ( $this->extra_childs ) {
			$childs = array();
			foreach ( $this->extra_childs as $k => $child ) {
				if ( empty( $child['qty'] ) ) continue;
				$childs[ $child['qty'] ] = floatval( $child['price'] );
			}
			if ( ! empty( $childs ) ) {
				$extras['child'] = $childs;
			}
		}

		return apply_filters( 'opalhotel_extras_all_details', $extras, $this );
	}

	/* extra options */
	public function has_packages() {
		$_package_id = get_post_meta( $this->id, '_package_id' );
		return apply_filters( 'opalhotel_has_package', ! empty( $_package_id ), $this->id );
	}

	/* get packages */
	public function get_packages() {
		return opalhotel_room_get_package_details( $this->id );
	}

	/* get galleries full image */
	public function get_gallery_image_item( $id = null ) {
		return wp_get_attachment_image( $id, 'room_gallery', true );
	}

	/* get galleries url image */
	public function get_gallery_image_item_url( $id = null ) {
		$src = wp_get_attachment_image_src( $id, 'room_gallery', true );
		return $src[0];
	}

	/* get galleries thumb image */
	public function get_gallery_thumb_item( $id = null ) {
		return wp_get_attachment_image( $id, 'room_thumb', true );
	}

	/* get catalog thumbnail */
	public function get_catalog_thumbnail() {
		$attachment_id = get_post_thumbnail_id( $this->id );
		return get_the_post_thumbnail( $this->id, 'room_catalog', true );
	}

	/* get reviews */
	public function get_review_count() {
		return count( get_comments( array( 'post_id' => $this->id, 'status' => 'approve' ) ) );
	}

	public function get_max_adults_allowed() {
		return absint( $this->adults );
	}

	public function get_max_childrens_allowed() {
		return absint( $this->childrens );
	}

	public function need_calculate_adult_price() {
		return $this->adult - $this->get_max_adults_allowed() > 0;
	}

	public function need_calculate_child_price() {
		return $this->adult - $this->get_max_childrens_allowed() > 0;
	}

	public function get_hotels( $number = -1 ) {
		return get_posts( apply_filters( 'opalhotel_room_hotels', array(
				'post_type'			=> 'opalhotel_hotel',
				'post_status'		=> 'publish',
				'posts_per_page'	=> $number,
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'post__in'			=> get_post_meta( $this->id, '_hotel' )
			) ) );
	}

	/**
	 * instance insteadof new class
	 * @param  $room optional Eg: id, object
	 * @return object
	 */
	public static function instance( $room = null, $args = array() ) {
		$id = null;
		if ( $room instanceof WP_POST ) {
			$id = $room->ID;
		} else if ( is_numeric( $room ) ) {
			$id = $room;
		} else if ( is_object( $room ) && isset( $room->ID ) ) {
			$id = $room->ID;
		}

		if ( empty( self::$instance[ $id ] )
			|| self::$instance[ $id ]->uniqid_key !== opalhotel_generate_uniqid_hash( $args )
		) {
			self::$instance[ $id ] = new self( $id, $args );
		}

		return self::$instance[ $id ];

	}

}
