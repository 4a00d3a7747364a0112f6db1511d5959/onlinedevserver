<?php
/**
 * @Author: brainos
 * @Date:   2016-04-23 23:06:33
 * @Last Modified by:   opalhotel_remove_extra
 * @Last Modified time: 2016-04-25 19:53:50
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Admin_Menu {

	public function __construct() {

		// add admin menu item
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/* admin menu */
	public function admin_menu() {

		// add menu page
		add_menu_page(
			__( 'OpalHotel', 'opal-hotel-room-booking' ),
			__( 'OpalHotel', 'opal-hotel-room-booking' ),
			'manage_options',
			'opal-hotel-room-booking',
			'',
			'dashicons-list-view',
			10
		);

		// setting submenu
		add_submenu_page( 'opal-hotel-room-booking', __( 'OpalHotel Settings', 'opal-hotel-room-booking' ), __( 'Settings', 'opal-hotel-room-booking' ), 'manage_options', 'opalhotel-settings', array( 'OpalHotel_Admin_Settings', 'output' ) );

	}

}

new OpalHotel_Admin_Menu();