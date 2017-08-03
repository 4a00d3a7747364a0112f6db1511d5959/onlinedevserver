<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Install {

	static $upgrade = array();

	// install hook
	static function install() {

		if ( ! defined( 'OPALHOTEL_INSTALLING' ) ) {
			define( 'OPALHOTEL_INSTALLING', true );
		}

		self::$upgrade = apply_filters( 'opalhotel_upgrade_file_vesion', array(

			) );

		global $wpdb;
		if ( is_multisite() ) {
	        // store the current blog id
	        $current_blog = $wpdb->blogid;
	        // Get all blogs in the network and activate plugin on each one
	        $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
	        foreach ( $blog_ids as $blog_id ) {
	        	// each blog
	            switch_to_blog( $blog_id );

	            self::make_install();

	            // restore
	            restore_current_blog();
	        }
	    } else {
	        self::make_install();
	    }

	}

	static function make_install(){

		// create pages
		self::create_pages();

		// create update options
		self::create_options();

		// create tables
		self::create_tables();

		// upgrade database
		self::upgrade_database();

		/* create cron job */
		self::create_cron_job();

		update_option( 'opalhotel_version', OPALHOTEL_VERSION );
	}

	// upgrade database
	static function upgrade_database() {
		opalhotel_set_table_name();
		$version = get_option( 'opalhotel_version', false );
		foreach ( self::$upgrade as $ver => $update ) {
			if ( ! $version || version_compare( $version, $ver, '<' ) ) {
				include_once $update;
			}
		}
	}

	static function create_cron_job() {

		/* remove ola schedule */
		wp_clear_scheduled_hook( 'opalhotel_cancel_pending_boooking' );

		/* add new schedule */
		/* time cancel payment setting */
		$time_cancel = get_option( 'opalhotel_cancel_payment', 12 );
		$time_cancel = absint( $time_cancel ) * HOUR_IN_SECONDS ;
		/**
		 * cancel booking has over single time
		 */
		wp_schedule_single_event( time() + $time_cancel, 'opalhotel_cancel_pending_boooking' );

	}

	// create options default
	static function create_options() {
		if ( ! class_exists( 'OpalHotel_Admin_Settings' ) ) {
			OpalHotel::instance()->_include( 'admin/class-opalhotel-admin-settings.php' );
		}

		$settings_pages = OpalHotel_Admin_Settings::get_settings_pages();

		foreach ( $settings_pages as $setting ) {
			$options = $setting->get_settings();
			foreach ( $options as $option ) {
				if ( isset( $option[ 'id' ], $option[ 'default' ] ) ) {
					if ( ! get_option( $option[ 'id' ], false ) ) {
						update_option( $option['id'], $option['default'] );
					}
				}
			}
		}
	}

	// create page. Eg: opalhotel-checkout, opalhotel-cart
	static function create_pages() {
		if( ! function_exists( 'opalhotel_create_page' ) ){
            OpalHotel::instance()->_include( 'admin/opalhotel-admin-functions.php' );
            OpalHotel::instance()->_include( 'opalhotel-functions.php' );
        }

		$pages = array();
		// if( ! opalhotel_get_page_id( 'cart' ) || ! get_post( opalhotel_get_page_id( 'cart' ) ) )
		// {
		//     $pages['cart'] = array(
		//         'name'    => _x( 'opal-hotel-cart', 'Page Slug', 'opal-hotel-room-booking' ),
		//         'title'   => _x( 'Opal Hotel Cart', 'Page Title', 'opal-hotel-room-booking' ),
		//         'content' => '[' . apply_filters( 'opalhotel_cart_shortcode_tag', 'opalhotel_cart' ) . ']'
		//     );
		// }

		if( ! opalhotel_get_page_id( 'reservation' ) || ! get_post( opalhotel_get_page_id( 'reservation' ) ) )
		{
		    $pages['reservation'] = array(
		        'name'    => _x( 'opal-hotel-reservation', 'Page Slug', 'opal-hotel-room-booking' ),
		        'title'   => _x( 'Opal Hotel Reservation', 'Page Title', 'opal-hotel-room-booking' ),
		        'content' => '[' . apply_filters( 'opalhotel_reservation_shortcode_tag', 'opalhotel_reservation' ) . ']'
		    );
		}

		if( ! opalhotel_get_page_id( 'checkout' ) || ! get_post( opalhotel_get_page_id( 'checkout' ) ) )
		{
		    $pages['checkout'] = array(
		        'name'    => _x( 'opal-hotel-checkout', 'Page Slug', 'opal-hotel-room-booking' ),
		        'title'   => _x( 'Opal Hotel Checkout', 'Page Title', 'opal-hotel-room-booking' ),
		        'content' => '[' . apply_filters( 'opalhotel_checkout_shortcode_tag', 'opalhotel_checkout' ) . ']'
		    );
		}

		if( ! opalhotel_get_page_id( 'available' ) || ! get_post( opalhotel_get_page_id( 'available' ) ) )
		{
		    $pages['available'] = array(
		        'name'    => _x( 'opal-hotel-available', 'Page Slug', 'opal-hotel-room-booking' ),
		        'title'   => _x( 'Opal Hotel Check Available', 'Page Title', 'opal-hotel-room-booking' ),
		        'content' => '[' . apply_filters( 'opalhotel_search_shortcode_tag', 'opalhotel_check_available' ) . ']'
		    );
		}

		/* account page */
		// if( ! opalhotel_get_page_id( 'account' ) || ! get_post( opalhotel_get_page_id( 'account' ) ) )
		// {
		//     $pages['account'] = array(
		//         'name'    => _x( 'opal-hotel-account', 'Page Slug', 'opal-hotel-room-booking' ),
		//         'title'   => _x( 'Opal Hotel Account', 'Page Title', 'opal-hotel-room-booking' ),
		//         'content' => '[' . apply_filters( 'opalhotel_account_shortcode_tag', 'opalhotel_account' ) . ']'
		//     );
		// }

		/* terms and conditionals page */
		if( ! opalhotel_get_page_id( 'terms' ) || ! get_post( opalhotel_get_page_id( 'terms' ) ) )
		{
		    $pages['terms'] = array(
		        'name'    => _x( 'opal-hotel-term-condition', 'Page Slug', 'opal-hotel-room-booking' ),
		        'title'   => _x( 'Terms and Conditions ', 'Page Title', 'opal-hotel-room-booking' ),
		        'content' => apply_filters( 'opalhotel_terms_content', 'Something notices' )
		    );
		}

		if( $pages && function_exists( 'opalhotel_create_page' ) )
		{
		    foreach ( $pages as $key => $page ) {
		        $pageId = opalhotel_create_page( esc_sql( $page['name'] ), 'opalhotel_' . $key . '_page_id', $page['title'], $page['content'], ! empty( $page['parent'] ) ? opalhotel_get_page_id( $page['parent'] ) : '' );
		    }
		}

	}

	// create tables. Eg: order_items, order_itemmeta
	static function create_tables( ) {
		self::schema();
	}

	/* create tables */
	static function schema() {
		global $wpdb;

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		/* get database charset */
		$charset_collate = $wpdb->get_charset_collate();

		$table = $wpdb->prefix . 'opalhotel_order_items';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) != $table ) {

			// booking items
			$sql = "
				CREATE TABLE IF NOT EXISTS {$wpdb->prefix}opalhotel_order_items (
					order_item_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
					order_item_name longtext NOT NULL,
					order_item_type varchar(255) NOT NULL,
					order_item_parent bigint(20) NULL,
					order_id bigint(20) unsigned NOT NULL,
					UNIQUE KEY order_item_id (order_item_id),
					PRIMARY KEY  (order_item_id)
				) $charset_collate;
			";
			dbDelta( $sql );
		}

		$table = $wpdb->prefix . 'opalhotel_order_itemmeta';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) != $table ) {

			/* create order item meta table save all meta of order item */
			$sql = "
				CREATE TABLE IF NOT EXISTS {$wpdb->prefix}opalhotel_order_itemmeta (
					meta_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
					opalhotel_order_item_id bigint(20) unsigned NOT NULL,
					meta_key varchar(255) NULL,
					meta_value longtext NULL,
					UNIQUE KEY meta_id (meta_id),
					PRIMARY KEY  (meta_id),
					KEY opalhotel_order_item_id(opalhotel_order_item_id),
					KEY meta_key(meta_key)
				) $charset_collate;
			";
			dbDelta( $sql );
		}

		$table = $wpdb->prefix . 'opalhotel_pricing';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) != $table ) {

			/* create pricing table*/
			$sql = "
				CREATE TABLE IF NOT EXISTS {$wpdb->prefix}opalhotel_pricing (
					plan_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
					room_id bigint(20) unsigned NOT NULL,
					arrival timestamp NOT NULL,
					price float NULL,
					UNIQUE KEY arrival (arrival),
					PRIMARY KEY  (plan_id)
				) $charset_collate;
			";
			dbDelta( $sql );
		}

	}

	/*
	 * if multisite
	 *
	 * delete table when delete blog
	 */
	static function delete_tables( $tables ) {
		global $wpdb;
   		$tables[] = $wpdb->prefix . 'opalhotel_order_items';
   		$tables[] = $wpdb->prefix . 'opalhotel_order_itemmeta';
   		$tables[] = $wpdb->prefix . 'opalhotel_pricing';
		return $tables;
	}

	/*
	 * if multisite
	 *
	 * create new table when create new blog multisite
	 *
	 */
	static function create_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		$plugin = basename( OPALHOTEL_PATH ) . '/' . basename( OPALHOTEL_PATH ) . '.php';
		if ( is_plugin_active_for_network( $plugin ) ) {
			// switch to current blog
	        switch_to_blog( $blog_id );

	        self::create_tables( true );

	        // restore
	        restore_current_blog();
	    }
	}
}