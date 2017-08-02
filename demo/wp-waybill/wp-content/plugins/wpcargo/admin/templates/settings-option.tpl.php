<form method="post" action="options.php">
  <?php settings_fields( 'wpcargo_option_settings_group' ); 
   do_settings_sections( 'wpcargo_option_settings_group' ); ?>
  <table class="form-table">
    <tr valign="top">
      <th scope="row"><?php _e( 'Add Demo Notice', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'This page is a DEMO of the Tracking Script Software. The Consignment Numbers loaded are for testing and are NOT real. If you have been redirected here for TRACKING a real cargo or courier package, it is fake.', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_warning_text]"><?php echo esc_attr( $options['settings_warning_text'] ); ?></textarea></td>
    </tr>
    <tr valign="top">
      <th scope="row"><?php _e( 'Display Demo Notice?', $this->text_domain ) ; ?></th>
      <td><input type="checkbox" name="wpcargo_option_settings[settings_warning_text_checkbox]" value="1" <?php echo ( !empty( $options['settings_warning_text_checkbox'] ) ) ? 'checked' : '' ; ?> >
        <p style="font-size: 10px;">(
          <?php _e( 'Check and Leave the Demo Notice blank if you want to display the Standard Demo Notice.', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Add Type of Shipment', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'Ex. Shipment 1, Shipment 2, Shipment 3', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_shipment_type]"><?php echo esc_attr( $options['settings_shipment_type'] ); ?></textarea>
        <p style="font-size: 10px;">(
          <?php _e( 'Must be comma separated', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Add Shipment Mode', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'Ex. Shipment Mode 1, Shipment Mode 2, Shipment Mode 3', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_shipment_wpcargo_mode]"><?php echo esc_attr( $options['settings_shipment_wpcargo_mode'] ); ?></textarea>
        <p style="font-size: 10px;">(
          <?php _e( 'Must be comma separated', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Add Shipment Status', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'Ex. Shipment Status 1, Shipment Status 2, Shipment Status 3', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_shipment_status]"><?php echo esc_attr( $options['settings_shipment_status'] ); ?></textarea>
        <p style="font-size: 10px;">(
          <?php _e( 'Must be comma separated', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Add Shipment Country', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'Ex. Afghanistan, Albania, Algeria', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_shipment_country]"><?php echo esc_attr( $options['settings_shipment_country'] ); ?></textarea>
        <p style="font-size: 10px;">(
          <?php _e( 'Must be comma separated', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Add Shipment Carrier', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'Ex. Shipment Carrier 1, Shipment Carrier 2, Shipment Carrier 3', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_shipment_wpcargo_carrier]"><?php echo esc_attr( $options['settings_shipment_wpcargo_carrier'] ); ?></textarea>
        <p style="font-size: 10px;">(
          <?php _e( 'Must be comma separated', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Add Shipment Payment Mode', $this->text_domain ) ; ?></th>
      <td><textarea placeholder="<?php _e( 'Ex. Payment Mode 1, Payment Mode 2, Payment Mode 3', $this->text_domain ) ; ?>" cols="40" rows="5" name="wpcargo_option_settings[settings_shipment_wpcargo_payment_mode]"><?php echo esc_attr( $options['settings_shipment_wpcargo_payment_mode'] ); ?></textarea>
        <p style="font-size: 10px;">(
          <?php _e( 'Must be comma separated', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><?php _e( 'Add Shipment Logo', $this->text_domain ) ; ?></th>
      <td><input type="text" name='wpcargo_option_settings[settings_shipment_ship_logo]' id="image-chooser" value="<?php echo $options['settings_shipment_ship_logo'];?>">
        <a id="choose-image" class="button" >Upload Logo</a> 
        <script>

                jQuery(document).ready(function($){

                    // Uploading files

                    var file_frame;

                      $('#choose-image').live('click', function( event ){

                        event.preventDefault();

                        // If the media frame already exists, reopen it.

                        if ( file_frame ) {

                          file_frame.open();

                          return;

                        }

                        // Create the media frame.

                        file_frame = wp.media.frames.file_frame = wp.media({

                          title: $( this ).data( 'uploader_title' ),

                          button: {

                            text: $( this ).data( 'uploader_button_text' ),

                          },

                          multiple: false  // Set to true to allow multiple files to be selected

                        });

                        // When an image is selected, run a callback.

                        file_frame.on( 'select', function() {

                          // We set multiple to false so only get one image from the uploader

                          attachment = file_frame.state().get('selection').first().toJSON();

                          // Do something with attachment.id and/or attachment.url here

                          $('#image-chooser').val( attachment.url );

                        });

                        // Finally, open the modal

                        file_frame.open();

                      });

                });

                </script></td>
    </tr>
    <tr valign="top">
      <th scope="row"><?php _e( 'Display Barcode?', $this->text_domain ) ; ?></th>
      <td><input type="checkbox" name="wpcargo_option_settings[settings_barcode_checkbox]" value="1" <?php echo ( !empty( $options['settings_barcode_checkbox'] ) ) ? 'checked' : '' ; ?> >
        <p style="font-size: 10px;">(
          <?php _e( 'Check if you want to display barcode at the results.', $this->text_domain ) ; ?>
          )</p></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'WPCargo Page Settings', $this->text_domain ) ; ?></th>
      <td><select name='wpcargo_page_settings[wpcargo_page_settings_track_form]'>
          <?php $pages = get_pages(); ?>
          <option value="">--Select Page--</option>
          <?php foreach ($pages as $page) { ?>
          <option value="<?php  echo $page->ID; ?>" <?php selected( $page_options['wpcargo_page_settings_track_form'], $page->ID ); ?>> <?php echo $page->post_title; ?> </option>
          <?php } ?>
        </select>
        <p style="font-size:12px;">
          <?php _e('Select a page to insert', 'wpcargo'); ?>
          "[wpcargo_trackform]"</p>
        <?php

                    if (!empty($page_options['wpcargo_page_settings_track_form'])) {

						?>
        <a target="_blank" href="post.php?post=<?php echo $page_options['wpcargo_page_settings_track_form']; ?>&amp;action=edit" class="button button-secondary pmpro_page_edit">
        <?php _e('Edit Page', 'wpcargo'); ?>
        </a> <a target="_blank" href="<?php echo get_page_link($page_options['wpcargo_page_settings_track_form']); ?>" class="button button-secondary pmpro_page_view">
        <?php _e('View Page', 'wpcargo'); ?>
        </a>
        <?php

                    }

                    if (!empty($page_options['wpcargo_page_settings_track_form'])) {

                        $wpbd_insert_shortcode = array(

                            'ID' => $page_options['wpcargo_page_settings_track_form'],

                            'post_content' => '[wpcargo_trackform]'

                        );

                        wp_update_post($wpbd_insert_shortcode);

                    }

                ?></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'Enable WPCargo Title Prefix?', $this->text_domain ) ; ?></th>
      <td><input type="checkbox" name="wpcargo_option_settings[wpcargo_title_prefix_action]" <?php  echo ( !empty( $options['wpcargo_title_prefix_action'] ) && $options['wpcargo_title_prefix_action'] != NULL  ) ? 'checked' : '' ; ?> /></td>
    </tr>
    <tr>
      <th scope="row"><?php _e( 'WPCargo Title Prefix', $this->text_domain ) ; ?></th>
      <td><p>
          <input type="text" name="wpcargo_option_settings[wpcargo_title_prefix]" value="<?php echo $options['wpcargo_title_prefix']; ?>" placeholder="wpcargo"/>
        </p></td>
    </tr>
  </table>
  <?php submit_button(); ?>
</form>