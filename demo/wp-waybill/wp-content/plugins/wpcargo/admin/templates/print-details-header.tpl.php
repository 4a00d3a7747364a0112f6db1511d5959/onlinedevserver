<?php
	$shipment_id	= $shipment_detail->ID;
	$tracknumber	= $shipment_detail->post_title;			
	$url_barcode	= WPCARGO_PLUGIN_URL."/includes/barcode.php?codetype=Code128&size=60&text=" . $tracknumber . "";
?>
<div id="wpcargo-print-layout" class="col-12">
  <div class="print-logo">
    <?php $options = get_option('wpcargo_option_settings');  ?>
    <img src="<?php echo $options['settings_shipment_ship_logo']; ?>"> </div>
  <!-- comp_logo -->
  
  <div class="print-tn">
    <h2><?php echo apply_filters('result_tracking_num', __('Tracking No: ', 'wpcargo')) . $tracknumber; ?></h2>
  </div>
  <!-- Track_Num -->
  
  <div class="print-b-code"> <img src="<?php echo $url_barcode; ?>" alt="<?php echo $tracknumber;?>" /> </div>
  <!-- b_code --> 
  
</div>