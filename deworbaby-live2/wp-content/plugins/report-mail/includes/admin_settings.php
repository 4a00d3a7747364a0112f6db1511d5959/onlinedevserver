<?php
add_action( 'admin_menu', 'send_csv_settings' );

function send_csv_settings(){

  $page_title = 'Report-Mail';
  $menu_title = 'Report mail';
  $capability = 'manage_options';
  $menu_slug  = 'report-mail';
  $function   = 'wcpt_get_template';
  $icon_url   = 'dashicons-admin-generic';
  $position   = 10;

  add_menu_page( $page_title,
                 $menu_title, 
                 $capability, 
                 $menu_slug, 
                 $function, 
                 $icon_url, 
                 $position );
}

function subscribtion_admin_report_settings()
{
 echo $content . "<h1> Hello Akash Dutta </h1>";
 wcpt_get_template($template_name, $args = array(), $tempate_path = '', $default_path = '');
}

function wcpt_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
	$template_file = "dashboard.php";
	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;
	$template_file = wcpt_locate_template( $template_name, $tempate_path, $default_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;
	include $template_file;
}
function wcpt_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	$template_name = "dashboard.php";
	// Set variable to search in woocommerce-plugin-templates folder of theme.
	if ( ! $template_path ) :
		$template_path = 'report-mail/';
	endif;
	// Set default plugin templates path.
	if ( ! $default_path ) :
		 $default_path = plugin_dir_path( __FILE__ ) . 'templates/admin/'; // Path to the template folder
	endif;
	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );
	// Get plugins template file.
	if ( ! $template ) :
		 $template = $default_path . $template_name;
	endif;
	return apply_filters( 'wcpt_locate_template', $template, $template_name, $template_path, $default_path );
}


add_action( 'user_register', 'send_csv_save', 10, 1 );

function send_csv_save( $user_id ) {
	$referral = uniqid();
    add_user_meta($user_id, 'referral', $referral);
}
?>
