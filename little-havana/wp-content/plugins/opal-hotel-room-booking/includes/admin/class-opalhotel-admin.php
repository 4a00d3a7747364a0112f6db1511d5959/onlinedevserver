<?php
/**
 * @Author: brainos
 * @Date:   2016-04-23 22:41:07
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-07 16:55:02
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Admin {

	public function __construct() {

		/* includes files */
		add_action( 'init', array( $this, 'includes' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 100 );
		// register settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/* include files */
	public function includes() {

		// functions
		OpalHotel::instance()->_include( 'admin/opalhotel-admin-functions.php' );
		OpalHotel::instance()->_include( 'admin/opalhotel-admin-hooks.php' );
		// menu
		OpalHotel::instance()->_include( 'admin/class-opalhotel-admin-menu.php' );
		// setting page
		OpalHotel::instance()->_include( 'admin/class-opalhotel-admin-setting-page.php' );
		// settings class
		OpalHotel::instance()->_include( 'admin/class-opalhotel-admin-settings.php' );
		// metaboxes
		OpalHotel::instance()->_include( 'admin/class-opalhotel-admin-metaboxes.php' );

	}

	/* enqueue assets */
	public function enqueue_scripts( $hook ) {

		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-datepicker' );
		$schema = is_ssl() ? 'https://' : 'http://';
		wp_enqueue_style( 'jquery-ui-datepicker', $schema . 'code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css' );

		/* register */
		wp_register_script( 'opal-hotel-room-booking', OPALHOTEL_URI . 'assets/admin/js/opalhotel.js', array( 'opalhotel-global' ), OPALHOTEL_VERSION, true );
		wp_localize_script( 'opal-hotel-room-booking', 'OpalHotel', opalhotel_i18n() );
		// wp_register_script( 'tiptip', OPALHOTEL_URI . 'assets/libraries/tiptip/jquery.tipTip.minified.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_script( 'tiptip', OPALHOTEL_URI . 'assets/libraries/tiptip/jquery.tipTip.min.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_style( 'opal-hotel-room-booking', OPALHOTEL_URI . 'assets/admin/css/opalhotel.css', array(), OPALHOTEL_VERSION );

		/* select2 */
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
			// remove woocommercer scripts, styles
			global $post;
			if ( $post->post_type === 'opalhotel_room' ) {
				wp_dequeue_style( 'select2' );
		        wp_deregister_style( 'select2' );
		        wp_dequeue_script( 'select2');
		        wp_deregister_script('select2');

		        wp_dequeue_style( 'woocommerce_admin_styles' );
		        wp_deregister_style( 'woocommerce_admin_styles' );
			}
		}
		wp_register_script( 'opalhotel-select2', OPALHOTEL_URI . 'assets/libraries/select2/js/select2.full.min.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_style( 'opalhotel-select2', OPALHOTEL_URI . 'assets/libraries/select2/css/select2.min.css', array(), OPALHOTEL_VERSION );

		wp_register_script( 'opalhotel-momentjs', OPALHOTEL_URI . 'assets/libraries/full-calendar/moment.min.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_script( 'opalhotel-full-calendar', OPALHOTEL_URI . 'assets/libraries/full-calendar/fullcalendar.min.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_script( 'opalhotel-full-calendar-lang-all', OPALHOTEL_URI . 'assets/libraries/full-calendar/lang-all.js', array( 'jquery' ), OPALHOTEL_VERSION, true );
		wp_register_style( 'opalhotel-full-calendar', OPALHOTEL_URI . 'assets/libraries/full-calendar/fullcalendar.min.css', array(), OPALHOTEL_VERSION );
		/* enqueue */
		wp_enqueue_script( 'tiptip' );
		wp_enqueue_script( 'opal-hotel-room-booking' );
		wp_enqueue_style( 'opal-hotel-room-booking' );
		/* select 2*/
		wp_enqueue_script( 'opalhotel-select2' );
		wp_enqueue_style( 'opalhotel-select2' );
		/* fullcalendar */
		wp_enqueue_script( 'opalhotel-momentjs' );
		wp_enqueue_script( 'opalhotel-full-calendar' );
		wp_enqueue_script( 'opalhotel-full-calendar-lang-all' );
		wp_enqueue_style( 'opalhotel-full-calendar' );
	}

	public function register_settings() {
		// setting group
		register_setting( OPALHOTEL_SETTING_GROUP_NAME, OPALHOTEL_SETTING_GROUP_NAME );
	}

}

new OpalHotel_Admin();
