
<form method="post" action="options.php" class="email-setting-admin-form">
  <h5 style="color: #F00;">
    <?php _e('WPCargo Merge Tags','wpcargo'); ?>
  </h5>
  <p style="font-size: 12px; color: #F00;"> {wpcargo_tracking_number} =

    <?php _e('Tracking Number','wpcargo'); ?>

    <br>

    {shipper_email} =

    <?php _e('Shipper Email','wpcargo'); ?>

    <br>

    {receiver_email} =

    <?php _e('Receiver Email','wpcargo'); ?>

    <br>

    {shipper_phone} =

    <?php _e('Shipper Phone','wpcargo'); ?>

    <br>

    {receiver_phone} =

    <?php _e('Receiver Phone','wpcargo'); ?>

    <br>

    {admin_email} =

    <?php _e('Admin Email','wpcargo'); ?>

    <br>

    {shipper_name} =

    <?php _e('Name of the Shipper','wpcargo'); ?>

    <br>

    {receiver_name} =

    <?php _e('Name of the Receiver','wpcargo'); ?>

    <br>

    {status} =

    <?php _e('Shipment Status','wpcargo'); ?>

    <br>

    {site_name} =

    <?php _e('Website Name','wpcargo'); ?>
	
    <br>

    {site_url} =

    <?php _e('Website URL','wpcargo'); ?>

  </p>

  <?php settings_fields( 'wpcargo_mail_settings' ); 

	do_settings_sections( 'wpcargo_mail_settings' ); ?>

  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">Activate Email?</th>
        <td><input type="checkbox" name="wpcargo_mail_settings[wpcargo_active_mail]" <?php checked(isset($options['wpcargo_active_mail']), 1); ?> value="1">
          <p style="font-size: 10px;">
            <?php _e('Please check if you want to send email after updating the shipment.','wpcargo'); ?>
          </p>
		 </td>
      </tr>

      <tr>
        <th scope="row">Headers:</th>
        <td><input type="text" placeholder="WPCargo <do-not-reply@wpcargo.com>" name="wpcargo_mail_settings[wpcargo_mail_header]" value="<?php
    echo !empty($options['wpcargo_mail_header']) ? $options['wpcargo_mail_header'] : ''; ?>" >
          <p style="font-size: 10px;">
            <?php _e('Edit this if you want to change the header of your email automation.','wpcargo'); ?>
          </p></td>
      </tr>

      <tr>
        <th scope="row">Mail To:</th>
        <td><input type="text" name="wpcargo_mail_settings[wpcargo_mail_to]" placeholder="{shipper_email}, {receiver_email}, {admin_email}" value="<?php echo !empty($options['wpcargo_mail_to']) ? $options['wpcargo_mail_to'] : ''; ?>">
          <p style="font-size: 10px;">Add emails with comma separated.(You can add WPCargo Merge Tags)<br>
            sample_1@mail.com, @sample_2@mail.com </p></td>
      </tr>
	  
      <tr>
        <th scope="row"><?php _e('Subject:','wpcargo'); ?></th>
        <td><input type="text" name="wpcargo_mail_settings[wpcargo_mail_subject]" value="<?php echo !empty($options['wpcargo_mail_subject']) ? $options['wpcargo_mail_subject'] : ''; ?>">
          <p style="font-size: 10px;">
            <?php _e('Email Subject','wpcargo'); ?>
          </p>
		</td>
      </tr>

      <tr>
        <th scope="row"><?php _e('Message Content:','wpcargo'); ?></th>
        <td><textarea cols="40" rows="5" placeholder='<p>Dear {shipper_name},</p>
		<p>We are pleased to inform you that your shipment has now cleared customs and is now {status}.</p>
		<br />
		<h4 style="font-size: 25px; color: #00a924;">Tracking Information</h4>
		<p>Tracking Number - {wpcargo_tracking_number}</p>
		<p>Latest International Scan: Customs status updated</p>
		<p>We hope this meets with your approval. Please do not hesitate to get in touch if we can be of any further assistance.</p>
		<br />
		<p>Yours sincerely</p>
		<p><a href="{site_url}">{site_name}</a></p>' name='wpcargo_mail_settings[wpcargo_mail_message]'><?php echo !empty($options['wpcargo_mail_message']) ? $options['wpcargo_mail_message'] : ''; ?></textarea></td>
      </tr>

      <tr>
        <th scope="row"><?php _e('Footer:','wpcargo'); ?></th>
        <td><textarea cols="40" rows="5" placeholder='
		<div class="wpc-contact-info" style="margin-top: 10px;">
			<p>Your Address Here...</p>
			<p>Email: <a href="mailto:{admin_email}">{admin_email}</a> - Web: <a href="{site_url}">{site_name}</a></p>
			<p>Phone: <a href="tel:">Your Phone Number Here</a>, <a href="tel:">Your Phone Number Here</a></p>
		</div>
		<div class="wpc-contact-bottom" style="margin-top: 20px; padding: 5px; border-top: 1px solid #000;">
			<p>This message is intended solely for the use of the individual or organisation to whom it is addressed. It may contain privileged or confidential information. If you have received this message in error, please notify the originator immediately. If you are not the intended recipient, you should not use, copy, alter or disclose the contents of this message. All information or opinions expressed in this message and/or any attachments are those of the author and are not necessarily those of {site_name} or its affiliates. {site_name} accepts no responsibility for loss or damage arising from its use, including damage from virus.</p>
		</div>' name='wpcargo_mail_settings[wpcargo_mail_footer]'><?php echo !empty($options['wpcargo_mail_footer']) ? $options['wpcargo_mail_footer'] : ''; ?></textarea></td>
      </tr>
	  
	  
	  <tr>
	  	<td><a href="http://www.wpcargo.com/email-settings/#wpc-email-output" target="_blank">View sample email output</a></td>
	  </tr>


    </tbody>



  </table>



  <?php submit_button(); ?>



</form>