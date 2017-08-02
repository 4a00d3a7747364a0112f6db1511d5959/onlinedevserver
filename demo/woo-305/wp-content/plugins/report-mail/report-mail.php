<?php
/*
Plugin Name: Report Mail
Plugin URI: http://uniterrene.com/
Description: A Report plugin used to use for providing daily mail of subscribtion product delivary report.
Version: 1.0.1
Author: Uniterrene WebSoft Pvt. Ltd.
Author URI: http://uniterrene.com/
License: GPL
*/

//debug code

$email_title = get_option("sb_section_title");
$email_to = get_option("sb_section_email_to");
$email_cc = get_option("sb_section_email_cc");
$email_bcc = get_option("sb_section_email_bcc");
$send_time = get_option("sb_section_email_sending_time");

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
   'interval' => 600, // Every 6 hours
   'display'  => __( 'Every 6 hours' ),
  );
  //mail('shourya@uniterrene.com','test','hello');
  return $schedules;
 }

///////Schedule an action if it's not already scheduled

 if( ! wp_next_scheduled( 'myprefix_curl_cron_action' ) ) {
  wp_schedule_event( time(), 'sixsec', 'myprefix_curl_cron_action' );
 }

 ///Hook into that action that'll fire sixhour
 add_action( 'myprefix_curl_cron_action', 'import_into_db' );
 /*corn function */

?>