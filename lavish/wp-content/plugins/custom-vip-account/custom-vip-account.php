<?php
/*
Plugin Name: Custom-vip-account
Plugin URI: http://yourdomain.com/
Description: A simple plugin That can create some vip accounts
Version: 2.0
Author: Shourya
Author URI: http://yourdomain.com
License: GPL
*/
?>
<?php


require_once( ABSPATH . 'wp-content/plugins/custom-vip-account/get_data.php' );



register_activation_hook( __FILE__, 'my_plugin_create_db' );
function my_plugin_create_db() 
{
	global $wpdb;
//$version = get_option( 'my_plugin_version', '1.0' );
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'vip_accounts';
	$table_name_package = $wpdb->prefix . 'package_price';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		`vip_account_id` int(10) NOT NULL AUTO_INCREMENT,
  `vip_account_name` varchar(255) NOT NULL,
  `vip_account_package_name` varchar(255) NOT NULL,
  `vip_account_post_limit` int(10) NOT NULL,
  `vip_account_access` varchar(255) NOT NULL,
  `vip_user_id` int(10) NOT NULL,
  PRIMARY KEY (`vip_account_id`)
	) $charset_collate;";
	
	

if ( version_compare( $version, '2.0' ) < 0 ) 

{
	
	$sql = "CREATE TABLE $table_name (
		  `vip_account_id` int(10) NOT NULL AUTO_INCREMENT,
  `vip_account_name` varchar(255) NOT NULL,
  `vip_account_package_name` varchar(255) NOT NULL,
  `vip_account_post_limit` int(10) NOT NULL,
  `vip_account_access` varchar(255) NOT NULL,
  `vip_user_id` int(10) NOT NULL,
  `vip_account_seleted_model` varchar(255) NOT NULL,
  `vip_account_updated_model` varchar(255) NOT NULL,
  PRIMARY KEY (`vip_account_id`)
		) $charset_collate;";
		
	
	  	update_option( 'my_plugin_version', '2.0' );
		
	}
	
if ( version_compare( $version, '2.1' ) < 0 ) 

{
	
	//$sql_drop ="DROP TABLE $table_name";
	
	$sql = "CREATE TABLE $table_name (
		  `vip_account_id` int(10) NOT NULL AUTO_INCREMENT,
  `vip_account_name` varchar(255)  NOT NULL,
  `vip_account_package_name` varchar(255)  NOT NULL,
  `vip_account_post_limit` int(10) NOT NULL,
  `vip_account_access` varchar(255)  NOT NULL,
  `vip_user_id` int(10) NOT NULL,
  `is_payment` int(10) NOT NULL,
  `vip_first_name` varchar(255)  NOT NULL,
  `vip_last_name` varchar(255)  NOT NULL,
  `vip_nationality` varchar(255)  NOT NULL,
  `vip_address` varchar(255)  NOT NULL,
  `vip_city` varchar(255) NOT NULL,
  `vip_zipcode` varchar(255)  NOT NULL,
  `vip_email` varchar(255)  NOT NULL,
  `vip_phone` varchar(255) NOT NULL,
  `vip_mob_num` varchar(255)  NOT NULL,
  `vip_time_call` varchar(255)  NOT NULL,
  `vip_explain` varchar(255)  NOT NULL,
  `vip_hot_spot` varchar(255)  NOT NULL,
  `vip_toys` varchar(255)  NOT NULL,
  `vip_gateway` varchar(255)  NOT NULL,
  `vip_monthy_package` varchar(255)  NOT NULL,
  `vip_total_package` varchar(255)  NOT NULL,
  PRIMARY KEY (`vip_account_id`)
		) $charset_collate;";
		
		
		$sql_new = "CREATE TABLE $table_name_package (
		   `package_id` int(255) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL,
  `package_price` int(255) NOT NULL,
  PRIMARY KEY (`package_id`)
		) $charset_collate;";
	
	  	update_option( 'my_plugin_version', '2.1' );
		
	}	
	


	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	//dbDelta( $sql_drop );
	dbDelta( $sql );
	//dbDelta( $sql_new );
}

//add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Vip Accounts Details', 'Vip Accounts Details', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
	
}



function myplguin_admin_page(){
	?>
	<div class="wrap">
		<h2>Welcome To My Plugin</h2>
	</div>
	<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
			<th><?php _e('Id', 'pippinw'); ?></th>
			<th><?php _e('Name', 'pippinw'); ?></th>
			<th><?php _e('Package Name', 'pippinw'); ?></th>
			<th><?php _e('Post Limit', 'pippinw'); ?></th>
			<th><?php _e('Account Access', 'pippinw'); ?></th>
			
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Id', 'pippinw'); ?></th>
			<th><?php _e('Name', 'pippinw'); ?></th>
			<th><?php _e('Package Name', 'pippinw'); ?></th>
			<th><?php _e('Post Limit', 'pippinw'); ?></th>
			<th><?php _e('Account Access', 'pippinw'); ?></th>
		
		</tr>
	</tfoot>
	<tbody>
	<?php
	
	
	global $wpdb;

    $appTable = $wpdb->prefix . "vip_accounts";
    $query = $wpdb->prepare("SELECT * FROM $appTable WHERE %d >= '0'", RID);
    $applications = $wpdb->get_results($query);

    foreach ( $applications as $application ) {
       // print_r($application);
        
        ?>
        
        <tr>
				<td><?php echo $application->vip_account_id; ?></td>
				<td><?php echo $application->vip_account_name; ?></td>
				<td><?php echo $application->vip_account_package_name; ?></td>
				<td><?php echo $application->vip_account_post_limit; ?></td>
				<td><?php echo $application->vip_account_access; ?></td>
				
			</tr>
        
    <?php }
	
	
	$data_array = array('here'); // this array holds all of your data
	
	?>	
	</tbody>
</table>
	<?php
}
?>
