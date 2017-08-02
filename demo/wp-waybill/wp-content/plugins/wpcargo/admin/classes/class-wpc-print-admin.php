<?php



if (!defined('ABSPATH')){

	exit; // Exit if accessed directly

}



class WPCargo_Print_Admin{



	public function __construct() {

		

		add_action('admin_menu', array( $this, 'wpcargo_print_register_submenu_page' ) );

		add_action('admin_print_header', array( $this, 'wpcargo_print_header_template' ) );

		add_action('admin_print_shipper', array( $this, 'wpcargo_print_shipper_template' ), 10 );

		add_action('admin_print_shipment', array( $this, 'wpcargo_print_shipment_template' ), 10 );



	}



	public function wpcargo_print_register_submenu_page() {



		add_submenu_page(

			NULL,

			'Print Layout',

			'Print Layout',

			'edit_posts',

			'wpcargo-print-layout',

			array( $this, 'wpcargo_print_submenu_page_callback' ));



	}







	public function wpcargo_print_submenu_page_callback() {



		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'admin/templates/admin-print.tpl.php');



	}







	public function wpcargo_print_header_template($shipment_detail) {



		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'admin/templates/print-details-header.tpl.php');



	}







	public function wpcargo_print_shipper_template($shipment_detail) {



		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'admin/templates/print-details-shipper.tpl.php');



	}







	public function wpcargo_print_shipment_template($shipment_detail) {



		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'admin/templates/print-details-shipment.tpl.php');



	}



}



$wpcargo_print_admin = new WPCargo_Print_Admin;

