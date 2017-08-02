<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WPCargo_Admin_Scripts{

	public function __construct(){
		add_action( 'admin_init', array( $this,'admin_scripts' ) );
	}

	public function admin_scripts() {
		
		$screen = get_current_screen();		
		wp_register_script('wpcargo-timepicker', WPCARGO_PLUGIN_URL . 'admin/assets/js/jquery.timepicker.js', array( 'jquery' ), '4.0.5', TRUE );
		wp_enqueue_script('wpcargo-timepicker-js');
		wp_enqueue_script('wpcargo-timepicker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_register_style('wpcargo-timepicker-css', WPCARGO_PLUGIN_URL . 'admin/assets/css/jquery.timepicker.css', '4.0.5');
		wp_enqueue_style('wpcargo-timepicker-css');
		wp_register_script('wpcargo-bootstrap-min-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array( 'jquery' ), '4.0.5');
		wp_register_style('wpcargo-bootstrap-min-css', WPCARGO_PLUGIN_URL . 'admin/assets/css/wpcargo-bootstrap.min.css', '4.0.5');
		wp_register_style('wpcargo-admin-css', WPCARGO_PLUGIN_URL . 'admin/assets/css/admin-style.css', '4.0.5');
		wp_register_style('wpcargo-datepicker-ui', WPCARGO_PLUGIN_URL . 'admin/assets/css/datepicker.css', '4.0.5');
		wp_enqueue_style('wpcargo-admin-css');
		wp_enqueue_style('wpcargo-datepicker-ui');
	
		wp_register_script( 'wpcargo-mp-repeater', WPCARGO_PLUGIN_URL.'admin/assets/js/wpc-mp-repeater.js', FALSE );
		$options 				= get_option( 'wpc_mp_settings' );
		$wpc_mp_vat_percentage 	= !empty($options['wpc_mp_vat_percentage']) ? $options['wpc_mp_vat_percentage'] : '0';
		wp_register_script( 'wpcargo-mp-rep', WPCARGO_PLUGIN_URL.'admin/assets/js/wpc-mp-rep.js', FALSE );	
		$translation_array = array(
			'wpc_mp_vat_percentage' => '.'.$wpc_mp_vat_percentage
		);
		wp_localize_script( 'wpcargo-mp-rep', 'wpcargo_mp_rep', $translation_array );			
		wp_enqueue_style( 'wpcargo-multiple-package-style-admin', WPCARGO_PLUGIN_URL. 'admin/assets/css/wpc-mp-admin.css' );	
		wp_enqueue_script( 'wpcargo-mp-repeater');
		wp_enqueue_script( 'wpcargo-mp-rep');
				
				
		if( isset($_GET['page'] ) && $_GET['page'] == 'wpc-report-export' ) {		
			wp_enqueue_script( 'wpcargo-multiselect-export', WPCARGO_PLUGIN_URL. 'admin/assets/js/wpc-multiselect-reports.js' , array( 'jquery' ), '4.0.5');		
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			
			wp_enqueue_script( 'wpc-autocomplete-ajax', WPCARGO_PLUGIN_URL . 'admin/assets/js/wpc-autocomplete-reports.js', array('jquery')  );
			wp_localize_script( 'wpc-autocomplete-ajax', 'wpc_ie_ajaxscripthandler', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		}

		if(isset( $_GET['page'] ) && $_GET['page'] == 'wpcargo-settings' ){
			wp_enqueue_media();
		}
	}

}

new WPCargo_Admin_Scripts;
