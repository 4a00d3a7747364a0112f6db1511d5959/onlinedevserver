<?php
add_action( 'admin_menu', 'reffarel_invite_friend_settings' );

function reffarel_invite_friend_settings(){

  $page_title = 'Reffarel-Settings';
  $menu_title = 'Invite Friend';
  $capability = 'manage_options';
  $menu_slug  = 'reffarel-settings';
  $function   = 'invite_admin_friend_settings';
  $icon_url   = 'dashicons-admin-generic';
  $position   = 40;

  add_menu_page( $page_title,
                 $menu_title, 
                 $capability, 
                 $menu_slug, 
                 $function, 
                 $icon_url, 
                 $position );
}

function invite_admin_friend_settings()
{
 echo $content . "<h1> Hello Akash Dutta </h1>";
}

add_action( 'user_register', 'reffarel_registration_save', 10, 1 );
function reffarel_registration_save( $user_id ) {
	$referral = uniqid();
    add_user_meta($user_id, 'referral', $referral);
}

add_action( 'user_register', 'affiliate_registration_save', 10, 2 );
function affiliate_registration_save( $user_id ) {
	if(isset($_GET) && !empty($_REQUEST['signup'])){
		add_user_meta($user_id, 'affiliate', $_REQUEST['signup']);
	}
}


?>