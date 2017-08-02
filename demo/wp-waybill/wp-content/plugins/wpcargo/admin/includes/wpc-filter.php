<?php

if (!defined('ABSPATH')){

	exit; // Exit if accessed directly

}


add_action('restrict_manage_posts', 'wpc_filter_status');
function wpc_filter_status() {
	global $typenow;
	$post_type = 'wpcargo_shipment'; // change to your post type
	$status  = 'wpcargo_status'; // change to your taxonomy
	if ($typenow == $post_type) {
		$wpcargo_option_settings = get_option('wpcargo_option_settings');
		$get_all_status = $wpcargo_option_settings['settings_shipment_status'];
		$explode_status = explode(",", $get_all_status);
		echo '<select name="wpcargo_status">';
			echo '<option value="">'.__('-- Select All Status --', 'wpcargo').'</option>';
		foreach($explode_status as $val){	
		$selected_val = isset($_REQUEST[$status]) && $_REQUEST[$status] == trim($val) ? 'selected' : '';	
			echo '<option value="'.trim($val).'" '.$selected_val.'>'.trim($val).'</option>';
		}
		echo '</select>';
		
		//Agents		
		$args_agent = array(
			'role'         => 'cargo_agent',
			'meta_key' => 'first_name',
			'orderby'  => 'meta_value',
		 ); 
		$get_wpcargo_agent = get_users( $args_agent );
		
		if(!empty($get_wpcargo_agent) && is_array($get_wpcargo_agent)) {
			echo '<select name="cargo_agent">';
				echo '<option value="">'.__('-- All Agents --', 'wpcargo').'</option>';
			foreach($get_wpcargo_agent as $agent_details){	
				
				$firstName = get_user_meta($agent_details->ID, 'first_name', true);
				$lastName = get_user_meta($agent_details->ID, 'last_name', true);
				$selected_val = isset($_REQUEST['cargo_agent']) && $_REQUEST['cargo_agent'] == $agent_details->ID ? 'selected' : '';	
				echo '<option value="'.trim($agent_details->ID).'" '.$selected_val.'>'.trim($firstName.' '.$lastName).'</option>';
			}
			echo '</select>';
		}
		
		//Shipper Name		
		$get_shippers = wpc_get_meta_values('wpcargo_shipper_name');
		if(!empty($get_shippers) && is_array($get_shippers)) {
			$get_wpcargo_shipper = array_unique(array_filter($get_shippers));
			sort($get_wpcargo_shipper);
			echo '<select name="wpcargo_shipper_name">';
				echo '<option value="">'.__('-- All Shipper --', 'wpcargo').'</option>';
			foreach($get_wpcargo_shipper as $shipper_details){	
				$selected_val = isset($_REQUEST['wpcargo_shipper_name']) && $_REQUEST['wpcargo_shipper_name'] == $shipper_details ? 'selected' : '';	
				echo '<option value="'.trim($shipper_details).'" '.$selected_val.'>'.trim($shipper_details).'</option>';
			}
			echo '</select>';
		}		
		
		//Receiver Name		
		$get_receiver = wpc_get_meta_values('wpcargo_receiver_name');
		if(!empty($get_receiver) && is_array($get_receiver)) {
			$get_wpcargo_receiver = array_unique(array_filter($get_receiver));
			sort($get_wpcargo_receiver);
			echo '<select name="wpcargo_receiver_name">';
				echo '<option value="">'.__('-- All Receiver --', 'wpcargo').'</option>';
			foreach($get_wpcargo_receiver as $receiver_details){	
				$selected_val = isset($_REQUEST['wpcargo_receiver_name']) && $_REQUEST['wpcargo_receiver_name'] == $receiver_details ? 'selected' : '';	
				echo '<option value="'.trim($receiver_details).'" '.$selected_val.'>'.trim($receiver_details).'</option>';
			}
			echo '</select>';
		}
		
	};
}

add_filter('parse_query', 'wpc_status_query');
function wpc_status_query($query) {
	global $pagenow;
	$post_type = 'wpcargo_shipment'; 
	$q_vars    = &$query->query_vars;
	$get_wpc_query = array();

	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($_GET['wpcargo_status']) && $_GET['wpcargo_status'] != '' ) {
		$get_wpc_query[] = array(
			'key'     => 'wpcargo_status',
			'value'   => $_GET['wpcargo_status'],
			'compare' => '=',
		);
	}
	
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($_GET['cargo_agent']) && $_GET['cargo_agent'] != '') {
		 $get_wpc_query[] = array(
			'key'     => 'agent_fields',
			'value'   => $_GET['cargo_agent'],
			'compare' => '=',
		  );
	}
	
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($_GET['wpcargo_shipper_name']) && $_GET['wpcargo_shipper_name'] != '') {
		 $get_wpc_query[] = array(
			'key'     => 'wpcargo_shipper_name',
			'value'   => $_GET['wpcargo_shipper_name'],
			'compare' => '=',
		  );
	}
	
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($_GET['wpcargo_receiver_name']) && $_GET['wpcargo_receiver_name'] != '') {
		 $get_wpc_query[] = array(
			'key'     => 'wpcargo_receiver_name',
			'value'   => $_GET['wpcargo_receiver_name'],
			'compare' => '=',
		  );
	}
	
	$meta_query = array(
		$get_wpc_query
	);
	
	if(!isset($_GET['page']) && is_admin()) {
		$query->set( 'meta_query', $meta_query);
	}
	
}


add_filter('posts_join', 'wpc_search_join_admin_tbl_lists' );
function wpc_search_join_admin_tbl_lists ($join){
    global $pagenow, $wpdb;
	
    if ( isset($_GET['s']) && is_admin() && $pagenow=='edit.php' && $_GET['post_type']=='wpcargo_shipment' && $_GET['s'] != '') {    
        $join .='LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
	
    return $join;
}

add_filter( 'posts_where', 'wpc_search_query_admin_tbl_lists' );
function wpc_search_query_admin_tbl_lists( $where ){
    global $pagenow, $wpdb;
	
    if ( !isset($_GET['page']) && isset($_GET['s']) && is_admin() && $pagenow=='edit.php' && $_GET['post_type']=='wpcargo_shipment' && $_GET['s'] != '') {
        $where = preg_replace(
       "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
       "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }
    return $where;
}


function wpc_get_meta_values( $key = '', $type = 'wpcargo_shipment', $status = 'publish' ) {

    global $wpdb;

    if( empty( $key ) )
        return;

    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ) );

    return $r;
}

