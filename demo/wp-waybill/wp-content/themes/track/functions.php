<?php

/*--Recommended way to include parent theme styles.

(Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)

--*/  

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    //wp_enqueue_script( 'pati', get_stylesheet_directory_uri() . '/pati.js', array('jquery'), true);
}



/*--Your code goes below--*/

function sb_custom_mail_action () {
    //code to execute on cron run
    $to = 'subrat@uniterrene.com';
	$subject = 'Testing Cron Job Mails';
	$body = 'Aloo Potol er Torkari!!!';
	$headers = array('Content-Type: text/html; charset=UTF-8','From: Subrat Kumar Barik <kelma@baba.com>');
 
 	wp_mail( $to, $subject, $body, $headers );
} 
//add_action('init', 'sb_custom_mail_action'); 

//gravity form
add_filter("gform_pre_render", "populate_welcome");
function populate_welcome($form)
{
    //only get data form form id 31
    if ($form["id"] == 1)
    {
        //check what page you are on
        $current_page = GFFormDisplay::get_current_page($form["id"]);
        if ($current_page == 2){
            //set the field on page 2 to the first/last name from page 1
            //get the name
            $first = rgpost("input_1");
            $email = rgpost("input_2");
            $phone = rgpost("input_11");
            $bed = rgpost("input_6");
            $bath = rgpost("input_7");
            $prop = rgpost("input_8");
            $loc = rgpost("input_9");
            $date = rgpost("input_10");

            if( $bed == "1" && $bath == "1" ){
                $cal = "$250";
            }elseif ( $bed == "2" && $bath == "1" ) {
                $cal = "$290";
            }elseif ( $bed == "2" && $bath == "2" ) {
                $cal = "$350";
            }elseif ( $bed == "3" && $bath == "1" ) {
                $cal = "$350";
            }elseif ( $bed == "3" && $bath == "2" ) {
                $cal = "$400";
            }elseif ( $bed == "3" && $bath == "3" ) {
                $cal = "$450";
            }elseif ( $bed == "4" && $bath == "1" ) {
                $cal = "$400";
            }elseif ( $bed == "4" && $bath == "2" ) {
                $cal = "$450";
            }elseif ( $bed == "4" && $bath == "3" ) {
                $cal = "$500";
            }elseif ( $bed == "5" && $bath == "1" ) {
                $cal = "$450";
            }elseif ( $bed == "5" && $bath == "2" ) {
                $cal = "$500";
            }elseif ( $bed == "5" && $bath == "3" ) {
                $cal = "$550";
            }else{
                $cal = " ";
            }
            //$last = rgpost("input_1_6"); //last name field when using the normal name format broken into two fields
            foreach($form["fields"] as &$field){
                //html field (id 3) on second page which will display name from first page
                if ($field["id"] == 13){
                    //$field["content"] = "Welcome, " . $first . " " . $last;

                    $field["content"] = "Hi ".$first."<br>Thank you for submitting your details with Simply Bond Cleaning. Based on the information you have provided us:<br>Bedrooms: ".$bed."<br>Bathrooms: ".$bath."<br>Property Type: ".$prop."<br>Location: ".$loc."<br>Your Complete Bond Clean will cost ".$cal."<br>No hidden fees or charges just excellent quality service!";
                }
            }
        }

        if ($current_page == 3){

            $first = rgpost("input_1");
            $email = rgpost("input_2");
            $phone = rgpost("input_11");
            $bed = rgpost("input_6");
            $bath = rgpost("input_7");
            $prop = rgpost("input_8");
            $loc = rgpost("input_9");
            $date = rgpost("input_10");

            foreach($form["fields"] as &$field){
                //html field (id 3) on second page which will display name from first page
                if ($field["id"] == 15){
                    //$field["content"] = "Welcome, " . $first . " " . $last;

                    $field["content"] = "CONFIRM YOUR DETAILS<br>Name: ".$first."<br>Phone: ".$phone."<br>Email: ".$email."<br>Suburb: ".$loc."<br>";
                }
            }
        }

        if ($current_page == 4){

            foreach($form["fields"] as &$field){
                //html field (id 3) on second page which will display name from first page
                if ($field["id"] == 21){
                    //$field["content"] = "Welcome, " . $first . " " . $last;

                    $field["content"] = "THANK YOU<br>We have successfully received your instructions for your Bond Clean. Your nearest Simply Bond Cleaning team member will contact you to confirm you booking date and time.<br>We require an initial $50 deposit to book our services. You can pay your deposit online now via the Pay Now button or over the phone with your credit card.<br>If you are meeting us onsite, the balance of your payment can be made on the day of your Bond Clean with cash, EFTPOS or credit card.";
                    //$field["content"].=do_shortcode('[wp_cart_button name="Booking Services" price="50"]');
                }
            }

        }

    }
    //return altered form so changes are displayed
    return $form;
}


add_filter( 'gform_confirmation_4', 'custom_confirmation_message', 10, 4 );
function custom_confirmation_message( $confirmation, $form, $entry, $ajax ) {

	$first = rgpost("input_10");
    $email = rgpost("input_2");
    $phone = rgpost("input_4");
    $bed = rgpost("input_5");
    $bath = rgpost("input_6");
    $prop = rgpost("input_7");
    $loc = rgpost("input_8");
    $date = rgpost("input_9");

    if( $bed == "1" && $bath == "1" ){
        $cal = "$250";
    }elseif ( $bed == "2" && $bath == "1" ) {
        $cal = "$290";
    }elseif ( $bed == "2" && $bath == "2" ) {
        $cal = "$350";
    }elseif ( $bed == "3" && $bath == "1" ) {
        $cal = "$350";
    }elseif ( $bed == "3" && $bath == "2" ) {
        $cal = "$400";
    }elseif ( $bed == "3" && $bath == "3" ) {
        $cal = "$450";
    }elseif ( $bed == "4" && $bath == "1" ) {
        $cal = "$400";
    }elseif ( $bed == "4" && $bath == "2" ) {
        $cal = "$450";
    }elseif ( $bed == "4" && $bath == "3" ) {
        $cal = "$500";
    }elseif ( $bed == "5" && $bath == "1" ) {
        $cal = "$450";
    }elseif ( $bed == "5" && $bath == "2" ) {
        $cal = "$500";
    }elseif ( $bed == "5" && $bath == "3" ) {
        $cal = "$550";
    }else{
        $cal = " ";
    }

    $confirmation = "YOUR QUOTE<br><br>Hi ".$first."<br>Thank you for submitting your details with Simply Bond Cleaning. Based on the information you have provided us:<br>Bedrooms: ".$bed."<br>Bathrooms: ".$bath."<br>Property Type: ".$prop."<br>Location: ".$loc."<br>Your Complete Bond Clean will cost ".$cal."<br>No hidden fees or charges just excellent quality service!"."<script>window.top.jQuery( document ).ready(function() { window.top.jQuery(document).bind('gform_confirmation_loaded', function () {window.open('http://onlinedevserver.biz/dev/demo/wp-waybill/gravity-1/{$entry['10']}');});
});
</script>";
                
    return $confirmation;

}

add_filter( 'gform_confirmation_5', 'custom_confirmation_messages', 10, 4 );
function custom_confirmation_messages( $confirmation, $form, $entry, $ajax ) {

    $first = rgpost("input_10");
    $email = rgpost("input_2");
    $phone = rgpost("input_4");
    $bed = rgpost("input_5");
    $bath = rgpost("input_6");
    $prop = rgpost("input_7");
    $loc = rgpost("input_8");
    $date = rgpost("input_9");

    if( $bed == "1" && $bath == "1" ){
        $cal = "$250";
    }elseif ( $bed == "2" && $bath == "1" ) {
        $cal = "$290";
    }elseif ( $bed == "2" && $bath == "2" ) {
        $cal = "$350";
    }elseif ( $bed == "3" && $bath == "1" ) {
        $cal = "$350";
    }elseif ( $bed == "3" && $bath == "2" ) {
        $cal = "$400";
    }elseif ( $bed == "3" && $bath == "3" ) {
        $cal = "$450";
    }elseif ( $bed == "4" && $bath == "1" ) {
        $cal = "$400";
    }elseif ( $bed == "4" && $bath == "2" ) {
        $cal = "$450";
    }elseif ( $bed == "4" && $bath == "3" ) {
        $cal = "$500";
    }elseif ( $bed == "5" && $bath == "1" ) {
        $cal = "$450";
    }elseif ( $bed == "5" && $bath == "2" ) {
        $cal = "$500";
    }elseif ( $bed == "5" && $bath == "3" ) {
        $cal = "$550";
    }else{
        $cal = " ";
    }

    $confirmation = "YOUR QUOTE<br><br>Hi ".$first."<br>Thank you for submitting your details with Simply Bond Cleaning. Based on the information you have provided us:<br>Bedrooms: ".$bed."<br>Bathrooms: ".$bath."<br>Property Type: ".$prop."<br>Location: ".$loc."<br>Your Complete Bond Clean will cost ".$cal."<br>No hidden fees or charges just excellent quality service!"."<script>window.top.jQuery( document ).ready(function() { window.top.jQuery(document).bind('gform_confirmation_loaded', function () {window.open('http://onlinedevserver.biz/dev/demo/wp-waybill/gravity-1/{$entry['10']}');});
});
</script>";
                
    return $confirmation;

}

add_action( 'wp_head', 'gf_datepicker_fix', 1000000 );
function gf_datepicker_fix(){
?><style>
body div#ui-datepicker-div[style] {
z-index: 2000000000 !important;
position: absolute !important;
padding-right: 0 !important;
}
</style> <?php
}



add_action( 'ninja_forms_after_submission', 'my_ninja_forms_after_submission' );
function my_ninja_forms_after_submission($form_data ){

foreach( $form_data[ 'fields' ] as $field ) { // Field settigns, including the field key and value.
   
   if( 'event_details_1500882408919' == $field[ 'key' ] ) 
   {

   		$event_val = "";
   		foreach($field['value'] as $evt_val)
   		{
   			$event_val.= $evt_val.",";
   		}	
   		
   }

	   // get the first name 

	   if('firstname' == $field[ 'key' ])
	   {
	   		$firstname = $field['value'];
	   }

	   //get the last name

	   if('lastname' == $field['key'])
	   {
	   	$lname = $field['value'];
	   }

	    //get the email

	   if('email' == $field['key'])
	   {
	   	$email = $field['value'];
	   }

	   //get the phone

	   if('phone' == $field['key'])
	   {
	   	$phone = $field['value'];
	   }

	   //get the organisation

	   if('organisation_1500882364122' == $field['key'])
	   {
	   	$organisation = $field['value'];
	   }

	   //get the profession

	   if('profession_1500882378779' == $field['key'])
	   {
	   	$profession = $field['value'];
	   }

	   //get the time

	   if('time_1500882567270' == $field['key'])
	   {
	   	$time = $field['value'];
	   }

	   //get the date

	   if('date_1500882527162' == $field['key'])
	   {
	   	$date = $field['value'];
	   }

	    //get the city

	   if('city_1500882595388' == $field['key'])
	   {
	   	$city = $field['value'];
	   }

	    //get the state

	   if('liststate_1500882602054' == $field['key'])
	   {
	   	$state = $field['value'];
	   }

	   //get the zip

	   if('zip_1500882611395' == $field['key'])
	   {
	   	$zip = $field['value'];
	   }

	   // get the address

	   if('address_1500897511065' == $field['key'])
	   {
	   	$address = $field['value'];
	   }

	   // get the fundraise

	   if('do_you_want_to_fundraise_1500882668121' == $field['key'])
	   {
	   	$fundraise = $filed['value'];
	   }

	   // get the permission

	   if('premission_1500882733186' == $field['key'])
	   {
	   	 $permission = $field['value'];
	   }

	   // get the communication

	   if('communication_1500882813720' == $field['key'])
	   {
	   	 $communication = $field['value'];
	   }

	   
	   
    
  }

  	  //$address = 'BTM 2nd Stage, Bengaluru, Karnataka 560076';

	// Get JSON results from this request
	$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

	// Convert the JSON to an array
	$geo = json_decode($geo, true);



	if ($geo['status'] == 'OK') {
	  // Get Lat & Long
	  $latitude = $geo['results'][0]['geometry']['location']['lat'];
	  $longitude = $geo['results'][0]['geometry']['location']['lng'];

	  $event = array(
		    'post_content' => '',
			'post_excerpt' => '',
		    'post_status' => "publish",
		    'post_title' => $firstname."-".$lname,
		    'post_parent' => '',
		    'post_type' => "event",
		    );
			

			$post_id = wp_insert_post($event);
			update_post_meta( $post_id, 'wpcf-first-name', $firstname);
			update_post_meta( $post_id, 'wpcf-last-name',  $lname);
			update_post_meta( $post_id, 'wpcf-email', $email);
			update_post_meta( $post_id, 'wpcf-phone', $phone);
			update_post_meta( $post_id, 'wpcf-profession', $profession);
			update_post_meta( $post_id, 'wpcf-event-details', $event_val);
			update_post_meta( $post_id, 'wpcf-time', $time);
			update_post_meta( $post_id, 'wpcf-city', $city);
			update_post_meta( $post_id, 'wpcf-state', $state);
			update_post_meta( $post_id, 'wpcf-zip', $zip);
			update_post_meta( $post_id, 'wpcf-fundraise', $fundraise);
			update_post_meta( $post_id, 'wpcf-premission', $premission);
			update_post_meta( $post_id, 'wpcf-communication', $communication);
			update_post_meta( $post_id, 'wpcf-latitude', $latitude);
			update_post_meta( $post_id, 'wpcf-longitude', $longitude);
			update_post_meta( $post_id, 'wpcf-date', $date);
			update_post_meta( $post_id, 'wpcf-organisation', $organisation);
			update_post_meta( $post_id, 'wpcf-fundraise', $fundraise);
			update_post_meta( $post_id, 'wpcf-premission', $permission);
	}


	        


 //die;
 
 }
