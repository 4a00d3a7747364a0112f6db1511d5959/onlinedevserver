<?php
if (!defined('ABSPATH')){
	exit; // Exit if accessed directly
}
$wpcargo_tn = isset($_REQUEST['wpcargo_tracking_number']) ? $_REQUEST['wpcargo_tracking_number'] : false;
?>
<div id="wpcargo-result-print">
  <div class="wpcargo-result" id="wpcargo-result">
    <?php
	
	
	if (isset($wpcargo_tn)) {
	
		global $results;
	
		$results = apply_filters('wpcargo_track_shipment_query', $results);
	
		if ( !empty($results) && !empty($wpcargo_tn) ) {
	
			foreach ($results as $shipment_detail) :
	
			do_action( 'wpcargo_before_search_result' );
	
			do_action( 'wpcargo_print_btn' ); ?>
    <div class="wpcargo-wrap-details">
      <?php do_action('wpcargo_before_track_details', $shipment_detail ); 
				
				 do_action('wpcargo_track_header_details', $shipment_detail ); 
				 do_action('wpcargo_track_shipper_details', $shipment_detail ); 
				  do_action('wpcargo_track_shipment_details', $shipment_detail ); 
				  do_action('wpcargo_after_track_details', $shipment_detail ); 
				  ?>
    </div>
    <?php endforeach;  do_action('wpcargo_after_search_result', $results ); 
	
		} else {
	
			if( !empty($wpcargo_tn)) { 
	
				?>
    <h3 style="color: red !important; text-align:center;margin-bottom:0;padding:12px;"><?php echo apply_filters('wpcargo_tn_no_result_text', __('No results found!','wpcargo') ); ?></h3>
    <?php
	
			}
	
		}
		
	}
	
	?>
  </div>
  <!-- wpcargo-result --> 
</div>
