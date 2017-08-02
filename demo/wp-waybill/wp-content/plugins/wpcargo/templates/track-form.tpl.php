<?php 

$wpcargo_tracking_number = ( isset( $_REQUEST['wpcargo_tracking_number'] ) ) ? $_REQUEST['wpcargo_tracking_number'] : '' ;

$get_result_page_id = $wpcargo_pull_quote_atts['id'];

if(!empty($get_result_page_id)) {

	$get_action = 'action="'.get_page_link($get_result_page_id).'"';

}

else {

	$get_action = 'action';

}

?>

<div class="wpcargo-track">
  <form method="post" name="wpcargo-track-form" <?php echo $get_action; ?>>
    <table class="track_form_table">
      <tr class="track_form_tr">
        <th class="track_form_th" colspan="2"><h4><?php echo apply_filters('wpcargo_tn_form_title', 'Enter the Consignment No.'); ?></h4></th>
      </tr>
      <tr class="track_form_tr">
        <td class="track_form_td"><input class="input_track_num" type="text" name="wpcargo_tracking_number" value="<?php echo $wpcargo_tracking_number; ?>" autocomplete="off" placeholder="<?php echo apply_filters('wpcargo_tn_placeholder', 'Enter Tracking Number'); ?>" required></td>
        <td class="track_form_td"><input id="submit_wpcargo" name="wpcargo-submit" type="submit" value="<?php echo apply_filters('wpcargo_tn_submit_val', 'TRACK RESULT'); ?>"></td>
      </tr>
      <?php

				do_action('wpcargo_add_form_fields');
	
			 	echo apply_filters('wpcargo_example_text', ' <tr class="track_form_tr"><td class="track_form_td" colspan="2"><h4>Ex: 12345</h4></td></tr>'); 

        $options = get_option('wpcargo_option_settings');

        if ( !empty( $options['settings_warning_text_checkbox'] ) ) {

			if( !empty( $options['settings_warning_text'] ) ){

			?>
      <tr class="track_form_tr">
        <td class="track_form_td" colspan="2"><div class="warning_track">
            <p><?php echo $options['settings_warning_text']; ?></p>
          </div></td>
      </tr>
      <?php 

			}else{

			?>
      <tr class="track_form_tr">
        <td class="track_form_td" colspan="2"><div class="warning_track">
            <p>
              <?php _e('This page is a DEMO of the Tracking Script Software.<br>The Consignment Numbers loaded are for testing and are NOT real.<br>If you have been redirected here for TRACKING a real cargo or wpcargo_courier package, it is fake.', 'wpcargo'); ?>
            </p>
          </div></td>
      </tr>
      <?php

			}

		} ?>
    </table>
  </form>
</div>
