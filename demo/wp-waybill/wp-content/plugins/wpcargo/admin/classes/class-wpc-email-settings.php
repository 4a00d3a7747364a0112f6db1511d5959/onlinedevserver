<?php





if (!defined('ABSPATH')) {

exit; // Exit if accessed directly





}





class WPCargo_Email_Settings{

private $text_domain = 'wpcargo';

function __construct(){

add_action('admin_menu', array( $this, 'add_email_settings_menu' ) );

//call register settings function

add_action( 'admin_init', array( $this, 'register_wpcargo_mail_settings') );



}

public function add_email_settings_menu(){

add_submenu_page( 

	'wpcargo-settings', 

	__( 'Email Settings', $this->text_domain ),

	__( 'Email Settings', $this->text_domain ),

	'manage_options',

	'wpcargo-email-settings',

	

	array( $this, 'add_email_settings_menu_callback' )

);

}

public function add_email_settings_menu_callback(){

$options 		= get_option('wpcargo_mail_settings');

$page_options 	= get_option('wpcargo_email_page_settings');

?>





        <div class="wrap">





            <h1>Email Settings</h1>





        <?php

require_once( WPCARGO_PLUGIN_PATH.'admin/templates/admin-navigation.tpl.php' );

require_once( WPCARGO_PLUGIN_PATH.'admin/templates/email-settings-option.tpl.php' );

?>





        </div>





        <?php

}

function register_wpcargo_mail_settings() {

//register our settings

register_setting( 'wpcargo_mail_settings', 'wpcargo_mail_settings' );

register_setting( 'wpcargo_mail_settings', 'wpcargo_email_page_settings' );

}







}





new WPCargo_Email_Settings;