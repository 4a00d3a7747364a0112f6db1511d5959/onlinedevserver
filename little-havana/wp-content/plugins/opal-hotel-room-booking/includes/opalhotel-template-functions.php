<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Get classname for loops based on $opalhotel_loop global.
 * @since 2.6.0
 * @return string
 */
function opalhotel_get_loop_class() {
	global $opalhotel_loop;

	$opalhotel_loop['loop']    = ! empty( $opalhotel_loop['loop'] ) ? $opalhotel_loop['loop'] + 1 : 1;
	$opalhotel_loop['columns'] = ! empty( $opalhotel_loop['columns'] ) ? $opalhotel_loop['columns'] : apply_filters( 'opalhotel_loop_columns', 3 );

	// echo $opalhotel_loop['loop'].'tienhc.';
	$cls = floor( 12 / $opalhotel_loop['columns'] );

	$gridcols = apply_filters( 'opalhotel_loop_grid_column_class', 'grid-column grid-column-' . $cls );

	$c = $opalhotel_loop['loop'] - 1; 

	return $gridcols . ' ' . ( $c % $opalhotel_loop['columns'] == 0 ? 'first-child': '' );	 
}

function opalhotel_display_modes(){
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	$woo_display = apply_filters( 'opalhotel_room_display_mode', 'grid' );

	if ( isset($_COOKIE['opalhotel_display']) && $_COOKIE['opalhotel_display'] == 'list' ) {
		$woo_display = $_COOKIE['opalhotel_display'];
	}

	echo '<form action="'.  $current_url  .'" class="display-mode" method="get">';
 		if( isset($_GET['rooms']) ){
			echo '<input type="hidden" name="rooms" value="'.$_GET['rooms'].'" />';
		}
		echo '<button title="'.esc_html__( 'Grid','opal-hotel-room-booking' ).'" class="btn '.($woo_display == 'grid' ? 'active' : '').'" value="grid" name="display" type="submit"><i class="fa fa-th"></i>'.esc_html__('Grid','opal-hotel-room-booking').'</button>';	
		echo '<button title="'.esc_html__( 'List', 'opal-hotel-room-booking' ).'" class="btn '.($woo_display == 'list' ? 'active' : '').'" value="list" name="display" type="submit"><i class="fa fa-th-list"></i>'.esc_html__( 'List', 'opal-hotel-room-booking' ).'</button>';	
	echo '</form>'; 
}

if ( ! function_exists( 'opalhotel_after_process_step' ) ) {

	function opalhotel_after_process_step( $atts ) {
		$step = isset( $atts['step'] ) ? abs( $atts['step'] ) : 1;

		$html = array();
		$arrival = isset( $atts['arrival'] ) ? $atts['arrival'] : '';
		$depature = isset( $atts['departure'] ) ? $atts['departure'] : '';
		$adult = isset( $atts['adult'] ) ? absint( $atts['adult'] ) : 1;
		$child = isset( $atts['child'] ) ? absint( $atts['child'] ) : 1;
		$room_type = isset( $atts['room_type'] ) ? absint( $atts['room_type'] ) : 0;

		global $post;
		$current_page_id = 0;
		if ( $post && $post->ID ) {
			$current_page_id = $post->ID;
		}
		$current_page_id = isset( $atts['current_page_id'] ) ? absint( $atts['current_page_id'] ) : $current_page_id;
		if ( $step === 2 ) {
			$html[] = '<div class="opalhotel-reservation-step">';
			$html[] = '<a href="#" class="button button-default reservation_step pull-left" data-step="1" data-arrival="' . esc_attr($arrival) . '" data-departure="' . esc_attr($depature) . '" data-adult="'.esc_attr($adult).'" data-child="'.esc_attr($child).'" data-room-type="'.esc_attr( $room_type ).'" data-pageid="'.esc_attr($current_page_id).'">' . __( 'Check Availability', 'opal-hotel-room-booking' ) . '</a>';
			$html[] = '<a href="#" class="button button-primary-inverse reservation_step pull-right" data-step="3" data-arrival="' . $arrival . '" data-departure="' . esc_attr($depature) . '" data-adult="'.esc_attr($adult).'" data-child="'.esc_attr($child).'" data-room-type="'.esc_attr($room_type).'" data-pageid="'.esc_attr($current_page_id).'">' . __( 'Reservation', 'opal-hotel-room-booking' ) . '</a>';
			$html[] = '</div>';
		} else if ( $step === 3 ) {
			$html[] = '<div class="opalhotel-reservation-step">';
			$html[] = '<a href="#" class="opalhotel-button-submit reservation_step prev choose-room button button-default" data-step="2" data-arrival="' . esc_attr($arrival) . '" data-departure="' . esc_attr($depature) . '" data-adult="'.esc_attr($adult).'" data-child="'.esc_attr($child).'" data-room-type="'.esc_attr( $room_type ).'" data-pageid="'.esc_attr($current_page_id).'">' . __( 'Choose Room', 'opal-hotel-room-booking' ) . '</a>';
			$html[] = '</div>';
		}

		echo implode( '', $html );
	}

}

if ( ! function_exists( 'opalhotel_reservation_step' ) ) {

	function opalhotel_reservation_step( $atts ) {
		$step = isset( $atts['step'] ) ? absint( $atts['step'] ) : 1;
		$html = '';

		if ( $step === 1 ) {
			$html = opalhotel_get_template_content( 'search/calendar.php', array( 'step' => $step, 'atts' => $atts ) );
		} else if ( $step === 2 ) {
			$arrival = absint( $atts['arrival'] );
			$departure = absint( $atts['departure'] );
			$adult = isset( $atts['adult'] ) ? absint( $atts['adult'] ) : 0 ;
			$child = isset( $atts['child'] ) ? absint( $atts['child'] ) : 0 ;
			$room_type = isset( $atts['room_type'] ) ? absint( $atts['room_type'] ) : 0;
			$paged = isset( $atts['paged'] ) ? absint( $atts['paged'] ) : 1;
			$html = do_shortcode( '[opalhotel_check_available template="form-results" arrival_timestamp="' . $arrival . '" departure_timestamp="' . $departure . '" adult="'.$adult .'" child="' . $child . '" room_type="'. $room_type .'" paged="' . $paged . '"]' );
		} else if ( $step === 3 ) {
			$html = do_shortcode( '[opalhotel_checkout]' );
		} else if ( $step === 4 && isset( $atts['order-received'] ) ) {
			$html = do_shortcode( '[opalhotel_checkout order-received="' . $atts['order-received'] . '"]' );
		}
		echo $html;
	}
}

if ( ! function_exists( 'opalhotel_setup_shorcode_content' ) ) {
	/* setup search result check available form */
	function opalhotel_setup_shorcode_content( $content ) {
		global $post;

		if( trim( $post->post_content ) != trim( $content ) ) {
			return $content;
		}

		/* timestamp */
		$arrival = isset( $_GET['arrival_timestamp'] ) && $_GET['arrival_timestamp'] ? sanitize_text_field( $_GET['arrival_timestamp'] ) : false;
		$departure = isset( $_GET['departure'] ) && $_GET['departure_timestamp'] ? sanitize_text_field( $_GET['departure_timestamp'] ) : false;

		/* adults & childrens */
		$adults = isset( $_GET['adult'] ) && $_GET['adult'] ? absint( $_GET['adult'] ) : 0;
		$child = isset( $_GET['child'] ) && $_GET['child'] ? absint( $_GET['child'] ) : 0;
		$room_type = isset( $_GET['room_type'] ) && $_GET['room_type'] ? absint( $_GET['room_type'] ) : false;
		/* get setting page, valid check available page */
		if ( ( $search_id = opalhotel_get_page_id( 'available' ) ) && is_page( $search_id ) ) {
			if ( $arrival && $departure ) {
				$shortcode = '[opalhotel_check_available template="form-results" arrival="' . $arrival . '" departure="' . $departure . '" adult="' . $adults . '" child="' . $child . '" room_type="'. $room_type .'"]';
				$content = do_shortcode( $shortcode );
			}
		} else if ( ( $reservation_id = opalhotel_get_page_id( 'reservation' ) ) && is_page( $reservation_id ) ) {
			// $content = '[opalhotel_cart]';
			if ( $arrival && $departure ) {
				$shortcode = '[opalhotel_reservation step="2" arrival="' . $arrival . '" departure="' . $departure . '" adult="' . $adults . '" child="' . $child . '" room_type="'. absint( $room_type ) .'"]';
				$content = do_shortcode( $shortcode );
			}
		} else if ( ( $account_id = opalhotel_get_page_id( 'account' ) ) && is_page( $account_id ) ) {
			$content = '[opalhotel_account]';
		} else if ( ( $checkout_id = opalhotel_get_page_id( 'checkout' ) ) && is_page( $checkout_id ) ) {
			$content = '[opalhotel_checkout]';
		}

		return $content;
	}
}

if ( ! function_exists( 'opalhotel_reservation_reviews' ) ) {

	/* available review selected */
	function opalhotel_reservation_reviews() {
		opalhotel_get_template( 'search/review.php' );
	}
}

if ( ! function_exists( 'opalhotel_template_single_title' ) ) {

	/* title of single room*/
	function opalhotel_template_single_title() {
		opalhotel_get_template( 'single-room/title.php' );
	}
}

if ( ! function_exists( 'opalhotel_template_single_gallery' ) ) {

	/* gallery of single room */
	function opalhotel_template_single_gallery() {
		opalhotel_get_template( 'single-room/gallery.php' );
	}

}

if ( ! function_exists( 'opalhotel_template_single_price' ) ) {

	/* base price of single room */
	function opalhotel_template_single_price() {
		opalhotel_get_template( 'single-room/price.php' );
	}
}

/* ARCHIVE */
if ( ! function_exists( 'opalhotel_loop_item_thumbnail' ) ) {

	/* loop thumbnail */
	function opalhotel_loop_item_thumbnail() {
		opalhotel_get_template( 'loop/thumbnail.php' );
	}
}

if ( ! function_exists( 'opalhotel_loop_item_title' ) ) {

	/* get title room of archive template */
	function opalhotel_loop_item_title() {
		opalhotel_get_template( 'loop/title.php' );
	}
}

if ( ! function_exists( 'opalhotel_loop_item_description' ) ) {

	/* get description room */
	function opalhotel_loop_item_description() {
		opalhotel_get_template( 'loop/descriptions.php' );
	}
}

if ( ! function_exists( 'opalhotel_loop_item_details' ) ) {

	/* get description room */
	function opalhotel_loop_item_details() {
		opalhotel_get_template( 'loop/details.php' );
	}
}

if ( ! function_exists( 'opalhotel_loop_item_view_details' ) ) {

	/* get view detail room */
	function opalhotel_loop_item_view_details() {
		opalhotel_get_template( 'loop/view-details.php' );
	}
}

if ( ! function_exists( 'opalhotel_loop_item_price' ) ) {

	/* room price */
	function opalhotel_loop_item_price() {
		opalhotel_get_template( 'loop/price.php' );
	}
}

if ( ! function_exists( 'opalhotel_archive_pagination' ) ) {

	/* pagination archive, taxonomy */
	function opalhotel_archive_pagination( $query ) {
		if ( ! $query ) {
			global $wp_query;
			$query = $wp_query;
		}
		opalhotel_get_template( 'loop/pagination.php', array( 'query' => $query ) );
	}
}

/* END ARCHIVE */
if ( ! function_exists( 'opalhotel_template_setup_room' ) ) {

	/* set global $room */
	function opalhotel_template_setup_room( $post ) {
		/* unset old data */
		unset( $GLOBALS['opalhotel_room'] );

		if ( is_int( $post ) ) {
			$post = get_post( $post );
		}

		if ( empty( $post->post_type ) || ! in_array( $post->post_type, array( 'opalhotel_room' ) ) ) {
			return;
		}

		/* get room */
		$GLOBALS['opalhotel_room'] = opalhotel_get_room( $post );

		return $GLOBALS['opalhotel_room'];
	}
}

if ( ! function_exists( 'opalhotel_template_setup_body_class' ) ) {

	/* body class */
	function opalhotel_template_setup_body_class( $class ) {
		global $post;
		$opalhotel_class = array();
		if ( is_post_type_archive( 'opalhotel_room' ) ) {

			$opalhotel_class[] = 'opalhotel-archive';

        } else if ( opalhotel_is_room_taxonomy() ) {
        	$opalhotel_class[] = 'opalhotel-tax';

            if ( is_tax( 'opalhotel_room_cat' ) ) {
            	$opalhotel_class[] = 'opalhotel-room-cat';
            } else if ( is_tax( 'opalhotel_room_tag' ) ) {
                $opalhotel_class[] = 'opalhotel-room-tax';
            }

        } else if ( is_single() && get_post_type() === 'opalhotel_room' ) {
        	$opalhotel_class[] = 'opalhotel-single';
        } else if ( is_page() ) {
        	$opalhotel = array(
        			opalhotel_get_page_id( 'available' ),
        			opalhotel_get_page_id( 'cart' ),
        			opalhotel_get_page_id( 'checkout' ),
        			opalhotel_get_page_id( 'account' ),
        			opalhotel_get_page_id( 'terms' ),
        			opalhotel_get_page_id( 'reservation' )
        		);
        	if ( in_array( $post->ID, $opalhotel ) ) {
        		$opalhotel_class[] = 'opalhotel-page';
        	}

        	if ( $post->ID == opalhotel_get_page_id( 'reservation' ) ) {
        		$opalhotel_class[] = 'opalhotel-reservation';
        	}
        }

        if ( ! empty( $opalhotel_class ) ) {
        	$opalhotel_class[] = 'opal-hotel-room-booking';
        	$class = array_merge_recursive( $opalhotel_class, $class );
        }

		return $class;
	}
}

if ( ! function_exists( 'opalhotel_template_setup_post_class' ) ) {

	/* set up post class */
	function opalhotel_template_setup_post_class( $class ) {

		return $class;
	}
}

if ( ! function_exists( 'opalhotel_single_room_details' ) ) {
	function opalhotel_single_room_details() {
		opalhotel_get_template( 'single-room/room-details.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_room_attribute' ) ) {
	function opalhotel_single_room_attribute() {
		opalhotel_get_template( 'single-room/room-details/details.php' );
	}
}
if ( ! function_exists( 'opalhotel_single_room_description' ) ) {
	function opalhotel_single_room_description() {
		opalhotel_get_template( 'single-room/room-details/descriptions.php' );
	}
}
if ( ! function_exists( 'opalhotel_single_room_pricing_plan' ) ) {
	function opalhotel_single_room_pricing_plan() {
		opalhotel_get_template( 'single-room/room-details/pricing-plans.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_related_room' ) ) {
	function opalhotel_single_related_room() {
		opalhotel_get_template( 'single-room/related.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_reservation_form' ) ) {
	function opalhotel_single_reservation_form( $layout = '' ) {
		opalhotel_dynamic_check_availability( array(
				'adult'		=> 1,
				'child'		=> 1,
				'room_type'	=> true,
				'layout'	=> $layout
			) );
	}
}

if ( ! function_exists( 'opalhotel_dynamic_check_availability' ) ) {

	/* dynamic availability form */
	function opalhotel_dynamic_check_availability( $args ) {
		if( isset( $args['layout'] ) && $args['layout'] === 'horizontal' ){
			opalhotel_get_template( 'search/horizontal-form-check-available.php', $args );		
		} else {
			opalhotel_get_template( 'search/form-check-available.php', $args );
		}
	}
}

if ( ! function_exists( 'opalhotel_reservation_order_confirm_template' ) ) {
	/* order received */
	function opalhotel_reservation_order_confirm_template( $order ) {
		opalhotel_get_template( 'checkout/received/order-confirm.php', array( 'order' => $order ) );
	}
}

if ( ! function_exists( 'opalhotel_reservation_order_details_template' ) ) {
	/* order received */
	function opalhotel_reservation_order_details_template( $order ) {
		opalhotel_get_template( 'checkout/received/order-details.php', array( 'order' => $order ) );
	}
}

if ( ! function_exists( 'opalhotel_reservation_customer_details_template' ) ) {
	/* order received */
	function opalhotel_reservation_customer_details_template( $order ) {
		opalhotel_get_template( 'checkout/received/order-customer-details.php', array( 'order' => $order ) );
	}
}

if ( ! function_exists( 'opalhotel_select_number' ) ) {

	/*
	 * 'max' => integer
	 * 'min' => integer
	 * create select dropdown with number
	 */
	function opalhotel_select_number( $args = array() ) {
		$args = wp_parse_args( $args, array(
				'min'		=> 0,
				'max'		=> 0,
				'none'		=> 0,
				'selected'	=> 0,
				'name'		=> '',
				'class'		=> '',
				'id'		=> '',
				'selected'	=> ''
			) );

		$html = array();
		$html[] = '<select name="' . esc_attr( $args['name'] ) . '"
		'.( $args['class'] ? ' class="'.$args['class'].'"' : '' ).'
		'.( $args['id'] ? ' id="'.$args['id'].'"' : '' ).'>';

		if ( $args['none'] ) {
			$html[] = '<option value="0">' . esc_html( $args['none'] ) . '</option>';
		}
		for ( $i = $args['min']; $i <= $args['max']; $i++ ) {
			$html[] = '<option value="'.esc_attr( $i ).'" '. selected( $args['selected'], $i, false ).'>' . esc_html( $i ) . '</option>';
		}
		$html[] = '</select>';

		return implode( '', $html );
	}

}

if ( ! function_exists( 'opalhotel_template_alert_underscore' ) ) {

	/**
	 * opalhotel_template_alert_underscore
	 * @return javascript template
	 */
	function opalhotel_template_alert_underscore() {
?>
	<script type="text/html" id="tmpl-opalhotel-alert">
		<div class="opalhotel_backbone_modal_content">
			<form>
				<header>
					<h2>
						<# if ( data.message ) { #>
							{{{ data.message }}}
						<# } #>
					</h2>
					<a href="#" class="opalhotel_button_close"><i class="fa fa-times" aria-hidden="true"></i></a>
				</header>
				<footer class="center">

					<input type="hidden" name="action" value="{{ data.action }}">
					<!-- <button type="reset" class="opalhotel-button-cancel opalhotel_button_close"><?php //_e( 'No', 'opal-hotel-room-booking' ) ?></button> -->
					<button type="submit" class="opalhotel-button opalhotel-button-submit"><?php _e( 'OK', 'opal-hotel-room-booking' ); ?></button>

				</footer>
			</form>
		</div>
		<div class="opalhotel_backbone_modal_overflow"></div>
	</script>

	<script type="text/html" id="tmpl-opalhotel-room-pricing">
		<div class="opalhotel_backbone_modal_content">
			<form class="">
				<header>
					<h2>
						<# if ( data.message ) { #>
							{{{ data.message }}}
						<# } #>
					</h2>
					<a href="#" class="opalhotel_button_close"><i class="fa fa-times" aria-hidden="true"></i></a>
				</header>
				<div class="container">
					<input type="number" step="any" name="price" value="{{ data.price }}"/>
				</div>
				<footer class="center">

					<input type="hidden" name="action" value="{{ data.action }}">
					<button type="reset" class="opalhotel-button-cancel opalhotel_button_close"><?php _e( 'Cancel', 'opal-hotel-room-booking' ) ?></button>
					<button type="submit" class="opalhotel-button opalhotel-button-submit"><?php _e( 'Save', 'opal-hotel-room-booking' ); ?></button>

				</footer>
			</form>
		</div>
		<div class="opalhotel_backbone_modal_overflow"></div>
	</script>

	<script type="text/html" id="tmpl-opalhotel-single-room-available">
		<div class="opalhotel-room-modal-wrapper">
			<div class="opalhotel-room-modal">
				<div class="content">
					<h3><?php _e( 'Book Now', 'opal-hotel-room-booking' ); ?></h3>
					<form class="opalhotel-single-book-room opalhotel_form_section" action="">
						<div class="row opalhotel_datepick_wrap">
							<div class="col-md-4 col-xs-12">
								<div class="opalhotel-form-field-group">
									<i class="fa fa-calendar-o" aria-hidden="true"></i>
									<input type="text" name="arrival" placeholder="<?php esc_attr_e( 'Arrival Date', 'opal-hotel-room-booking' ); ?>" class="opalhotel-has-datepicker opalhotel-arrival-date" data-end="opalhotel-departure-date" />
								</div>
							</div>
							<div class="col-md-4 col-xs-12">
								<div class="opalhotel-form-field-group">
									<i class="fa fa-calendar-o" aria-hidden="true"></i>
									<input type="text" name="departure" placeholder="<?php esc_attr_e( 'Departure Date', 'opal-hotel-room-booking' ); ?>" class="opalhotel-has-datepicker opalhotel-departure-date" data-start="opalhotel-arrival-date" />
								</div>
							</div>
							<div class="col-md-4 col-xs-12">
								<input type="hidden" name="action" value="opalhotel_load_room_available_data" />
								<input type="hidden" name="room_id" value="{{ data.room_id }}" />
								<?php wp_nonce_field( 'opalhotel-single-room-available','nonce' ); ?>
								<button type="submit" class="opalhotel-button-submit button button-primary"><?php esc_html_e( 'Check Avaiable', 'opal-hotel-room-booking' ); ?></button>
							</div>
						</div>
					</form>

				</div>
			</div>
			<div class="overlay"></div>
		</div>
	</script>
<?php
	}

}

if ( ! function_exists( 'opalhotel_dropdown_country' ) ) {

	function opalhotel_dropdown_country( $args = array() ) {
		$args = wp_parse_args( $args, array(
					'name'	=> '',
					'none'	=> __( '---Select Country---', 'opal-hotel-room-booking' ),
					'selected'	=> '',
					'disabled'	=> false
			) );

		$html = array();
		$html[] = '<select name="' . esc_attr( $args['name'] ) . '" id="' . esc_attr( $args['name'] ) . '" '. ( $args['disabled'] ? ' disabled' : '' ) .'>';
		$html[] = '<option value="">' . esc_html( $args['none'] ) . '</option>';

		$countries = opalhotel_get_countries();
		foreach ( $countries as $code => $text ) {
			$html[] = '<option value="' . esc_attr( $code ) . '"'. selected( $args['selected'], $code, false ) .'>' . esc_html( $text ) . '</option>';
		}

		$html[] = '</select>';

		return implode( '', $html );
	}
}


if ( ! function_exists( 'opalhotel_hotel_loop_item_thumbnail' ) ) {

	function opalhotel_hotel_loop_item_thumbnail() {
		opalhotel_get_template( 'loop-hotel/thumbnail.php' );
	}
}

if ( ! function_exists( 'opalhotel_hotel_loop_item_title' ) ) {

	function opalhotel_hotel_loop_item_title() {
		opalhotel_get_template( 'loop-hotel/title.php' );
	}
}

if ( ! function_exists( 'opalhotel_hotel_loop_item_description' ) ) {

	function opalhotel_hotel_loop_item_description() {
		opalhotel_get_template( 'loop-hotel/descriptions.php' );
	}
}

if ( ! function_exists( 'opalhotel_hotel_loop_item_view_details' ) ) {

	function opalhotel_hotel_loop_item_view_details() {
		opalhotel_get_template( 'loop-hotel/view-details.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_hotel_title' ) ) {
	function opalhotel_single_hotel_title() {
		opalhotel_get_template( 'single-hotel/title.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_hotel_gallery' ) ) {
	function opalhotel_single_hotel_gallery() {
		opalhotel_get_template( 'single-hotel/gallery.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_hotel_description' ) ) {
	function opalhotel_single_hotel_description() {
		opalhotel_get_template( 'single-hotel/descriptions.php' );
	}
}

if ( ! function_exists( 'opalhotel_single_hotel_rooms' ) ) {
	function opalhotel_single_hotel_rooms() {
		opalhotel_get_template( 'single-hotel/rooms.php' );
	}
}