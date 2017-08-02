<?php
/*
Plugin Name: Reffarel Friend
Plugin URI: http://uniterrene..com/
Description: A hello world plugin used to demonstrate the process of creating plugins.
Version: 1.0
Author: Uniterrene Web Soft Pvt Ltd.
Author URI: http://uniterrene.com
License: GPL
*/
require_once('includes/admin_settings.php');
function invite_scripts() {
    wp_enqueue_script( 'invite-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'invite_scripts' );


//Hooks a function to a filter action, 'the_content' being the action, 'hello_world' the function.
add_filter('the_content','reffar_friend');
 
//Callback function
function reffar_friend($content)
{
 //Checking if on post page.
 if ( is_single() ) {
 //Adding custom content to end of post.
 return $content . "<h1> Hello Akash Dutta </h1>";
 }
 else {
 //else on blog page / home page etc, just return content as usual.
 return $content;
 }
}

function invite_front_end() {
	if (is_user_logged_in()) {
		require_once('includes/email-form.php');
    } else{
		echo '<p>Please Login to Invite </p>';
	}
	
}
add_shortcode('invite', 'invite_front_end');

/**
 * Simple helper function for make menu item objects
 * 
 * @param $title      - menu item title
 * @param $url        - menu item url
 * @param $order      - where the item should appear in the menu
 * @param int $parent - the item's parent item
 * @return \stdClass
 */ 
function _custom_nav_menu_item( $title, $url, $order, $parent = 0 ){
  $item = new stdClass();
  $item->ID = 1000000 + $order + parent;
  $item->db_id = $item->ID;
  $item->title = $title;
  $item->url = $url;
  $item->menu_order = $order;
  $item->menu_item_parent = $parent;
  $item->type = '';
  $item->object = '';
  $item->object_id = '';
  $item->classes = array();
  $item->target = '';
  $item->attr_title = '';
  $item->description = '';
  $item->xfn = '';
  $item->status = '';
  return $item;
}

add_filter( 'wp_get_nav_menu_items', 'custom_nav_menu_items', 20, 2 );

function custom_nav_menu_items( $items, $menu ){
   $items[] = _custom_nav_menu_item( 'Invite', '/dev/deworbaby-live/invite-friend/', 3, $top->ID ); 
 
    
  return $items;
}


add_action("wp_ajax_send_invitetion", "send_invitetion");
add_action("wp_ajax_nopriv_send_invitetion", "send_invitetion");

function send_invitetion()
{	
	$user = wp_get_current_user(); 
	$user_meta = get_metadata('user', $user->ID, 'referral', $single);

	
	$subject = $user->display_name.' just invited you to check out eco-conscious diapers';
	$message = "Click on the unique link below and you�ll both get a free $20 credit after you purchase your first subscription!<br>";
	$url = esc_url(home_url('/'))."registration/?signup=".$user_meta['0'];
	$message .= "<a href='".$url."'>Sign up Now </a>";

	$from = $user->user_email;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$from."\r\n".
	'Reply-To: '.$from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	if($_POST['post_id'] != ''){
		$pid = $_POST['post_id'];
	} else {
		$new_post = array(
		 'post_title'    => "refferal_invitation_".$user->display_name,
		 'post_status'   => 'publish',          
		 'post_type'     => "refferal_invitation" 
		);
		$pid = wp_insert_post($new_post);
	}
	add_post_meta($pid, 'reffar_email_'.$_POST['email'], $_POST['email'], true);
	if(wp_mail( $_POST['email'], $subject, $message, $headers )){
		echo "Mail sent Successfully";
	}
	
}

/* Update Wallet Amount by Afflite Start */
add_action( 'woocommerce_thankyou', 'add_affiliate_amount', 10, 1 );

function add_affiliate_amount($order_id) {
    $post_mata = get_post_meta( $order_id, '_customer_user' );
	$meta_user_id = $post_mata[0];
	$order_user_meta = get_user_meta($meta_user_id, $key = 'affiliate', $single = false);
	$refferal = $order_user_meta[0];
	$affiliate_user = get_users(array('meta_key' => 'referral', 'meta_value' => $refferal));
	$wallet_meta = get_user_meta($affiliate_user[0]->ID, $key = 'wallet', $single = false);
	$wallet = $wallet_meta[0]+20;
	update_user_meta($affiliate_user[0]->ID, 'wallet', $wallet, $prev_value = '');
}

/* add_action( 'woocommerce_review_order_before_order_total', 'sb_user_end_price', 10, 1 );
function sb_user_end_price(  ) {
     global $woocommerce;
	return $woocommerce->cart->total = $woocommerce->cart->total - 2;
	 
}

//add_action( 'woocommerce_calculate_totals', 'sb_user_end_total', 10, 1 );
function sb_user_end_total(  ) {
     global $woocommerce;
	return $woocommerce->cart->total = $woocommerce->cart->total - 2;
	 
}
//add_action( 'woocommerce_before_cart_totals', 'custom_cart_total' );
/* function custom_cart_total() {

    WC()->cart->total *= 20;
    //var_dump( WC()->cart->total);
} 
// define the woocommerce_order_amount_total callback 
  function custom_cart_total( $order_total ) { 
	global $woocommerce;
	$woocommerce->cart->total = $woocommerce->cart->total - 2;
	$total = $woocommerce->cart->total;
    $order_total = '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>'.$total.'</span>';
    return $order_total; 
}; 
//add_filter( 'woocommerce_cart_totals_order_total_html', 'custom_cart_total' );

/* Update Wallet Amount by Afflite Start */

