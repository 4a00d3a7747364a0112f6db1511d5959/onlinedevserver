<?php

	$shipment_id 		= $shipment_detail->ID;

	$shipper_name		= get_post_meta($shipment_id, 'wpcargo_shipper_name', true);

	$shipper_address	= get_post_meta($shipment_id, 'wpcargo_shipper_address', true);

	$shipper_phone		= get_post_meta($shipment_id, 'wpcargo_shipper_phone', true);

	$shipper_email		= get_post_meta($shipment_id, 'wpcargo_shipper_email', true);

	$receiver_name		= get_post_meta($shipment_id, 'wpcargo_receiver_name', true);

	$receiver_address	= get_post_meta($shipment_id, 'wpcargo_receiver_address', true);

	$receiver_phone		= get_post_meta($shipment_id, 'wpcargo_receiver_phone', true);

	$receiver_email		= get_post_meta($shipment_id, 'wpcargo_receiver_email', true);

?>
<div id="print-shipper-info">
  <div class="col-6">
    <p id="print-shipper-header"><strong><?php echo apply_filters('result_shipper_address', __('Shipper Address', 'wpcargo')); ?></strong></p>
    <p class="shipper details"><?php echo $shipper_name; ?><br />
      <?php echo $shipper_address; ?><br />
      <?php echo $shipper_phone; ?><br />
      <?php echo $shipper_email; ?><br />
    </p>
  </div>
  <div class="col-6">
    <p id="print-receiver-header"><strong><?php echo apply_filters('result_receiver_address', __('Receiver Address', 'wpcargo')); ?></strong></p>
    <p class="receiver details"><?php echo $receiver_name; ?><br />
      <?php echo $receiver_address; ?><br />
      <?php echo $receiver_phone; ?><br />
      <?php echo $receiver_email; ?><br />
    </p>
  </div>
  <div class="clear-line"></div>
</div>