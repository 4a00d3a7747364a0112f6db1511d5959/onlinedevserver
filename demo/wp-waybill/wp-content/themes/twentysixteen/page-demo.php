<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php //echo do_shortcode('[wpcargo_trackform]'); ?>

<?php
	echo '<div class="trackform"><table><tr><form method="post" action="">';
	echo '<tr><td>Try below tracking numbers:<br><b>wpcargo14682428593</b><br><b>wpcargo1579822344</b><br><br></td></tr>';
	echo '<td><input type="text" placeholder="Tracking number" name="wpcargo_tracking_number" autocomplete="off"></td>';
	echo '<td><input type="submit" value="Track"></td>';
	echo '</form></tr>';
	echo '</table></div>';
?>

<?php
	if (!defined('ABSPATH')){
		exit; // Exit if accessed directly
	}
	$wpcargo_tn = isset($_REQUEST['wpcargo_tracking_number']) ? $_REQUEST['wpcargo_tracking_number'] : false;
	$waybill = isset($_REQUEST['waybill']) ? $_REQUEST['waybill'] : false;

	if (isset($wpcargo_tn)) {
	
	global $results;

	$results = apply_filters('wpcargo_track_shipment_query', $results);

	if ( !empty($results) && !empty($wpcargo_tn) ) {



	foreach ($results as $shipment_detail) :

	do_action( 'wpcargo_before_search_result' );

	//do_action( 'wpcargo_print_btn' );

	//variables for shipment fields
	$shipment_id = $shipment_detail->ID;
	$tracknumber = $shipment_detail->post_title;
	$url_barcode = WPCARGO_PLUGIN_URL."/includes/barcode.php?codetype=Code128&size=60&text=" . $tracknumber . "";
	$options = get_option('wpcargo_option_settings'); 

	$shipper_name = get_post_meta($shipment_id, 'wpcargo_shipper_name', true);
	$shipper_phone = get_post_meta($shipment_id, 'wpcargo_shipper_phone', true);
	$shipper_address = get_post_meta($shipment_id, 'wpcargo_shipper_address', true);
	$shipper_mail = get_post_meta($shipment_id, 'wpcargo_shipper_email', true);

	$receiver_name = get_post_meta($shipment_id, 'wpcargo_receiver_name', true);
	$receiver_phone = get_post_meta($shipment_id, 'wpcargo_receiver_phone', true);
	$receiver_address = get_post_meta($shipment_id, 'wpcargo_receiver_address', true);
	$receiver_mail = get_post_meta($shipment_id, 'wpcargo_receiver_email', true);

	if($waybill!='true'){
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="full-blk">
			<div class="top-blk">
				<div class="left-top-blk">
					<img src="<?php echo $options['settings_shipment_ship_logo']; ?>" alt="#">
				</div>
				<div class="right-top-blk">
					<?php 
						$options = get_option('wpcargo_option_settings');  
						$barcode_settings = $options['settings_barcode_checkbox'];
						if(!empty($barcode_settings)) {
					?>
				          <div class="b_code"> <img src="<?php echo $url_barcode; ?>" alt="<?php echo $tracknumber;?>" /> </div>
				          <!-- b_code -->
				          
				          <?php
						}
					?>
          			<p style="margin: 10px 0; text-align: center;"> <?php echo $tracknumber;?></p>
				</div>
			</div>

			<div class="mid-blk">
				<form method="post" action="">
					<button type="submit">Click here for Way Bill</button>
					<input type="hidden" name="wpcargo_tracking_number" value="<?php echo $wpcargo_tn; ?>">
					<input type="hidden" name="waybill" value="true">
				</form>
			</div>

			<div class="bot-blk">
				<h2>Shipper Information</h2>
				<div class="repeat"><?php echo $shipper_name; ?></div>
				<div class="repeat"><?php echo $shipper_phone; ?></div>
				<div class="repeat"><?php echo $shipper_address; ?></div>
				<div class="repeat"><?php echo $shipper_mail; ?></div>
			</div>

			<!-- <div class="bot-blk">
				<h2>Receiver Information</h2>
				<div class="repeat"><?php echo $receiver_name; ?></div>
				<div class="repeat"><?php echo $receiver_phone; ?></div>
				<div class="repeat"><?php echo $receiver_address; ?></div>
				<div class="repeat"><?php echo $receiver_mail; ?></div>
			</div> -->

		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php 
}else{
?>

<?php do_action( 'wpcargo_print_btn' ); ?>
<div id="wpcargo-result-print">
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<h2 style="text-align: center;">Way Bill</h2>
		<div class="full-blk">
			<div class="top-blk">
				<div class="left-top-blk">
					<img src="<?php echo $options['settings_shipment_ship_logo']; ?>" alt="#">
				</div>
				<div class="right-top-blk">
					<?php 
						$options = get_option('wpcargo_option_settings');  
						$barcode_settings = $options['settings_barcode_checkbox'];
						if(!empty($barcode_settings)) {
					?>
				          <div class="b_code"> <img src="<?php echo $url_barcode; ?>" alt="<?php echo $tracknumber;?>" /> </div>
				          <!-- b_code -->
				          
				          <?php
						}
					?>
          			<p style="margin: 10px 0; text-align: center;"> <?php echo $tracknumber;?></p>
				</div>
			</div>

			<div class="bot-blk">
				<h2>Shipper Information</h2>
				<div class="repeat"><?php echo $shipper_name; ?></div>
				<div class="repeat"><?php echo $shipper_phone; ?></div>
				<div class="repeat"><?php echo $shipper_address; ?></div>
				<div class="repeat"><?php echo $shipper_mail; ?></div>
			</div>

			<div class="bot-blk">
				<h2>Receiver Information</h2>
				<div class="repeat"><?php echo $receiver_name; ?></div>
				<div class="repeat"><?php echo $receiver_phone; ?></div>
				<div class="repeat"><?php echo $receiver_address; ?></div>
				<div class="repeat"><?php echo $receiver_mail; ?></div>
			</div>

		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->
</div>
<?php 

}
endforeach; ?>
<?php do_action('wpcargo_after_search_result', $results ); ?>
<?php

} else {

if( !empty($wpcargo_tn)) { 

?>
<h3 style="color: red !important; text-align:center;margin-bottom:0;padding:12px;"><?php echo apply_filters('wpcargo_tn_no_result_text', __('Pending Shipment. Please check later for update.','wpcargo') ); ?></h3>
<?php

}
}
}

?>

<?php get_footer(); ?>
