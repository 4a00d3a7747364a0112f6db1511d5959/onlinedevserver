<?php
  $recipnote = WC()->session->get('recipnote');
   $dsname = WC()->session->get('recipient_dsname');
   $reactiveds = WC()->session->get('reactive');	
?>
<?php if($reactiveds=='hidegifthtml'){?>
<style>
#recivuserinfo{
	display:none;
	clear:both;
	}
.form_inner{
	padding:20px 0 80px 0;
	}

</style><?php }?>
<style>
#loderds{
	display:none;
	position:fixed;
	top:10px;
	left:40%;	
	z-index:99999;
	
	}
</style>
<img src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_512.gif" id="loderds" />
<fieldset>
	<?php /*?><input type="checkbox" id="gifting_<?php echo esc_attr( $id ); ?>_option" class="woocommerce_subscription_gifting_checkbox" value="gift" <?php echo esc_attr( ( empty( $email ) ) ? '' : 'checked' ); ?> />
	
    <input type="checkbox" id="gifting_<?php echo esc_attr( $id ); ?>_option" class="woocommerce_subscription_gifting_checkbox" value="gift" checked="checked" />
    <label for="gifting_<?php echo esc_attr( $id ); ?>_option">
		<?php echo esc_html( apply_filters( 'wcsg_enable_gifting_checkbox_label', get_option( WCSG_Admin::$option_prefix . '_gifting_checkbox_text', __( 'This is a gift', 'woocommerce_subscriptions_gifting' ) ) ) ); ?>
	</label>
	<p class="form-row form-row <?php echo esc_attr( implode( ' ', $email_field_args['class'] ) ); ?>" style="<?php echo esc_attr( implode( '; ', $email_field_args['style_attributes'] ) ); ?>"><?php */?>
   <?php /*?> <input class="form-control"  id="recipient_dsname[<?php echo esc_attr( $id ); ?>]" name="recipient_dsname[<?php echo esc_attr( $id ); ?>]" placeholder="Gift Recipient Name" value="<?php echo esc_attr( $dsname ); ?>" type="text" required="required"><?php */

   ?>
    <input class="form-control"  id="recipient_dsname" name="recipient_dsname" placeholder="Gift Recipient Name" value="<?php echo esc_attr( $dsname ); ?>" type="text" required="required">
    
		<label for="recipient_email[<?php echo esc_attr( $id ); ?>]">
			<?php esc_html_e( "Recipient's Email Address:", 'woocommerce-subscriptions-gifting' ); ?>
		</label>
        <input type="email" class="input-text recipient_email" name="recipient_email[<?php echo esc_attr( $id ); ?>]" id="recipient_email[<?php echo esc_attr( $id ); ?>]" placeholder="Gift Recipient Email" value="<?php echo esc_attr( $email ); ?>"/>
        <span class="err-msg" style="display:none;">Please complete the required field</span>
		<input type="email" class="input-text recipient_email comfds" name="recipient_emailds" id="recipient_email" placeholder="Confirm Recipient Email" value="<?php echo esc_attr( $email ); ?>"/>
        <span class="err-msg" style="display:none;">Please complete the required field</span>
        <?php /*?><input type="email" class="input-text recipient_email" name="recipient_email[<?php echo esc_attr( $id ); ?>]" id="recipient_email[<?php echo esc_attr( $id ); ?>]" placeholder="<?php echo esc_attr( $email_field_args['placeholder'] ); ?>" value="<?php echo esc_attr( $email ); ?>"/>
        <input type="email" class="input-text recipient_email" name="recipient_email[<?php echo esc_attr( $id ); ?>]" id="recipient_email[<?php echo esc_attr( $id ); ?>]" placeholder="Confirm Recipient Email" value="<?php echo esc_attr( $email ); ?>"/><?php */?>
        <?php /*?><textarea class="form-control" cols="20"  id="recipnote[<?php echo esc_attr( $id ); ?>]" maxlength="300" name="recipnote[<?php echo esc_attr( $id ); ?>]" placeholder="Gift Message" row="4" rows="2"><?php echo esc_attr( $recipnote ); ?></textarea><?php */?>
        <textarea class="form-control" cols="20"  id="recipnote" maxlength="300" name="recipnote" placeholder="Gift Message" row="4" rows="2"><?php echo esc_attr( $recipnote ); ?></textarea>
		<?php wp_nonce_field( 'wcsg_add_recipient', '_wcsgnonce' );
		
		 ?>
	<?php /*?></p><?php */?>
</fieldset>

