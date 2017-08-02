<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
add_action('wpcargo_after_track_details', 'wpc_shipment_history_details');
function wpc_shipment_history_details() {
	global $wpdb;
	?>
	<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		.wpcargo-history-details table#list-container, 
		.wpcargo-history-details table#list-container thead, 
		.wpcargo-history-details table#list-container tbody, 
		.wpcargo-history-details table#list-container th, 
		.wpcargo-history-details table#list-container td, 
		.wpcargo-history-details table#list-container tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		.wpcargo-history-details table#list-container thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		.wpcargo-history-details table#list-container tr { 
			border: 1px solid #ccc; 
			text-align: initial !important;

		}
		
		.wpcargo-history-details table#list-container td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 50% !important;
    		text-align: initial !important;
		}
		
		.wpcargo-history-details table#list-container td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		#wpcargo-result-print .wpcargo-history-details #list-container tbody tr {
		    background-color: #d6d6d6;
		        width: 100%;
		}
		#wpcargo-result-print .wpcargo-history-details #list-container tbody tr:nth-child(odd) {
		    background-color: #f1f1f1;
		}
		
		/*
		Label the data
		*/
		.wpcargo-history-details table#list-container td:nth-of-type(1):before { content: "<?php _e('Date.', 'wpcargo'); ?>"; }
		.wpcargo-history-details table#list-container td:nth-of-type(2):before { content: "<?php _e('Time', 'wpcargo'); ?>"; }
		.wpcargo-history-details table#list-container td:nth-of-type(3):before { content: "<?php _e('Location', 'wpcargo'); ?>"; }
		.wpcargo-history-details table#list-container td:nth-of-type(4):before { content: "<?php _e('Status', 'wpcargo'); ?>"; }
		.wpcargo-history-details table#list-container td:nth-of-type(5):before { content: "<?php _e('Remarks', 'wpcargo'); ?>"; }
	}
	
</style>
	<div id="wpcargo-history-section" class="wpcargo-history-details">
		<p class="track-section-header"><strong><?php _e('Shipment History', 'wpcargo'); ?></strong></p>
		<?php
		$get_current_page = isset($_GET['page']) ? $_GET['page'] : '';
		$get_current_id = isset($_GET['id']) ? $_GET['id'] : '';
		$wpcargo_tn = isset($_REQUEST['wpcargo_tracking_number']) ? $_REQUEST['wpcargo_tracking_number'] : '';
		if($get_current_page == 'wpcargo-print-layout') {
			$add_query = 'ID = '. $get_current_id .'';
		}
		else{	
			$add_query = 'post_title = "'. $wpcargo_tn .'"';
		}
		$get_shipment_sql = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "posts WHERE " .$add_query. " AND post_status = 'publish' AND post_type='wpcargo_shipment'");
		?>
		
		<table id="list-container" style="width: 100%;">
		<thead>
		<tr class="wpc-ca-list-tr">
			<th class="wpc-ca-list-th"><?php _e('Date','wpcargo'); ?></th>
			<th class="wpc-ca-list-th"><?php _e('Time','wpcargo'); ?></th>
			<th class="wpc-ca-list-th"><?php _e('Location','wpcargo'); ?></th>
			<th class="wpc-ca-list-th"><?php _e('Status','wpcargo'); ?></th>
			<th class="wpc-ca-list-th"><?php _e('Remarks','wpcargo'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$wpc_date_format 					= get_option( 'date_format' );	
		$wpc_time_format 					= get_option( 'time_format' );	
		if(!empty($get_shipment_sql)) {
			foreach($get_shipment_sql as $shipment) {
				$trackid = $shipment->ID;
				$tracknumber = $shipment->post_title;
				$shipment_history = maybe_unserialize( get_post_meta( $trackid, 'wpcargo_shipments_update', true ) );
					if(!empty($shipment_history)){
						usort($shipment_history, 'wpc_date_history_compare');
						foreach(array_reverse($shipment_history) as $shipments){
							?>
							<tr class="wpc-ca-list-tr">
								<td class="wpc-ca-list-td"><?php echo !empty($shipments['date']) ? date($wpc_date_format, strtotime($shipments['date'])) : ''; ?></td>
								<td class="wpc-ca-list-td"><?php echo !empty($shipments['time']) ? date($wpc_time_format, strtotime($shipments['time'])) : ''; ?></td>
								<td class="wpc-ca-list-td"><?php echo $shipments['location']; ?></td>
								<td class="wpc-ca-list-td"><?php echo $shipments['status']; ?></td>
								<td class="wpc-ca-list-td"><?php echo $shipments['remarks']; ?></td>
							</tr>
							<?php
						}
					}					
			}
		}
		?>
		</tbody>
		</table>
	</div>
	<?php
}
function wpc_date_history_compare($a, $b) {
    $t1 = strtotime($a['date'] ." ". $a['time'] );
    $t2 = strtotime($b['date'] ." ". $b['time'] );
    return $t1 - $t2;
}
