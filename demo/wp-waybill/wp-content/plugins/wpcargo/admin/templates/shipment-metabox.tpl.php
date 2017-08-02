<?php 



$options 							= get_option('wpcargo_option_settings'); 
$wpc_date_format 					= get_option( 'date_format' );	


?>



<div id="shipment-details">



  <h1><?php echo apply_filters('wpc_shipment_details_label',__('Shipment Details', 'wpcargo' ) ); ?></h1>



  <?php do_action('wpc_before_shipment_details_table'); ?>



  <table class="wpcargo form-table">



    <?php do_action('wpc_before_shipment_details_metabox'); ?>



    <tr>



      <th><label>



          <?php _e('Agent Name :','wpcargo' ); ?>



        </label></th>



      <td><select name="agent_fields">



          <?php



                $wpc_agent_args  = array( 'role' => 'cargo_agent', 'orderby' => 'user_nicename', 'order' => 'ASC' );



                $wpc_agents = get_users($wpc_agent_args);



				if( !empty( $wpc_agents ) ) {



					?>



          <option value="">-- Select One --</option>



          <?php



					foreach ($wpc_agents as $val) {



						?>



          <option value="<?php _e(sanitize_text_field($val->display_name)); ?>" <?php echo ( $val->display_name == get_post_meta($post->ID, 'agent_fields', true)) ? 'selected' : '' ; ?> >



          <?php _e(sanitize_text_field($val->display_name)); ?>



          </option>



          <?php



					}



				}



				?>



        </select>



        <?php echo ( empty( $wpc_agents ) ) ? '<span class="meta-box error">'.__('No agents found, Please add Agents <a href="'.admin_url().'/user-new.php">Here</a> make sure the role assign is "WPCargo Agent".', $this->text_domain ).'</span>' : '' ; ?></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Type of Shipment', 'wpcargo' ); ?>



        </label></th>



      <td><select name="wpcargo_type_of_shipment">



          <?php



                    $shipment_type = $options['settings_shipment_type'];



                    $shipment_type_list = explode(",", $shipment_type);



					$shipment_type_list = array_filter( $shipment_type_list );



					if( !empty( $shipment_type_list ) ){



						?>



          <option value="">-- Select One --</option>



          <?php



						foreach ( $shipment_type_list as $val) {



							?>



          <option value="<?php echo trim($val); ?>" <?php echo ( trim($val) == get_post_meta($post->ID, 'wpcargo_type_of_shipment', true)) ? 'selected' : '' ; ?>><?php echo trim($val); ?></option>



          <?php



						}



					}



                ?>



        </select>



        <?php echo ( empty( $shipment_type ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?>



      </td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Weight','wpcargo'); ?>



        </label></th>



      <td><input type="text" id="wpcargo_weight" name="wpcargo_weight" value="<?php echo get_post_meta($post->ID, 'wpcargo_weight', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Courier','wpcargo'); ?>



        </label></th>



      <td><input type="text" id="wpcargo_courier" name="wpcargo_courier" value="<?php echo get_post_meta($post->ID, 'wpcargo_courier', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Packages','wpcargo'); ?>



        </label></th>



      <td><input type="text" id="pack" name="wpcargo_packages" value="<?php echo get_post_meta($post->ID, 'wpcargo_packages', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Mode','wpcargo'); ?>



        </label></th>



      <td><select name="wpcargo_mode_field">



          <?php



                $shipment_mode = $options['settings_shipment_wpcargo_mode'];



                $shipment_mode_list = explode(",", $shipment_mode);



				$shipment_mode_list = array_filter( $shipment_mode_list );



				if( !empty($shipment_mode_list) ){



					?>



          <option value="">-- Select One --</option>



          <?php



					foreach ( $shipment_mode_list as $val) {



						?>



          <option value="<?php echo trim($val); ?>" <?php echo ( trim($val) == get_post_meta($post->ID, 'wpcargo_mode_field', true)) ? 'selected' : '' ; ?>><?php echo trim($val); ?></option>



          <?php



					}



				}



                ?>



        </select>



        <?php echo ( empty( $shipment_mode ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Product','wpcargo'); ?>



        </label></th>



      <td><input type="text" id="prod" name="wpcargo_product" value="<?php echo get_post_meta($post->ID, 'wpcargo_product', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Quantity', 'wpcargo'); ?>



        </label></th>



      <td><input type="text" id="wpcargo_qty" name="wpcargo_qty" value="<?php echo get_post_meta($post->ID, 'wpcargo_qty', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Payment Mode','wpcargo' ); ?>



        </label></th>



      <td><select name="payment_wpcargo_mode_field">



          <?php



                    $payment_mode = $options['settings_shipment_wpcargo_payment_mode'];



                    $payment_mode_list = explode(",", $payment_mode);



					$payment_mode_list = array_filter( $payment_mode_list );



					if( !empty($payment_mode_list) ) {



						?>



          <option value="">-- Select One --</option>



          <?php



						foreach ( $payment_mode_list as $val) {



							?>



          <option value="<?php echo trim($val); ?>" <?php echo ( trim($val) == get_post_meta($post->ID, 'payment_wpcargo_mode_field', true)) ? 'selected' : '' ; ?>> <?php echo trim($val); ?> </option>



          <?php



						}



					}



                ?>



        </select>



        <?php echo ( empty( $payment_mode ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?></td>



    <tr>



      <th><label>



          <?php _e('Total Freight','wpcargo'); ?>



        </label></th>



      <td><input type="text" id="wpcargo_total_freight" name="wpcargo_total_freight" value="<?php echo get_post_meta($post->ID, 'wpcargo_total_freight', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Carrier','wpcargo'); ?>



        </label></th>



      <td><select name="wpcargo_carrier_field">



          <?php



                    $shipment_carrier = $options['settings_shipment_wpcargo_carrier'];



                    $shipment_carrier_list = explode(",", $shipment_carrier);



					$shipment_carrier_list = array_filter( $shipment_carrier_list );



					if( !empty( $shipment_carrier_list ) ){



						?>



          <option value="">-- Select One --</option>



          <?php



						foreach ( $shipment_carrier_list as $val ) {



						?>



          <option value="<?php echo trim($val); ?>" <?php echo ( trim($val) == get_post_meta($post->ID, 'wpcargo_carrier_field', true)) ? 'selected' : '' ; ?> ><?php echo trim($val); ?></option>



          <?php



						}



					}



                ?>



        </select>



        <?php echo ( empty( $shipment_carrier ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Carrier Reference No.','wpcargo'); ?>



        </label></th>



      <td><input type="text" id="wpcargo_carrier_ref_number" name="wpcargo_carrier_ref_number" value="<?php echo get_post_meta($post->ID, 'wpcargo_carrier_ref_number', true); ?>"size="25" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Departure Time','wpcargo' ); ?>



        </label></th>



      <td><label for="UpdateDate"></label>



        <input type='text' class="time_1" id='datetimepicker5' name="wpcargo_departure_time_picker" autocomplete="off" value="<?php echo get_post_meta($post->ID, 'wpcargo_departure_time_picker', true); ?>"/></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Origin','wpcargo'); ?>



        </label></th>



      <td><select name="wpcargo_origin_field">



          <?php



                    $shipment_country_org = $options['settings_shipment_country'];



                    $shipment_country_org_list = explode(",", $shipment_country_org);



					$shipment_country_org_list = array_filter( $shipment_country_org_list );



					if( !empty($shipment_country_org_list) ){



						?>



          <option value="">-- Select One --</option>



          <?php



						foreach ( $shipment_country_org_list as $val) {



							?>



          <option value="<?php echo trim($val); ?>" <?php echo ( trim($val) == get_post_meta($post->ID, 'wpcargo_origin_field', true)) ? 'selected' : '' ; ?> ><?php echo trim($val);



							?></option>



          <?php



						}



					}



                ?>



        </select>



        <?php echo ( empty( $shipment_country_org ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Destination','wpcargo'); ?>



        </label></th>



      <td><select id="dest_1" name="wpcargo_destination">



          <?php



                    $shipment_country_des = $options['settings_shipment_country'];



                    $shipment_country_des_list = explode(",", $shipment_country_des);



					$shipment_country_des_list = array_filter( $shipment_country_des_list );



					if( !empty( $shipment_country_des_list ) ){



						?>



          <option value="">-- Select One --</option>



          <?php



						foreach ( $shipment_country_des_list as $val) {



						?>



          <option value="<?php echo trim($val); ?>" <?php echo ( trim($val) == get_post_meta($post->ID, 'wpcargo_destination', true)) ? 'selected' : '' ; ?> ><?php echo trim($val); ?></option>



          <?php



						}



					}



                ?>



        </select>



        <?php echo ( empty( $shipment_country_des ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Pickup Date','wpcargo'); ?>



        </label></th>

		
		<?php
		
		$wpcargo_pickup_date_picker = get_post_meta($post->ID, 'wpcargo_pickup_date_picker', true);
		
		?>


      <td><input type='text' class="datepicker" id='datetimepicker4' name="wpcargo_pickup_date_picker" autocomplete="off" value="<?php echo !empty($wpcargo_pickup_date_picker) ? date_i18n("Y-m-d", strtotime($wpcargo_pickup_date_picker)) : ''; ?>"/></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Pickup Time :','wpcargo'); ?>



        </label></th>



      <td><input type='text' class="time_1" id='datetimepicker7' name="wpcargo_pickup_time_picker" autocomplete="off" value="<?php echo get_post_meta($post->ID, 'wpcargo_pickup_time_picker', true); ?>" /></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Status :','wpcargo'); ?>



        </label></th>



      <td><select name="wpcargo_status">



          <?php



                    $shipment_status   = $options['settings_shipment_status'];



                    $shipment_status_list = explode(",", $shipment_status);



					$shipment_status_list = array_filter( $shipment_status_list );



					if( !empty( $shipment_status_list ) ){



						?>



          <option value="">-- Select One --</option>



          <?php



						foreach ( $shipment_status_list as $status) {



						?>



          <option value="<?php echo trim($status); ?>" <?php echo ( trim($status) == get_post_meta($post->ID, 'wpcargo_status', true)) ? 'selected' : '' ; ?> ><?php echo trim($status); ?></option>



          <?php



						}



					}



                ?>



        </select>



        <?php echo ( empty( $shipment_status ) ) ? '<span class="meta-box error">'.__('<strong>No Seletion setup, Please add selection <a href="'.admin_url().'/admin.php?page=wpcargo-settings">Here</a></strong>', $this->text_domain ).'</span>' : '' ; ?></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Expected Delivery Date', 'wpcargo'); ?>



        </label></th>

		<?php
		
		$wpcargo_expected_delivery_date_picker = get_post_meta($post->ID, 'wpcargo_expected_delivery_date_picker', true);
				
		?>

      <td><input type='text' class="datepicker" id='datetimepicker3' name="wpcargo_expected_delivery_date_picker" autocomplete="off" value="<?php echo !empty($wpcargo_expected_delivery_date_picker) ? date_i18n("Y-m-d", strtotime($wpcargo_expected_delivery_date_picker)) : ''; ?>"/></td>



    </tr>



    <tr>



      <th><label>



          <?php _e('Comments','wpcargo'); ?>



        </label></th>



      <td><textarea rows="4" cols="50" id="wpcargo_comments" name="wpcargo_comments"><?php echo get_post_meta($post->ID, 'wpcargo_comments', true); ?></textarea></td>



    </tr>



    <?php do_action('wpc_after_shipment_details_metabox'); ?>



  </table>



  <?php do_action('wpc_after_shipment_details_table'); ?>



</div>



