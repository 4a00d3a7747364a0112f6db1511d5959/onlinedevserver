<?php

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}
class WPCargo_Admin_Settings{

	private $text_domain = 'wpcargo';

	function __construct(){

		add_action('admin_menu', array( $this, 'add_settings_menu' ) );

		//call register settings function

		add_action( 'admin_init', array( $this,'register_wpcargo_option_settings') );

	}
	public function add_settings_menu(){

		add_menu_page(

			__( 'WPCargo', $this->text_domain ),

			'WPCargo',

			'manage_options',

			'wpcargo-settings',

			array( $this, 'add_settings_menu_callback' ),

			'dashicons-book-alt',

			6

		);
		add_submenu_page( 

			'wpcargo-settings', 

			__( 'General Settings', $this->text_domain ),

			__( 'General Settings', $this->text_domain ),

			'manage_options',

			'wpcargo-settings'

		);

	}
	public function add_settings_menu_callback() {

		$options 		= get_option('wpcargo_option_settings');

		$page_options 	= get_option('wpcargo_page_settings');

		?>

<div class="wpcargo-settings">
  <div class="wrap" id="wpc-left">
    <h1>WPCargo Settings</h1>
    <?php
	
				require_once( WPCARGO_PLUGIN_PATH.'admin/templates/admin-navigation.tpl.php' );
		
				require_once( WPCARGO_PLUGIN_PATH.'admin/templates/settings-option.tpl.php' );
	
			?>
  </div>
  <div class="wrap" id="wpc-right"> <a href="http://www.wpcargo.com/documentation/" target="_blank" class="wpc-documentation">
    <div class="wpc-img"> <img src="<?php echo WPCARGO_PLUGIN_URL.'/admin/assets/images/documentation.png'; ?>" /> </div>
    <div class="wpc-desc">
      <h3>Get Started Here</h3>
      <p>Documentation</p>
    </div>
    </a> <a href="http://www.wpcargo.com/purchase/" target="_blank" class="wpc-add-ons">
    <div class="wpc-img"> </div>
    <div class="wpc-desc">
      <h3>Add Ons</h3>
      <p>More Info</p>
    </div>
    </a> <a href="https://www.facebook.com/wpcargo/" target="_blank" class="wpc-facebook">
    <div class="wpc-img"> </div>
    <div class="wpc-desc">
      <h3>Facebook</h3>
      <p>Like our page</p>
    </div>
    </a> <a href="http://www.wpcargo.com/" target="_blank" class="wpc-get-support">
    <div class="wpc-img"> </div>
    <div class="wpc-desc">
      <h3>Get Support</h3>
      <p>Contact Us</p>
    </div>
    </a> <a href="http://www.wptaskforce.com/" target="_blank" class="wpc-get-website-hosting">
    <div class="wpc-img"> </div>
    <div class="wpc-desc">
      <h3>Get Website Hosting</h3>
      <p>Free Website Design</p>
    </div>
    </a> </div>
</div>
<?php

	}
	function register_wpcargo_option_settings() {

		//register our settings

		register_setting( 'wpcargo_option_settings_group', 'wpcargo_option_settings' );

		register_setting( 'wpcargo_option_settings_group', 'wpcargo_page_settings' );

	}

}

new WPCargo_Admin_Settings;
