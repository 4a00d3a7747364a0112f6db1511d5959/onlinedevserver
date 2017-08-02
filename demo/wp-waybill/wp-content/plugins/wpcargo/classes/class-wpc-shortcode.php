<?php



if (!defined('ABSPATH')){



    exit; // Exit if accessed directly



}





class WPCargo_Track_Form{



	function __construct() {



		add_shortcode('wpcargo_trackform', array( $this, 'wpcargo_trackform' ) );

		add_shortcode('wpcargo_trackresults', array( $this, 'wpcargo_trackform'));

		add_action('wpcargo_track_form', array( $this, 'wpcargo_trackform_template' ), 10 );

		add_action('wpcargo_track_result_form', array( $this, 'wpcargo_trackform_result_template' ), 10 );

		add_action('wpcargo_track_header_details', array( $this, 'wpcargo_trackform_result_header_details_template' ), 10 );

		add_action('wpcargo_track_shipper_details', array( $this, 'wpcargo_trackform_result_shipper_details_template' ), 10 );

		add_action('wpcargo_track_shipment_details', array( $this, 'wpcargo_trackform_result_shipment_details_template' ), 10 );

		add_filter('wpcargo_track_shipment_query', array( $this, 'wpcargo_trackform_result_query' ), 10 );



	}





	function wpcargo_trackform($atts) {



			$wpcargo_pull_quote_atts = shortcode_atts( array(

				'id' => '',

			), $atts );			

			ob_start();

			do_action('wpcargo_before_track_result_form', 10);

			do_action('wpcargo_track_form', $wpcargo_pull_quote_atts, 10);

			do_action('wpcargo_track_result_form', 10);

			do_action('wpcargo_after_track_result_form', 10);

			$output = ob_get_clean();

			return $output;



	}



	public function wpcargo_trackform_template( $atts ){

	

		global $wpdb;



		$wpcargo_pull_quote_atts = shortcode_atts( array(

			'id' => '',

		), $atts );



		require_once(WPCARGO_PLUGIN_PATH.'templates/track-form.tpl.php');



	}







	public function wpcargo_trackform_result_template(){

		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'templates/result-form.tpl.php');

	}





	public function wpcargo_trackform_result_shipment_details_template( $shipment_detail ){

		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'templates/result-form-shipment-details.tpl.php');

	}





	public function wpcargo_trackform_result_shipper_details_template( $shipment_detail ){

		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'templates/result-form-shipper-details.tpl.php');

	}











	public function wpcargo_trackform_result_header_details_template( $shipment_detail ){

		global $wpdb;

		require_once(WPCARGO_PLUGIN_PATH.'templates/result-form-header-details.tpl.php');

	}



	public function wpcargo_trackform_result_query() {



		global $wpdb, $results;

		$wpcargo_tn = isset($_REQUEST['wpcargo_tracking_number']) ? $_REQUEST['wpcargo_tracking_number'] : false ;

		$sql = "SELECT * FROM " . $wpdb->prefix . "posts WHERE post_title = '$wpcargo_tn' AND post_status = 'publish' AND post_type='wpcargo_shipment' LIMIT 1";

		$results = $wpdb->get_results($sql);

		return $results;

	}





}





$wpcargo_track_form = new WPCargo_Track_Form();