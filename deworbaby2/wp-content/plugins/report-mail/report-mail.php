<?php

/*

Plugin Name: Report Mail

Plugin URI: http://uniterrene.com/

Description: A Report plugin used to use for providing daily mail of subscribtion product delivary report.

Version: 1.0

Author: Uniterrene Wobsoft Ptv Ltd

Author URI: http://uniterrene.com

License: GPL

*/



//debug code





require_once('includes/admin_settings.php');

//Hooks a function to a filter action, 'the_content' being the action, 'hello_world' the function.

//add_filter('the_content','hello_world');



add_action( 'admin_init','rpt_register_settings');





function rpt_register_settings() {

        	//textfield option registered

			add_option( 'sb_section_title', 'Email Title'); 

		   	register_setting( 'sb_options_group', 'sb_section_title', 'sb_section_title_callback' );

		   	

		   	//Email "To" option registered

		   	

		   	add_option( 'sb_section_title', 'Email To'); 

		   	register_setting( 'sb_options_group', 'sb_section_email_to', 'sb_section_title_callback' );

		   	

		   	//Email "CC" option registered

		   	

		   	add_option( 'sb_section_title', 'Email CC'); 

		   	register_setting( 'sb_options_group', 'sb_section_email_cc', 'sb_section_title_callback' );

		   	

		   	//Email "BCC" option registered

		   	

		   	add_option( 'sb_section_title', 'Email BCC'); 

		   	register_setting( 'sb_options_group', 'sb_section_email_bcc', 'sb_section_title_callback' );

		   	

		   	//Email "Sending Time" option registered

		   	

		   	add_option( 'sb_section_title', 'Sending Time'); 

		   	register_setting( 'sb_options_group', 'sb_section_email_sending_time', 'sb_section_title_callback' );

			

			//radio option registered

			add_option( 'sb_show_thumbnail', 'Log Generation'); 

		   	register_setting( 'sb_options_group', 'sb_show_log', 'sb_show_thumbnail_callback' );

		}

/*corn function */

    add_filter( 'cron_schedules', 'myprefix_add_a_cron_schedule' );



 function myprefix_add_a_cron_schedule( $schedules ) {

  $schedules['sixsec'] = array(

   'interval' => false, // Every 6 hours

   'display'  => __( 'Every 6 hours' ),

  );

  //mail('shourya@uniterrene.com','test','hello');

  return $schedules;

 }

 

 function myprefix_add_a_cron_scheduleds( $schedules ) {

  $schedules['sixsec'] = array(

   'interval' => false, // Every 6 hours

   'display'  => __( 'Every 6 hours' ),

  );

  //mail('akash@uniterrene.com','test','hello');

  return $schedules;

 }

 



///////Schedule an action if it's not already scheduled



 if( ! wp_next_scheduled( 'myprefix_curl_cron_action' ) ) {

  wp_schedule_event( time(), 'sixsec', 'myprefix_curl_cron_action' );

 }



 ///Hook into that action that'll fire sixhour

 add_action( 'myprefix_curl_cron_action', 'import_into_db' );

 /*corn function */

 

 //to send mail via wp_mail via cron job

 function send_csv_action () {

	 save_csv();

	 

$email_title =  get_option("sb_section_title");

$email_to = get_option("sb_section_email_to");

$email_cc = get_option("sb_section_email_cc");

$email_bcc = get_option("sb_section_email_bcc");

$send_time = get_option("sb_section_email_sending_time");

$headers = array('Content-Type: text/html; charset=UTF-8');

$headers = 'From: Daily Product Delivery Report Mail <admin@deworbaby.com>' . "\r\n";

$attachments = "/home/unitetoh/public_html/onlinedevserver.biz/dev/deworbaby/wp-content/plugins/report-mail/export/report.csv";

    // code to execute on cron run

    wp_mail( $email_to, $email_title, 'message',$headers,$attachments );

} add_action('send_csv_action', 'send_csv_action');





//saving the csv file in export folder

function save_csv()

{

	//fopen("/home/unitetoh/public_html/onlinedevserver.biz/dev/deworbaby-live/wp-content/plugins/report-mail/export/report.csv", "w");

	$export_file = "/home/unitetoh/public_html/onlinedevserver.biz/dev/deworbaby/wp-content/plugins/report-mail/export/report.csv";

	$export = fopen($export_file, 'w') or die("Permissions error.");

	$output = "";



 $output = "Order Id,Name,Email,Phone Number,Address 1,Address 2,City,State,Post Code,Country,Delivary Date\r\n"; // column names. end with a newline.

 fwrite($export, $output);

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

$loop = new WP_Query($args);

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

    

    //~ if($date == $order_date)

    //~ {

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

	

		foreach ($items as $item) 

		{

			

		   

		   // print_r($item);

			

		}

   

    

   // }

endwhile;fclose($export); // close the file handle.

}

add_action('save_csv', 'save_csv');



?>

