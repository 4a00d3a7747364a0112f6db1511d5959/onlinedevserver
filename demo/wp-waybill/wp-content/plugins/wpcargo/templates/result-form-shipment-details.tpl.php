<?php



	$shipment_id 						= $shipment_detail->ID;



	$shipment_origin  					= get_post_meta($shipment_id, 'wpcargo_origin_field', true);



	$wpcargo_status   					= get_post_meta($shipment_id, 'wpcargo_status', true);



	$shipment_destination  				= get_post_meta($shipment_id, 'wpcargo_destination', true);



	$type_of_shipment  					= get_post_meta($shipment_id, 'wpcargo_type_of_shipment', true);



	$shipment_weight  					= get_post_meta($shipment_id, 'wpcargo_weight', true);



	$shipment_courier  					= get_post_meta($shipment_id, 'wpcargo_courier', true);



	$shipment_carrier_ref_number  		= get_post_meta($shipment_id, 'wpcargo_carrier_ref_number', true);



	$shipment_product  					= get_post_meta($shipment_id, 'wpcargo_product', true);



	$shipment_qty  						= get_post_meta($shipment_id, 'wpcargo_qty', true);



	$shipment_payment_mode  			= get_post_meta($shipment_id, 'payment_wpcargo_mode_field', true);



	$shipment_total_freight  			= get_post_meta($shipment_id, 'wpcargo_total_freight', true);



	$shipment_mode  					= get_post_meta($shipment_id, 'wpcargo_mode_field', true);



	$shipment_departure_time  			= get_post_meta($shipment_id, 'wpcargo_departure_time_picker', true);



	$shipment_expected_delivery_date	= get_post_meta($shipment_id, 'wpcargo_expected_delivery_date_picker', true);



	$shipment_comments  				= get_post_meta($shipment_id, 'wpcargo_comments', true);



	$shipment_packages  				= get_post_meta($shipment_id, 'wpcargo_packages', true);



	$shipment_carrier  					= get_post_meta($shipment_id, 'wpcargo_carrier_field', true);



	$shipment_pickup_date  				= get_post_meta($shipment_id, 'wpcargo_pickup_date_picker', true);



	$shipment_pickup_time  				= get_post_meta($shipment_id, 'wpcargo_pickup_time_picker', true);


	$wpc_date_format 					= get_option( 'date_format' );	
	
	$wpc_time_format 					= get_option( 'time_format' );	


?>







<div id="shipment-info">



	<div class="col-4">



    	<p class="label"><?php _e('Origin:', 'wpcargo') . ''; ?></p>



        <p class="label-info"><?php echo $shipment_origin; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Package:', 'wpcargo') . ''; ?></p>



        <p class="label-info"><?php echo $shipment_packages; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Status:', 'wpcargo'); ?></p>



        <p class="label-info"><?php  echo $wpcargo_status; ?></p>



    </div>



    <div class="clear-line"></div>



    <div class="col-4">



    	<p class="label"><?php  _e('Destination:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_destination; ?></td></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Carrier:', 'wpcargo') . ''; ?></p>



        <p class="label-info"><?php echo $shipment_carrier; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Carrier:', 'wpcargo') . ''; ?></p>



        <p class="label-info"><?php echo $shipment_carrier; ?></p>



    </div>



    <div class="clear-line"></div>



    <div class="col-4">



    	<p class="label"><?php _e('Type of Shipment:', 'wpcargo'); ?></p>



        <p class="label-info"><?php  echo $type_of_shipment; ?></p>



    </div>







    <div class="col-4">



    	<p class="label"><?php _e('Weight:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_weight; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Shipment Mode:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_mode; ?></p>



    </div>







    <div class="clear-line"></div>







    <div class="col-4">



    	<p class="label"><?php _e('Carrier Reference No.:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_carrier_ref_number; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Product:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_product; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Qty:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_qty; ?></p>



    </div>



    <div class="clear-line"></div>



    <div class="col-4">



    	<p class="label"><?php _e('Payment Mode:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_payment_mode; ?></p>



    </div>







    <div class="col-4">



    	<p class="label"><?php _e('Total Freight:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo $shipment_total_freight; ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Expected Delivery Date:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo date($wpc_date_format, strtotime($shipment_expected_delivery_date)); ?></p>



    </div>



    <div class="clear-line"></div>



    <div class="col-4">



    	<p class="label"><?php _e('Departure Time:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo date($wpc_time_format, strtotime($shipment_departure_time)); ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Pick-up Date:', 'wpcargo'); ?></p>

        <p class="label-info"><?php echo date($wpc_date_format, strtotime($shipment_pickup_date)); ?></p>



    </div>



    <div class="col-4">



    	<p class="label"><?php _e('Pick-up Time:', 'wpcargo'); ?></p>



        <p class="label-info"><?php echo date($wpc_time_format, strtotime($shipment_pickup_time)); ?></p>



    </div>



    <div class="clear-line"></div>



    <div class="col-12">



    	<p class="label"><?php _e('Comments:', 'wpcargo'); ?> </p>



        <p class="label-info"><?php echo $shipment_comments; ?></p>



    </div>



	<div class="clear-line"></div>



</div>