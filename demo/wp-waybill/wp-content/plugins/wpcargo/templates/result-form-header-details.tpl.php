<?php

	$shipment_id	= $shipment_detail->ID;
	$tracknumber	= $shipment_detail->post_title;		
	$url_barcode	= WPCARGO_PLUGIN_URL."/includes/barcode.php?codetype=Code128&size=60&text=" . $tracknumber . "";

?>



<div id="wpcargo-header" class="col-12">



    <div class="comp_logo">



        <?php $options = get_option('wpcargo_option_settings');  ?>



        <img src="<?php echo !empty($options['settings_shipment_ship_logo']) ? $options['settings_shipment_ship_logo'] : ''; ?>"> 



    </div><!-- comp_logo -->



    <div class="Track_Num">



        <h2><?php echo apply_filters('result_tracking_num', __('Tracking No: ', 'wpcargo')) . $tracknumber; ?></h2>



    </div><!-- Track_Num -->



	<?php 



		$options = get_option('wpcargo_option_settings');  



		$barcode_settings = !empty($options['settings_barcode_checkbox']) ? $options['settings_barcode_checkbox'] : '';



		if(!empty($barcode_settings)) {



	?>



    <div class="b_code"> 



        <img src="<?php echo $url_barcode; ?>" alt="<?php echo $tracknumber;?>" />



    </div><!-- b_code -->



	<?php



		}



	?>



</div>