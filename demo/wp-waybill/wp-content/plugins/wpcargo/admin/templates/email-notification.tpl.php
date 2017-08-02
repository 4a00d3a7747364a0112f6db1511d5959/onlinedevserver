<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options 			= get_option('wpcargo_mail_settings');
$options2 			= get_option('wpcargo_option_settings');
if (!empty($options['wpcargo_active_mail'])) {		
	
	$current_status	= isset($_REQUEST['wpcargo_status']) ? $_REQUEST['wpcargo_status'] : '';	
	$wpcargo_tn		= get_the_title($post_id);	
	$shipper_email  = get_post_meta($post_id, 'wpcargo_shipper_email', true);	
	$receiver_email = get_post_meta($post_id, 'wpcargo_receiver_email', true);	
	$shipper_phone  = get_post_meta($post_id, 'wpcargo_shipper_phone', true);	
	$receiver_phone = get_post_meta($post_id, 'wpcargo_receiver_phone', true);	
	$admin_email    = get_option('admin_email');	
	$shipper_name   = get_post_meta($post_id, 'wpcargo_shipper_name', true);	
	$receiver_name  = get_post_meta($post_id, 'wpcargo_receiver_name', true);	
	$status         = get_post_meta($post_id, 'wpcargo_status', true);	
	$site_name      = get_bloginfo('name');	
	$site_url      	= get_bloginfo('url');	
	
	$str_find       = array(	
		'{wpcargo_tracking_number}',	
		'{shipper_email}',	
		'{receiver_email}',	
		'{shipper_phone}',	
		'{receiver_phone}',	
		'{admin_email}',	
		'{shipper_name}',	
		'{receiver_name}',	
		'{status}',	
		'{site_name}',	
		'{site_url}'	
	);
	
	$str_replce     = array(	
		$wpcargo_tn,	
		$shipper_email,	
		$receiver_email,	
		$shipper_phone,	
		$receiver_phone,	
		$admin_email,	
		$shipper_name,	
		$receiver_name,	
		$status,	
		$site_name,	
		$site_url	
	);
	
	$get_default_logo = WPCARGO_PLUGIN_URL.'admin/assets/images/wpcargo-logo-email.png';	
	$get_default_footer = WPCARGO_PLUGIN_URL.'admin/assets/images/wpc-email-footer.png';
	$get_general_logo = $options2['settings_shipment_ship_logo'];	
	$get_the_logo = !empty($get_general_logo) ? $get_general_logo : $get_default_logo;	
	$get_the_mail_content = !empty($options['wpcargo_mail_message']) ? $options['wpcargo_mail_message'] : '<p>Dear {shipper_name},</p>	
	<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">We are pleased to inform you that your shipment has now cleared customs and is now {status}.</p>
	<br />
	<h4 style="font-size: 1.5em; color: #0000;">Tracking Information</h4>
	<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">Tracking Number - {wpcargo_tracking_number}</p>
	<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">Latest International Scan: Customs status updated</p>
	<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">We hope this meets with your approval. Please do not hesitate to get in touch if we can be of any further assistance.</p>	
	<br />
	<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">Yours sincerely</p>
	<p style="font-size: 1em;margin:.5em 0px;line-height: initial;"><a href="{site_url}">{site_name}</a></p>';
	$get_the_mail_footer = !empty($options['wpcargo_mail_footer']) ? $options['wpcargo_mail_footer'] : '<div class="wpc-contact-info" style="margin-top: 10px;">
		<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">Your Address Here...</p>
		<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">Email: <a href="mailto:{admin_email}">{admin_email}</a> - Web: <a href="{site_url}">{site_name}</a></p>
		<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">Phone: <a href="tel:">Your Phone Number Here</a>, <a href="tel:">Your Phone Number Here</a></p>
	</div>
	<div class="wpc-contact-bottom" style="margin-top: 2em; padding: 1em; border-top: 1px solid #000;">	
		<p style="font-size: 1em;margin:.5em 0px;line-height: initial;">This message is intended solely for the use of the individual or organisation to whom it is addressed. It may contain privileged or confidential information. If you have received this message in error, please notify the originator immediately. If you are not the intended recipient, you should not use, copy, alter or disclose the contents of this message. All information or opinions expressed in this message and/or any attachments are those of the author and are not necessarily those of {site_name} or its affiliates. {site_name} accepts no responsibility for loss or damage arising from its use, including damage from virus.</p>	
	</div>';
	$headers        = 'From: ' . $options['wpcargo_mail_header'];	
	$subject        = str_replace($str_find, $str_replce, $options['wpcargo_mail_subject']);	
	$send_to        = str_replace($str_find, $str_replce, $options['wpcargo_mail_to']);		
	$message        = str_replace($str_find, $str_replce, 	
	'<div class="wpc-email-notification-wrap" style="width: 100%; font-family: sans-serif;">	
		<div class="wpc-email-notification" style="padding: 3em; background: #efefef;">	
			<div class="wpc-email-template" style="background: #fff; width: 95%; margin: 0 auto;">	
				<div class="wpc-email-notification-logo" style="padding: 2em 2em 0px 2em;">	
					<img src="'.$get_the_logo.'" />	
				</div>	
				<div class="wpc-email-notification-content" style="padding: 2em 2em 1em 2em; font-size: 18px;">
					'.$get_the_mail_content.'
				</div>
				<div class="wpc-email-notification-footer" style="font-size: 10px; text-align: center; margin: 0 auto;">	
					<div class="wpc-footer-devider">	
					<img src="'.$get_default_footer.'" style="width:100%;" />	
				</div>
					'.$get_the_mail_footer.'
				</div>	
			</div>	
		</div>	
	</div>');
	
	if( $current_status != $status ) {	
		wp_mail( $send_to, $subject, $message, $headers );	
	}	
}
