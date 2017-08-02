<?php
/**
 * Locate template.
 *
 
 *
 * @since 1.0.0
 *
 * @param     string     $template_name            Template to load.
 * @param     string     $string $template_path    Path to templates.
 * @param     string    $default_path            Default path to template files.
 * @return     string                             Path to the template file.
 */


$date = date("Y-m-d");
$plugin_dir_path = dirname(__FILE__);

$my_plugin_dir = explode("report-mail",$plugin_dir_path);
$my_plugin_dir_full = $my_plugin_dir[0]."/report-mail";

//csv file name

$export_file = $my_plugin_dir_full."/export/report.csv";

$export = fopen($export_file, 'w') or die("Permissions error."); // open the file for writing.  if you see the error then check the folder permissions.

 $output = "";

 $output = "Order Id, Name, Email, Phone Number, Address 1, Address 2, City, State, Post Code, Country, Delivary Date\r\n"; // column names. end with a newline.
 fwrite($export, $output); // write the file header with the column names

$args = array(
    'post_type' => 'shop_order',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
                        array(
                            'taxonomy' => 'shop_order_status',
                            'field' => 'slug',
                            'terms' => array('pending')
                        )
                    )
    
    
);

$loop = new WP_Query($args);?>
<form method="post" action="options.php">
					<?php settings_fields( 'sb_options_group' ); ?>
					<table class="sb_table">
						<tr>
							<th>
								<label for="sb_section_title">Title</label>
							</th>
							<td>
								<input type="text" class="widefat1" id="sb_section_title" name="sb_section_title" value="<?php echo get_option('sb_section_title'); ?>" />
							</td>
						</tr>
						
						
						<tr>
							<th>
								<label for="sb_section_title">Email To</label>
							</th>
							<td>
								<input type="text" class="widefat1" id="sb_section_email_to" name="sb_section_email_to" value="<?php echo get_option('sb_section_email_to'); ?>" />
							</td>
						</tr>
						
						
						<tr>
							<th>
								<label for="sb_section_title">Email CC</label>
							</th>
							<td>
								<input type="text" class="widefat1" id="sb_section_email_cc" name="sb_section_email_cc" value="<?php echo get_option('sb_section_email_cc'); ?>" />
							</td>
						</tr>
						
						<tr>
							<th>
								<label for="sb_section_title">Email BCC</label>
							</th>
							<td>
								<input type="text" class="widefat1" id="sb_section_email_bcc" name="sb_section_email_bcc" value="<?php echo get_option('sb_section_email_bcc'); ?>" />
							</td>
						</tr>
						
						<tr>
							<th>
								<label for="sb_section_title">Sending Time</label>
							</th>
							<td>
								<input type="text" class="widefat1" id="sb_section_email_sending_time" name="sb_section_email_sending_time" value="<?php echo get_option('sb_section_email_sending_time'); ?>" />
							</td>
						</tr>
						
						
						<tr>
							<th>
								<label for="sb_show_thumbnail">Generate Log?</label>
							</th>
							<td>
								<input type="radio" name="sb_show_thumbnail" value="Yes" <?php if(get_option('sb_show_thumbnail') == 'Yes') { ?> checked='checked' <?php } ?> > Yes<br>
  								<input type="radio" name="sb_show_thumbnail" value="No" <?php if(get_option('sb_show_thumbnail') == 'No') { ?> checked='checked' <?php } ?> > No
								<?php $val2 = get_option('sb_show_thumbnail'); ?>
							</td>
						</tr>
						
					</table>
					<div class="submit-btn">					
						<?php submit_button(); ?>
					</div>
				</form>
<table class="table">
    <thead>
      <tr>
        <th>Order Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Address 1</th>
        <th>Address 2</th>
        <th>City</th>
        <th>State</th>
        <th>Post Code</th>
        <th>Country</th>
        <th>Delivary Date</th>
      </tr>
    </thead>
    <tbody>
<?php
	while ($loop->have_posts()):
    $loop->the_post();
    $order_id = $loop->post->ID;
    //$order = new WC_Order($order_id);
    $order    = wc_get_order($order_id);
    //get the order date and time
    $order_date_time = $order->post->post_date;
    //explode the order date to remove the time
    $order_date_now = explode(" ", $order_date_time);
    //get only the date of the order
    $order_date     = $order_date_now[0];
    
    //output will only generate if the order date is current date
    
    if($date == $order_date)
    {
	 // OUTPUT
   
    $delivary_option = get_post_meta($order->id,"additional_field_718",true);
    // getting the number of week
    $wk_no = intval(preg_replace('/[^0-9]+/', '', $delivary_option), 10);
    //getting the number of day's
    $day_number = $wk_no*7;
    //getting the next delivary date
    $next_delivary_date =  date('Y-m-d', strtotime("+$day_number days"));
    //getting the day of the date
    $next_delivary_day =  date('l', strtotime("+$day_number days"));
    $items = $order->get_items();
    
    // 2) Get the Order meta data
    $order_meta = get_post_meta($order_id);
    //getting the order details as per as requirement
    /*
     * *Start
	*/
	
	// add your extra code if needed
	
	//getting the name of person
	
	 $order_user_id = $order->post->post_author;
	 
	 //getting the order id
	 $order_id = $order->id;
	 //getting the first name
	 $name = $order_meta['_billing_field_685'][0]; 
	 // getting the email 
	 $email = $order_meta['_billing_email'][0];
	 //getting the phone number
	 $phone_number = $order_meta['_billing_phone'][0];
	  // getting the of address line 1
	 $address_line_no1 =  $order_meta['_billing_address_1'][0];
	  // getting the address line 2
	  $address_line_no2 =  $order_meta['_billing_address_2'][0];
	  // getting the city
	 $city = $order_meta['_billing_city'][0];
	  // getting the state
	  $state = $order_meta['_billing_state'][0];
	  // getting the postcode
	  $postcode = $order_meta['_billing_postcode'][0];
	  // getting the country
	  $country = $order_meta['_billing_country'][0];
	  
	  
	  $output = ""; // re-initialize $output on each iteration
    
     $output .= '"'.$order_id.'",'; 
     $output .= '"'.$name.'",'; 
     $output .= '"'.$email.'",'; 
     $output .= '"'.$phone_number.'",'; 
     $output .= '"'.$address_line_no1.'",'; 
     $output .= '"'.$address_line_no2.'",'; 
     $output .= '"'.$city.'",'; 
     $output .= '"'.$state.'",'; 
     $output .= '"'.$postcode.'",'; 
     $output .= '"'.$country.'",'; 
     $output .= '"'.$next_delivary_date.'",'; 
     
      // add any other fields you want here 
     $output .= "\r\n"; // add end of line
		
	//die;
	fwrite($export, $output); // write to the file handle "$export" with the string "$output".
	 
	/*
     * *End
	*/
	?>
	
      <tr>
        <td><?php echo $order_id;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $email;?></td>
        <td><?php echo $phone_number;?></td>
        <td><?php echo $address_line_no1;?></td>
        <td><?php echo $address_line_no2?></td>
        <td><?php echo $city;?></td>
        <td><?php echo $state;?></td>
        <td><?php echo $postcode;?></td>
        <td><?php echo $country;?></td>
        <td><?php echo $next_delivary_date;?></td>
      </tr>
     
    
	<?php
		foreach ($items as $item) 
		{
			
		   
		   // print_r($item);
			
		}
    echo '- - - - - - E N D - - - - - <br><br>';
    
    }
endwhile;fclose($export); // close the file handle.?>
</tbody>
  </table>


