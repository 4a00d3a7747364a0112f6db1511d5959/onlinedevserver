<?php

if( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Tempalte_Loader {

	public function __construct() {

		/*
		 * template include filter
		 *
		 * filter single room, room taxonomy template
		 */
		add_filter( 'template_include', array( $this, 'template_include' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 11 );
	}

	/*
	 *
	 * include template
	 *
	 * @return template
	 */
	public function template_include( $template ) {

		$post_type = get_post_type();

        $file = '';
        $find = array();

        if ( is_post_type_archive( 'opalhotel_room' ) ) {
        	/* archive */
            $file = 'archive-room.php';
            $find[] = $file;
            $find[] = OpalHotel()->template_path() . '/' . $file;

        } else if ( opalhotel_is_room_taxonomy() || opalhotel_is_hotel_taxonomy() ) {
        	/* taxonomy */
            $term   = get_queried_object();
            $taxonomy = '';
            if ( strpos( $term->taxonomy, 'opalhotel_' ) === 0 ) {
            	$taxonomy = substr( $term->taxonomy, strlen( 'opalhotel_' ) );
            }

            if ( is_tax( 'opalhotel_room_cat' ) || is_tax( 'opalhotel_room_tag' ) ) {
            	$file = 'taxonomy-' . $taxonomy . '.php';
            } else if( is_tax( 'opalhotel_hotel_cat' ) ){
                $file = 'taxonomy-hotel_cat.php';
            } else {
                if ( opalhotel_is_room_taxonomy() ) {
                    $file = 'archive-room.php';
                } else if ( opalhotel_is_hotel_taxonomy() ){
                    $file = 'archive-hotel.php';
                } else {
                    $file = 'archive-room.php';
                }
            }

            $find[] = 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
            $find[] = OpalHotel()->template_path() . 'taxonomy-' . $taxonomy . '-' . $term->slug . '.php';
            $find[] = 'taxonomy-' . $term->taxonomy . '.php';
            $find[] = OpalHotel()->template_path() . 'taxonomy-' . $taxonomy . '.php';
            $find[] = $file;

        } else if ( is_single() && get_post_type() === 'opalhotel_room' ) {
        	/* single */
            $file = 'single-room.php';
            $find[] = $file;
            $find[] = OpalHotel()->template_path() . '/' . $file;
        } else if ( is_post_type_archive( 'opalhotel_hotel' ) ){
        	/* archive */
            $file = 'archive-hotel.php';
            $find[] = $file;
            $find[] = OpalHotel()->template_path() . '/' . $file;
        } else if ( is_single() && get_post_type() === 'opalhotel_hotel' ) {
        	/* single */
            $file = 'single-hotel.php';
            $find[] = $file;
            $find[] = OpalHotel()->template_path() . '/' . $file;
        }

        if( $file ) {
            $find[] = OpalHotel()->template_path() . '/' . $file;
            $template = locate_template( array_unique( $find ) );

            if ( ! $template ) {
				$template = OpalHotel()->plugin_path() . '/templates/' . $file;
			}
        }

        return $template;
	}

	/* enqueue scripts */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery-ui' );
		/* register */
        $key = get_option( 'opalhotel_google_map_api_key', 'AIzaSyDRVUZdOrZ1HuJFaFkDtmby0E93eJLykIk' );
        $api = apply_filters( 'opalhotel_google_map_api_uri', '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=geometry,geocoder&amp;key=' . $key );

        wp_register_script( 'opalhotel-map-api', $api );
        wp_enqueue_script( 'opalhotel-map-api' );
		wp_register_script( 'owl-carousel', OPALHOTEL_URI . 'assets/libraries/owl-carousel/owl.carousel.min.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_style( 'owl-carousel', OPALHOTEL_URI . 'assets/libraries/owl-carousel/owl.carousel.css', array(), OPALHOTEL_VERSION );

		wp_deregister_script( 'opal-hotel-room-booking' );
		wp_register_script( 'opal-hotel-room-booking', OPALHOTEL_URI . 'assets/site/js/opalhotel.js', array( 'jquery', 'backbone', 'opalhotel-global' ), OPALHOTEL_VERSION, true );

		wp_localize_script( 'opal-hotel-room-booking', 'OpalHotel', opalhotel_i18n() );
		wp_register_script( 'opalhotel-paymentjs', OPALHOTEL_URI . 'assets/site/js/jquery.payment.min.js', array( 'jquery', 'opalhotel-global' ), OPALHOTEL_VERSION, true );

		/* enqueue */
		wp_enqueue_script( 'opal-hotel-room-booking' );
		wp_enqueue_script( 'opalhotel-paymentjs' );

		if(! file_exists(get_template_directory().'/css/opalhotel.css') ){
			wp_enqueue_style( 'opal-hotel-room-booking', OPALHOTEL_URI . 'assets/site/css/opalhotel.css', array(), OPALHOTEL_VERSION );
			wp_enqueue_style( 'opal-hotel-room-booking' );
		}
		wp_enqueue_script( 'owl-carousel' );
		wp_enqueue_style( 'owl-carousel' );
	}

}

new OpalHotel_Tempalte_Loader();