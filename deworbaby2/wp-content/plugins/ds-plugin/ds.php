<?php
/**
* Plugin Name: Ds Short Code
* Plugin URI: http://uniterrene.com/
* Description: Uniterrene websoft is an outsourcing IT & Software offshore development company which provides professional web designing services.
* Version: 1.0 
* Author: D Santra
* Author URI: http://uniterrene.com/
* License: UNIDS007
*/

add_filter('show_admin_bar', '__return_false');
add_action( 'init', 'recive_code' );

function recive_code() {
if( isset( $_POST['redeemcode'] ) ) {


$args = array(
'blog_id'      => $GLOBALS['blog_id'],
'role'         => '',
'role__in'     => array(),
'role__not_in' => array(),
'meta_key'     => '_rec_codeno',
'meta_value'   => $_POST['redeemcode'] ,
'meta_compare' => '',
'meta_query'   => array(),
'date_query'   => array(),        
'include'      => array(),
'exclude'      => array(),
'orderby'      => 'login',
'order'        => 'ASC',
'offset'       => '',
'search'       => '',
'number'       => '',
'count_total'  => false,
'fields'       => 'all',
'who'          => ''
); 
$userdatads = get_users( $args ); 

foreach ( $userdatads as $userdd ) {
//echo '<span>' . esc_html( $userdd->display_name ) . '</span>';
$url=wc_get_page_permalink( 'myaccount' ).'/new-recipient-account';
//wp_redirect( $url );


// Automatic login //
$username = $userdd->display_name;
$user = get_user_by('login', $username );

// Redirect URL //
if ( !is_wp_error( $user ) )
{
wp_clear_auth_cookie();
wp_set_current_user ( $user->ID );
wp_set_auth_cookie  ( $user->ID );

//  $redirect_to = user_admin_url();
if ( ! delete_user_meta($user->ID, '_rec_codeno') ) {
//  echo "Ooops! Error while deleting this information!";
}
wp_safe_redirect( $url );
exit();
}

exit;

}


}
}

/*add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_custom_data_vase', 10, 2 );
function add_cart_item_custom_data_vase( $cart_item_meta, $product_id ) {
global $woocommerce;
$cart_item_meta['recipient_dsname'] = $_POST['recipient_dsname'][0];
$cart_item_meta['recipient_recipnote'] = $_POST['recipnote'][0]; 
return $cart_item_meta; 
}*/

//add_filter( 'body_class', 'body_custom_class' );
function body_custom_class( $classes ) {
if ( is_page_template( 'template-giftproducts.php' ) ) {
$classes[] = 'page_gift';
}
return $classes;
}

//add_action( 'wp_ajax_update_cartds', 'update_cartds' );
//add_action( 'wp_ajax_nopriv_update_cartds', 'update_cartds' );
function update_cartds(){
global $woocommerce;
$pid=$_REQUEST['pid'];
$name=$_REQUEST['rname'];
$note=$_REQUEST['rnote'];

if($pid=='ds99'){
$woocommerce->session->set('recipient_dsname',$name);
$woocommerce->session->set('recipnote',$note);
echo 'nodata';
}else{
$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint($_REQUEST['pid']) );
$woocommerce->session->set('recipient_dsname',$name);
$woocommerce->session->set('recipnote',$note);
$qty=1;
$woocommerce->cart->empty_cart();
if ( $woocommerce->cart->get_cart_contents_count() == 0 ) {
$woocommerce->cart->add_to_cart($product_id,$qty);

$cart_itemsd = $woocommerce->cart->get_cart();
//print_r($cart_itemsd);
foreach($cart_itemsd as $cart_item_key=>$cart_item){	
echo WCSG_Cart::maybe_display_gifting_information( $cart_item, $cart_item_key );
}
}else{
echo 'nodata';
}

}
exit();
//return 'addcss-'.$product_id;
}

/**
* Auto processing all wooCommerce orders.
* changed the order status to processing and redirected to my account page
*/
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
if ( ! $order_id ) {
return;
}
$order = wc_get_order( $order_id );
//$order->update_status( 'completed' );
$order->update_status( 'processing' );	
//wp_logout();
//wp_safe_redirect(get_permalink(612));
wp_safe_redirect(get_permalink(42));
//exit;	
}


add_filter('add_to_cart_redirect', 'giftredirect_to_checkout',11);
function giftredirect_to_checkout() {
	global $woocommerce;
	//Get product ID
	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint($_REQUEST['add-to-cart'] ) );
	//Check if product ID is in a certain taxonomy
	$qty=1;
	if( has_term( 'gift', 'product_cat', $product_id ) ){				 

		if( isset( $_REQUEST['reactive'] ) ) {
			$woocommerce->session->set('reactive','hidegifthtml');					   
		}

		$woocommerce->cart->empty_cart();

	} elseif( has_term( 'subscription', 'product_cat', $product_id ) ){

		$woocommerce->cart->empty_cart();

	} elseif( has_term( 'trial', 'product_cat', $product_id ) ){

		$woocommerce->cart->empty_cart();

	}
	 else{

		$items = $woocommerce->cart->get_cart();
		foreach($items as $item => $values) { 
			$_product = $values['data']->post; 
			//$ids[] = $_product->ID;
			$terms = get_the_terms( $_product->ID, 'product_cat' );
			foreach ($terms as $term) {
				if($term->term_id==18 || $term->term_id==20 || $term->term_id==29)
			    // $product_cat_id = $term->term_id;
			    // break;   
			    $woocommerce->cart->remove_cart_item($item);
			}
		} 
	}

	if ( $woocommerce->cart->get_cart_contents_count() == 0 ) {
		$woocommerce->cart->add_to_cart($product_id, $qty);
	}

	$checkout_url = get_permalink(get_option('woocommerce_checkout_page_id'));
	//Return the new URL
	return $checkout_url;
}

//add_filter( 'password_change_email', 'wpse207879_change_password_mail_message',  10, 3 );
function wpse207879_change_password_mail_message( $pass_change_mail,  $user,  $userdata ) {
//	print_r($userdata);
$user_id=$user['ID'];
$gifted_items         = WCS_Gifting::get_recipient_order_items($user['ID']);
//print_r($gifted_items);

$recipient_shipping_address = WC()->countries->get_formatted_address( WCS_Gifting::get_users_shipping_address( $user_id ));
//	echo '<pre>';
//print_r($recipient_data);	

foreach ($gifted_items as $order) {

$order_id=$order['order_id'];


$pname=get_the_title($order['order_item_id']);
//$order = new WC_Order($orderp['order_id']);

$order = wc_get_order($order_id);
/*echo '<pre>';
print_r($order);
echo '
=============
</pre>';*/

foreach($order->get_items('line_item') as $item) {
//  if ($post->ID == $item['product_id'] || $post->ID == $item['variation_id']) {
//  print_r($item);
if($order->order_type=='shop_subscription'){
$ship .=  '<br>'.$order_id.' Order Name : #'.$order->id;
$ship .= '<br> Date: '.$order->order_date; 
$ship .=  '<br> Gift Name: '.$item['name'];
$ship .=  '<br> Gift Sender Email: '.$order->billing_email; 
$ship .=  '<br> Gift amount Total: $'.$order->get_line_total( $item ).'<br>-----------<br>';   
}
//     }  
}

//get_order_details($order_id);

}

$ship .= ' <h4>Shipping Address</h4> <br>  '.$recipient_shipping_address;


$new_message_txt = __( 'Some text ###USERNAME### more text
even more text ###EMAIL### more text after more text
last bit of text ###SITENAME###' );
$usenameds = get_user_by('ID',$user_id)->user_login;

$user_passw = get_user_meta( $user_id, 'upassds', true ); 

$userhtmds='<br> user Name: '.$usenameds.'<br> User Password: '.$user_passw;

$pass_change_mail[ 'message' ] = $new_message_txt.'<br> ======================= <br> '.$ship.'<br> ==================='.$userhtmds;
$pass_change_mail[ 'subject' ] ='My Info .. ';
$pass_change_mail[ 'headers' ]= array('Content-Type: text/html; charset=UTF-8');

return $pass_change_mail;
//die('ccccccccccc');
}


//add_action( 'wp_enqueue_scripts', 'lightbox' );
function lightbox() {
global $woocommerce;
if ( is_page_template( 'template-giftproducts.php' ) ) {

$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
{
wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
}
}
}

/*function action_woocommerce_edit_account_form_end(  ) { 
// make action magic happen here... 
$user = wp_get_current_user();
$upss = $_POST['password_1'];
update_user_meta( $user->ID, 'upassds', $upss);


}; 

// add the action 
add_action( 'woocommerce_edit_account_form_end', 'action_woocommerce_edit_account_form_end', 10, 0 ); */
