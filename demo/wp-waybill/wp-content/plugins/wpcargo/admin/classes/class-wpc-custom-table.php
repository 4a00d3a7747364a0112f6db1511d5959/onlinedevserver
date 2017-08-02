<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

add_filter('manage_wpcargo_shipment_posts_columns' , 'set_default_wpcargo_columns');
function set_default_wpcargo_columns($columns) {

    $get_the_wpcargo_tbl = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( apply_filters( 'wpc_admin_tbl_list_tracking_number', 'Tracking Number' ), 'wpcargo'),
		'agent_fields' => __( apply_filters( 'wpc_admin_tbl_list_agent', 'Agent' ), 'wpcargo'),	
		'wpcargo_shipper_name' => __( apply_filters( 'wpc_admin_tbl_list_shipper_name', 'Shipper Name' ), 'wpcargo'),	
		'wpcargo_receiver_name' => __( apply_filters( 'wpc_admin_tbl_list_receiver_name', 'Receiver Name' ), 'wpcargo'),	
		'wpcargo_date' => __( apply_filters( 'wpc_admin_tbl_list_date', 'Date' ), 'wpcargo'),
		'wpcargo_status' => __( apply_filters( 'wpc_admin_tbl_list_status', 'Status' ), 'wpcargo'),   
		'wpcargo_actions' => __( apply_filters( 'wpc_admin_tbl_list_action', 'Actions' ), 'wpcargo'),       
    );
	
	return $get_the_wpcargo_tbl;
	
}

add_action( 'manage_wpcargo_shipment_posts_custom_column', 'manage_default_wpcargo_columns', 10, 2 );
function manage_default_wpcargo_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {		
		case 'agent_fields' :
			$agent_fields = get_post_meta($post_id, 'agent_fields', true);
			if(!empty($agent_fields)) {
				_e( get_the_author_meta( 'first_name', $agent_fields ). ' '.get_the_author_meta( 'last_name', $agent_fields ), 'wpcargo' );
			}else{
				_e( 'N/A', 'wpcargo' );
			}
			break;	
		case 'wpcargo_shipper_name' :
			$wpcargo_shipper_name = get_post_meta($post_id, 'wpcargo_shipper_name', true);
			if(!empty($wpcargo_shipper_name)) {
				_e( $wpcargo_shipper_name, 'wpcargo' );
			}else{
				_e( 'N/A', 'wpcargo' );
			}
			break;	
		case 'wpcargo_receiver_name' :
			$wpcargo_receiver_name = get_post_meta($post_id, 'wpcargo_receiver_name', true);
			if(!empty($wpcargo_receiver_name)) {
				_e( $wpcargo_receiver_name, 'wpcargo' );
			}else{
				_e( 'N/A', 'wpcargo' );
			}
			break;				
		case 'wpcargo_date':
			$wpcargo_date_publish = get_the_date( get_option( 'date_format' ), $post_id );
			if(!empty($wpcargo_date_publish)) {
				_e( $wpcargo_date_publish, 'wpcargo' );
			}else{
				_e( 'N/A', 'wpcargo' );
			}
			break;	
		case 'wpcargo_status' :
			$wpcargo_status = get_post_meta($post_id, 'wpcargo_status', true);
			if(!empty($wpcargo_status)) {
				_e( $wpcargo_status, 'wpcargo' );
			}else{
				_e( 'No Status', 'wpcargo' );
			}
			break;	
		case 'wpcargo_shipment_cat' :
			$terms = get_the_terms( $post_id, 'wpcargo_shipment_cat' );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => 'wpcargo_shipment', 'wpcargo_shipment_cat' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'wpcargo_shipment', 'display' ) )
					);
				}
				echo join( ', ', $out );
			}
			else {
				_e( 'No Category', 'wpcargo' );
			}
			break;
			
			case 'wpcargo_actions' : 
				echo '<a href="edit.php?post_type=wpcargo_shipment&page=wpcargo-print-layout&id='.get_the_ID().'"><span class="ti-printer"></span></a>';			
			break;
	
		default :
			break;

	}
	
}

add_filter( 'manage_edit-wpcargo_shipment_sortable_columns', 'set_custom_wpcargo_sortable_columns' );
function set_custom_wpcargo_sortable_columns( $columns ) {
	$columns['wpcargo_date'] 			= 'wpcargo_date';	
	$columns['agent_fields'] 			= 'agent_fields';
	$columns['wpcargo_shipper_name'] 	= 'wpcargo_shipper_name';
	$columns['wpcargo_receiver_name'] 	= 'wpcargo_receiver_name';
	return $columns;
}

add_action( 'pre_get_posts', 'wpcargo_custom_orderby' );
function wpcargo_custom_orderby( $query ) {
	
	if ( ! is_admin() ) 
	return;
	
	if(isset($_GET['post_type']) && $_GET['post_type'] == 'wpcargo_shipment') {	
		
		$orderby = $query->get( 'orderby');
		
		if(!isset($_GET['orderby'])){
			$query->set( 'orderby', 'wpcargo_date' );
			$query->set( 'order', 'DESC' );				
		}

		
		if ( 'agent_fields' == $orderby ) {
			$query->set( 'meta_key', 'agent_fields' );
			$query->set( 'orderby', 'meta_value' );
		}	
		
		if ( 'wpcargo_shipper_name' == $orderby ) {
			$query->set( 'meta_key', 'wpcargo_shipper_name' );
			$query->set( 'orderby', 'meta_value' );
		}	
		
		if ( 'wpcargo_receiver_name' == $orderby ) {
			$query->set( 'meta_key', 'wpcargo_receiver_name' );
			$query->set( 'orderby', 'meta_value' );
		}		
				
	}

}