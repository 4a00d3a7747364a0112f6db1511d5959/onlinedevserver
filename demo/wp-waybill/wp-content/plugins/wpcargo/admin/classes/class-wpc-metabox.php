<?php

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**

 * Register a meta box using a class.

 */

class WPCargo_Metabox {

	public $text_domain = 'wpcargo';

    public function __construct() {

		add_filter('wp_mail_content_type', array( $this, 'wpcargo_set_content_type' ));

        if ( is_admin() ) {

			add_action('wpcargo_shipper_meta_section', array( $this, 'wpc_shipper_meta_template' ), 10 );

			add_action('wpcargo_receiver_meta_section', array( $this, 'wpc_receiver_meta_template' ), 10 );

			add_action('wpcargo_shipment_meta_section', array( $this, 'wpc_shipment_meta_template' ), 10 );

			add_filter('wpcargo_after_reciever_meta_section_sep', array( $this, 'wpc_after_reciever_meta_sep' ), 10 );

			add_action( 'save_post',      array( $this, 'save_metabox' ) );

			add_action( 'add_meta_boxes', array( $this, 'add_metabox'  ) );
			
			add_action( 'save_post', array( $this, 'wpcargo_sh_save_meta_box_data' ), 20, 10 );
        }

		add_action('save_post', array( $this, 'wpcargo_shipment_history_email_template' ), 20, 10  );

    }    
	
	/**
     * Adds the meta box.
     */    
	 
	 public function add_metabox() {

    	add_meta_box('wpc_add_meta_box', __('WPCargo Shipment Details', 'wpcargo'), array( $this, 'render_metabox' ), 'wpcargo_shipment');
		
		add_meta_box('wpcargo_shipment_history', __('WPCargo Shipment History', 'wpcargo-shipment-history'), array( $this, 'wpc_sh_metabox_callback' ), 'wpcargo_shipment');

		$wpc_mp_settings = get_option('wpc_mp_settings');

		if(!empty($wpc_mp_settings['wpc_mp_enable_admin'])) {

			add_meta_box( 'wpcargo-multiple-package', __( 'WPCargo Multiple Package', 'wpcargo' ), array($this, 'wpc_mp_metabox_callback'), 'wpcargo_shipment' );	

		}

    }	    
	
	/**
     * Renders the meta box.
     */    
	 
	 public function render_metabox( $post ) {
		 
        // Add nonce for security and authentication.
        wp_nonce_field( 'wpc_metabox_action', 'wpc_metabox_nonce' );
		$this->wpc_title_autogenerate();

	?>

	<div id="wrap">	

	<?php 
		
		do_action('wpcargo_before_metabox_section', 10);
		do_action('wpcargo_shipper_meta_section', 10);
		do_action('wpcargo_receiver_meta_section', 10);			
		apply_filters('wpcargo_after_reciever_meta_section_sep', 10 );			
		do_action('wpcargo_shipment_meta_section', 10);			
		do_action('wpcargo_after_metabox_section', 10); 
		
	?>

	</div>

	<script>

		jQuery(document).ready(function($) {

			$( "#wpc_add_meta_box .datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
			$("#wpc_add_meta_box .time_1").timepicker({timeFormat: "<?php echo get_option( 'time_format' ); ?>"});

		});

	</script>

	<?php
    }	
	
	public function wpc_shipper_meta_template() {

		global $post;		
		require_once( WPCARGO_PLUGIN_PATH.'admin/templates/shipper-metabox.tpl.php' );

	}	
	
	public function wpc_receiver_meta_template(){

		global $post;
		require_once( WPCARGO_PLUGIN_PATH.'admin/templates/receiver-metabox.tpl.php' );

	}	
	
	public function wpc_shipment_meta_template(){

		global $post;
		require_once( WPCARGO_PLUGIN_PATH.'admin/templates/shipment-metabox.tpl.php' );

	}
	
	public function wpc_after_reciever_meta_sep(){

		echo '<div class="clear-line"></div>';

	}
	
	public function wpc_title_autogenerate(){

		global $post;

		$options = get_option('wpcargo_option_settings');
		$recent_posts = wp_get_recent_posts( array('post_type' => 'wpcargo_shipment', 'numberposts' => 1 ), OBJECT );
		$recent_post = ( $recent_posts ) ? $recent_posts[0]->ID : 1 ;
		$screen = get_current_screen();
		$rand_number = abs(rand(10000000000, 999999999999));
		$wpc_title_number = $recent_post.$rand_number;

		if( $screen->action && ( !empty( $options['wpcargo_title_prefix_action'] ) && $options['wpcargo_title_prefix_action'] != NULL ) ){ 

			$wpc_title_prefix = ( $options['wpcargo_title_prefix'] ) ? $options['wpcargo_title_prefix'] : 'wpcargo' ;

		?>

		<script>

			jQuery(document).ready(function($) {	
				$( "#titlewrap #title" ).val('<?php echo $wpc_title_prefix.$wpc_title_number; ?>');	
			});

		</script>

<?php 

		}
	}
	
	public function excluded_meta_keys(){
		$excluded_meta_keys = array(
			'wpc_metabox_nonce',
			'save',
			'_wpnonce',
			'_wp_http_referer',
			'user_ID',
			'action',
			'originalaction',
			'post_author',
			'post_type',
			'original_post_status',
			'referredby',
			'_wp_original_http_referer',
			'post_ID',
			'meta-box-order-nonce',
			'closedpostboxesnonce',
			'post_title',
			'hidden_post_status',
			'post_status',
			'hidden_post_password',
			'hidden_post_visibility',
			'visibility',
			'post_password',
			'original_publish',
			'original_publish'
		);		
		return $excluded_meta_keys;
	}    
	
	/**

     * Handles saving the meta box.
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null

	 */  
	   
	 public function save_metabox( $post_id ) {
        
		// Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['wpc_metabox_nonce'] ) ? $_POST['wpc_metabox_nonce'] : '';
        $nonce_action = 'wpc_metabox_action';
        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }		
		
		//save the last status
		$get_last_status 		= get_post_meta($post_id, 'wpcargo_status', true);			
		$post_meta_keys 		= get_post_meta( $post_id );		
		$empty_value_meta_keys 	= array();
		
		foreach( $post_meta_keys as $key => $value ) {
			$empty_value_meta_keys[] = $key;
		}

		// Get all ecluded meta keys in saving post meta
		$excluded_meta_keys = $this->excluded_meta_keys();
		
		foreach( $_POST as $key => $value ) {

			if( ($key_found = array_search($key, $empty_value_meta_keys)) !== false ) {
				unset($empty_value_meta_keys[$key_found]);
			}

			if( in_array( $key, $excluded_meta_keys ) ) {
				continue;
			}			
			
			if( is_array( $value ) ) {
				$meta_value  = maybe_serialize( $value );
			} else {
				$meta_value  = sanitize_text_field( $value );
			}			
			update_post_meta($post_id, $key, $meta_value);
			
		}
		
		foreach( $empty_value_meta_keys as $key ) {
			update_post_meta( $post_id, $key, '' );
		}
		
    }	

	public function wpc_mp_metabox_callback($post) {
		
		$options 						= get_option( 'wpc_mp_settings' );
		$wpc_mp_dimension_unit 			= !empty($options['wpc_mp_dimension_unit']) ? $options['wpc_mp_dimension_unit'] : '';
		$wpc_mp_peice_type 				= !empty($options['wpc_mp_piece_type']) ? $options['wpc_mp_piece_type'] : '';
		$wpc_mp_weight_unit 			= !empty($options['wpc_mp_weight_unit']) ? $options['wpc_mp_weight_unit'] : '';			
		$wpc_mp_enable_dimension_unit 	= !empty($options['wpc_mp_enable_dimension_unit']) ? $options['wpc_mp_enable_dimension_unit'] : '';	
		$wpc_multiple_package 			= maybe_unserialize( get_post_meta( $post->ID, 'wpc-multiple-package', true ) );
        wp_nonce_field( 'wpc_mp_inner_custom_box', 'wpc_mp_inner_custom_box_nonce' );		
		require_once( WPCARGO_PLUGIN_PATH.'admin/templates/multiple-package-metabox.tpl.php' );		

	}
	
	public function wpc_mp_metabox_save($post_id) {

		$nonce_name   = isset($_POST['wpc_mp_inner_custom_box']) ? $_POST['wpc_mp_inner_custom_box'] : '';
		$nonce_action = 'wpc_mp_inner_custom_box_nonce';
		if (!isset($nonce_name)) {
			return;
		}

		if (!wp_verify_nonce($nonce_name, $nonce_action)) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

        if ( wp_is_post_autosave( $post_id ) ) {
			 return;
		}		 

		$get_multiple_package = $_POST['wpc-multiple-package'];		
		update_post_meta($post_id, 'wpc_multiple_package', $get_multiple_package);	
		
	}
	
	public function wpc_sh_metabox_callback($post){	
	
		global $wpdb;			
		wp_nonce_field( 'wpc_sh_meta_box', 'wpc_sh_meta_box_nonce' );		
		$shipments = maybe_unserialize( get_post_meta( $post->ID, 'wpcargo_shipments_update', true ) );
		$options                = get_option('wpcargo_settings');
		$get_field_key_settings = $options['settings_shipment_history_status'];
		if (function_exists('wpcargo_custom_fields_callback')) {
			$get_custom_fields      = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpcargo_custom_fields WHERE field_key ='$get_field_key_settings'");	
		}
		
		require_once( WPCARGO_PLUGIN_PATH.'admin/templates/shipment-history.tpl.php' );
		
	}
	
	public function wpcargo_sh_save_meta_box_data($post_id) {
		
        $nonce_name   = isset($_POST['wpc_sh_meta_box_nonce']) ? $_POST['wpc_sh_meta_box_nonce'] : '';
        $nonce_action = 'wpc_sh_meta_box';
		
		if (!isset($nonce_name)) {
			return;
		}
		if (!wp_verify_nonce($nonce_name, $nonce_action)) {
			return;
		}		
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}        
		if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
		
		// Make sure that it is set.
		$get_shipment_history = $_POST['shipment_history'];
		$update_shipment_status = $_POST['shipment_history'];
		
		if(!empty($update_shipment_status)) {
			//sort array by date
			$get_reverse_array 	= array_reverse($update_shipment_status);
			$sort_status 		= $get_reverse_array[0]['status'];
			
			if(!empty($sort_status)) {
				update_post_meta($post_id, 'wpcargo_status', $sort_status);
			}
		}		
		
		if( !empty( $get_shipment_history ) ){
			$get_shipment_history = serialize($get_shipment_history);
		}else{
			$get_shipment_history = array();
		}
		
		update_post_meta($post_id, 'wpcargo_shipments_update', $get_shipment_history);
		
	}	
	
	public function wpcargo_shipment_history_email_template($post_id){
		global $post_id;
		require_once( WPCARGO_PLUGIN_PATH.'admin/templates/email-notification.tpl.php' );
		do_action( 'wpc_add_sms_shipment_history', $post_id );
	}
	
	public function wpcargo_set_content_type( $content_type ) {
		return 'text/html';
	}

}

$wpcargo_metabox = new WPCargo_Metabox();
