<div id="shipment-history">		<div id="sh-header-block">
	<div id="sh-date" class="one-sixth first sh-header"><?php _e('Date', 'wpcargo'); ?></div>
	<div id="sh-time" class="one-sixth sh-header"><?php _e('Time', 'wpcargo'); ?></div>
	<div id="sh-location" class="one-sixth sh-header"><?php _e('Location', 'wpcargo'); ?></div>
	<div id="sh-status" class="one-sixth sh-header"><?php _e('Status', 'wpcargo'); ?></div>
	<div id="sh-remarks" class="one-sixth sh-header"><?php _e('Remarks', 'wpcargo'); ?></div>
	<div id="sh-update-by" class="one-sixth sh-updated-by"><?php _e('Update By', 'wpcargo'); ?></div>
	<div class="one-sixth">&nbsp;</div>
	<div class="clear-line"></div>
</div>

	<div data-repeater-list="shipment_history">
	<?php
	if( !empty($shipments) ) {
	foreach( $shipments as $shipment) {
	?>
	<div data-repeater-item class="history-data">

	<div class="one-sixth first sh-data data-date"><input class="datepicker" type="text" name="date" value="<?php echo !empty($shipment['date']) ? date_i18n("Y-m-d", strtotime($shipment['date'])) : ''; ?>"/></div>
	<div class="one-sixth sh-data data-time"><input class="timepicker" type="text" name="time" value="<?php echo $shipment['time']; ?>"/></div>
	<div class="one-sixth sh-data data-location"><input type="text" name="location" value="<?php echo $shipment['location']; ?>"/></div>
	<div class="one-sixth sh-data data-status">
	<select name="status">
		<option value="" ><?php _e('Select Option','wpcargo'); ?></option>
		<?php
			if (function_exists('wpcargo_custom_fields_callback')) {
				foreach ($get_custom_fields as $field_data) {
					$field_data            = maybe_unserialize($field_data->field_data);
					$get_custom_field_data = $field_data['options'];
					foreach ($get_custom_field_data as $val) {
					?>
					<option value="<?php

							echo __(sanitize_text_field($val), 'wpcargo');

					?>"

						<?php echo ( trim($val) == $shipment['status']  ) ? 'selected' : '' ; ?>

					><?php

							echo __(sanitize_text_field($val), 'wpcargo');

					?></option>

					<?php

								}
							}
						} else {

							$settings_opt = get_option('wpcargo_option_settings');

							$statuses     = $settings_opt['settings_shipment_status'];

							$status_arr   = explode(",", $statuses);

							foreach ($status_arr as $status) {

					?>

					<option value="<?php

								echo __(sanitize_text_field($status), 'wpcargo');

					?>" <?php

								echo ( trim($status) == $shipment['status']  ) ? 'selected' : '' ;

					?>><?php

								echo __(sanitize_text_field($status), 'wpcargo');

					?></option>

					<?php

				}

			}

		?>

	</select>

	</div>

	<div class="one-sixth sh-data data-remark"><textarea name="remarks" ><?php echo $shipment['remarks']; ?></textarea></div>
	
	<?php
		$user_info = array();
		$get_user_updated_by = '';
		if(array_key_exists('updated-by', $shipment)) {
			$get_user_updated_by = $shipment['updated-by'];
			if(!empty($get_user_updated_by)) {
				$user_info = get_userdata($get_user_updated_by);
			}
		}
	?>
	<div class="one-sixth sh-data data-updated"><input readonly="readonly" type="text" name="updated-name" value="<?php echo !empty($get_user_updated_by) ? $user_info->first_name.' '.$user_info->last_name: '';?>"><input type="hidden" name="updated-by" value="<?php echo $get_user_updated_by; ?>"/></div>

	<div class="one-sixth sh-data data-delete-btn"><input data-repeater-delete type="button" class="button" value="<?php _e('Delete', 'wpcargo')?>"/></div>

	<div class="clear-line"></div>

	</div>

	<?php

	}

	}else{

	?>

	<div data-repeater-item class="history-data">

	<div class="one-sixth first sh-data data-date"><input class="datepicker" type="text" name="date"/></div>

	<div class="one-sixth sh-data data-time"><input class="timepicker" type="text" name="time"/></div>

	<div class="one-sixth sh-data data-location"><input type="text" name="location"/></div>

	<div class="one-sixth sh-data data-status">

	<select name="status">
	<option value="" ><?php _e('Select One', 'wpcargo')?></option>
	<?php
	if ( function_exists('wpcargo_custom_fields_callback') ) {
		foreach ($get_custom_fields as $field_data) {

			$field_data            = maybe_unserialize($field_data->field_data);

			$get_custom_field_data = $field_data['options'];

			foreach ($get_custom_field_data as $val) {

			?>

			<option value="<?php

							echo __(sanitize_text_field($val), 'wpcargo');

			?>"><?php

							echo __(sanitize_text_field($val), 'wpcargo');

			?></option>

			<?php

		}
	}

	} else {

		$settings_opt = get_option('wpcargo_option_settings');

		$statuses     = $settings_opt['settings_shipment_status'];

		$status_arr   = explode(",", $statuses);

		

		foreach ($status_arr as $status) {

			?>

			<option value="<?php
						echo __(sanitize_text_field($status), 'wpcargo');
			?>" <?php
						selected(isset($wpcargo_status), sanitize_text_field($status));
			?>><?php
						echo __(sanitize_text_field($status), 'wpcargo');
			?></option>
			<?php
		}
	}
	?>
	</select>
	</div>
	<div class="one-sixth sh-data data-remark"><textarea name="remarks" ></textarea></div>
	<?php
		$current_user = wp_get_current_user();
	?>
	<div class="one-sixth sh-data data-updated"><input readonly="readonly" type="text" name="updated-name" value="<?php echo $current_user->user_firstname.' '.$current_user->user_lastname;?>" /><input type="hidden" name="updated-by" value="<?php echo get_current_user_id(); ?>"/></div>
	<div class="one-sixth sh-data data-delete-btn"><input data-repeater-delete type="button" class="button" value="<?php _e('Delete', 'wpcargo')?>"/></div>
	<div class="clear-line"></div>
	</div>
	<?php
	}
	$get_current_user = wp_get_current_user();
	?>
	</div>		

	<div id="repeater-add" >
		<input data-repeater-create type="button" class="button button-primary add-field-section" value="<?php _e('Add Shipping History', 'wpcargo')?>"/>
	</div>
	<script>				
	jQuery(document).ready(function ($) {
		'use strict';
		$('#shipment-history').repeater({
			defaultValues: {	
				'date': '',	
				'time': '',	
				'location': '',	
				'remarks': '',
				'updated-name': '<?php echo $get_current_user->user_firstname.' '.$get_current_user->user_lastname; ?>',
				'updated-by': '<?php echo get_current_user_id(); ?>'
			},
			show: function () {	
				$(this).slideDown();	
			},
			hide: function (deleteElement) {
				if(confirm('Are you sure you want to delete this element?')) {
					$(this).slideUp(deleteElement);
				}
			}
		});		
			
		$(".datepicker").datepicker({dateFormat: "yy-mm-dd"});
		$(".timepicker").timepicker({timeFormat: "<?php echo get_option( 'time_format' ); ?>"});
		$('.add-field-section').click(function () {
			
			$("#wpcargo_shipment_history .datepicker").datepicker({dateFormat: "yy-mm-dd"});
			$("#wpcargo_shipment_history .timepicker").timepicker({timeFormat: "<?php echo get_option( 'time_format' ); ?>" });
		
		});
	});
	</script>
</div>