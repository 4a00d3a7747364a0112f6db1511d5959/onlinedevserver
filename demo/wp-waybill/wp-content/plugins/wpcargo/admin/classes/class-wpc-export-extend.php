<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once( WPCARGO_PLUGIN_PATH.'admin/classes/class-wpc-export.php');
class WPC_Export_Admin extends WPC_Export{
	protected $post_type 		= 'wpcargo_shipment';
	protected $post_taxonomy 	= 'wpcargo_shipment_cat';
	function __construct(){
		add_action('admin_menu', array($this,'wpc_import_export_submenu_page') );
		add_action( 'wp_ajax_update_import_option_ajax_request',  array($this,'update_import_option_ajax_request') );
		add_action( 'wp_ajax_search_shipper',  array($this,'wpc_import_export_search_shipper') );
	}
	function wpc_import_export_submenu_page() {
		//** Import Submenu
		add_submenu_page(
			'edit.php?post_type=wpcargo_shipment',
			'Reports',
			'Reports',
			'manage_options',
			'wpc-report-export',
			array($this,'wpc_import_export_submenu_page_callback') );
		//** Exmport Submenu
		add_submenu_page(
			NULL,
			'Shipment Reports',
			'Shipment Reports',
			'manage_options',
			'wpc-ie-import',
			array($this,'wpc_import_export_submenu_page_callback') );
	}
	function wpc_import_export_submenu_page_callback() {
		global $wpdb;
		$table_name = $wpdb->prefix.'wpcargo_custom_fields';
		$field_selection = array();
		$wpcargo_meta_data = array(
			'wpcargo_shipper_name',
			'wpcargo_shipper_phone',
			'wpcargo_shipper_address',
			'wpcargo_shipper_email',
			'wpcargo_receiver_name',
			'wpcargo_receiver_phone',
			'wpcargo_receiver_address',
			'wpcargo_receiver_email',
			'agent_fields',
			'wpcargo_type_of_shipment',
			'wpcargo_courier',
			'wpcargo_mode_field',
			'wpcargo_qty',
			'wpcargo_total_freight',
			'wpcargo_carrier_ref_number',
			'wpcargo_origin_field',
			'wpcargo_pickup_date_picker',
			'wpcargo_status',
			'wpcargo_comments',
			'wpcargo_weight',
			'wpcargo_packages',
			'wpcargo_product',
			'payment_wpcargo_mode_field',
			'wpcargo_carrier_field',
			'wpcargo_departure_time_picker',
			'wpcargo_destination',
			'wpcargo_pickup_time_picker',
			'wpcargo_expected_delivery_date_picker',
		);
		
		$wpc_default_fields = $wpdb->get_results("SELECT tbl2.meta_key  FROM `{$wpdb->prefix}posts` AS tbl1 INNER JOIN `{$wpdb->prefix}postmeta` AS tbl2 ON tbl1.ID = tbl2.post_id WHERE tbl1.post_type='wpcargo_shipment' AND tbl2.meta_value != '' GROUP BY tbl2.meta_key");
		if( !empty( $wpc_default_fields ) ){
			foreach( $wpc_default_fields as $field_key ){
				if ( !in_array( $field_key->meta_key , $wpcargo_meta_data ) ) continue;
				$field_selection[] = $field_key->meta_key;
			}
		}
		if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name ) {
			$wpc_get_fields = $wpdb->get_results("SELECT `field_key` FROM `{$wpdb->prefix}wpcargo_custom_fields`");
			if( !empty( $wpc_get_fields ) ){
				foreach( $wpc_get_fields as $field_key ){
					if ( in_array( $field_key->field_key , $wpcargo_meta_data ) ) continue;
					$field_selection[] = $field_key->field_key;
				}
			}
		}

		$page = $_GET['page'];
		$tax_args       = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'taxonomy' => $this->post_taxonomy,
			'hide_empty' => 0
		);
		$cat_taxonomy = get_categories($tax_args);		
		ob_start();
		?>
		<div class="wrap"><div id="icon-tools" class="icon32"></div>
			<h2>Shipment Import/ Export</h2>
            <?php $this->wpc_ie_header_tab();  ?>
            <div id="form-block">
            	<?php
					if( $page == 'wpc-report-export' ){
						$this->wpc_export_form( $field_selection, $cat_taxonomy, $page);
					}
				?>
            </div>
		</div>
        <?php
		echo ob_get_clean();
	}
	function update_import_option_ajax_request() {
		// The $_REQUEST contains all the data sent via ajax
		if ( isset($_REQUEST) ) {
			update_option('multiselect_settings', $_REQUEST['multiselect_settings'], true);
		}
		// Always die in functions echoing ajax content
	   die();
	}
	function wpc_export_form( $fields = array(), $taxonomy = array(), $page ='') {
		add_action( 'wp_ajax_update_import_option_ajax_request',  'update_import_option_ajax_request' );
		?>
        <form id="wpc-ie-form" method="POST" action="<?php echo admin_url(); ?>edit.php?post_type=wpcargo_shipment&page=wpc-report-export" >
			<?php wp_nonce_field( 'wpc_import_ie_results_callback', 'wpc_ie_nonce' ); ?>
            <p><strong>Shipper Name : </strong><input id="search-shipper" type="text" name="search-shipper" value="<?php echo isset($_REQUEST['search-shipper']) ? $_REQUEST['search-shipper'] : '';  ?>" /></p>
            <p><strong>Date Range : </strong></p>
            <p id="import-datepicker"><label for="date-from" ><?php _e('Form : ','wpcargo'); ?></label>
			<input class="import-datepicker" type="text" id="wpcargo-import-form" name="date-from" value="<?php echo isset($_REQUEST['date-from']) ? $_REQUEST['date-from'] : ''; ?>" required />
            <label for="date-to"><?php _e('To : ','wpcargo'); ?></label>
			<input class="import-datepicker" type="text" id="wpcargo-import-to" name="date-to" value="<?php echo isset($_REQUEST['date-to']) ? $_REQUEST['date-to'] : ''; ?>" required />
			</p>
			<p>
			<strong>Status: </strong> 
			<select name="wpcargo_status" class="wpc-status">
				<?php
				$option_settings = get_option( 'wpcargo_option_settings' );
				if(!empty($option_settings)) {
					echo '<option value="">-- Choose Status --</option>';
					$settings_shipment_status = $option_settings['settings_shipment_status'];
					$explode_status = explode(",", $settings_shipment_status);	
					$trimmed_status=array_map('trim',$explode_status);		
					if(is_array($trimmed_status)){
						
						foreach($trimmed_status as $status){
							$get_selected_value = isset($_REQUEST['wpcargo_status']) && $_REQUEST['wpcargo_status'] == $status ? 'selected' : '';
							echo '<option value="'.$status.'" '.$get_selected_value.'>'.$status.'</option>';
						}
					}
				}
				?>
			</select>
			</p>
			<script>
				jQuery(document).ready(function($) {
					$( "#import-datepicker #wpcargo-import-form" ).datepicker();
					$( "#import-datepicker #wpcargo-import-to" ).datepicker();
				});
			</script>
            <div id="wpc-import-export-checklist">
            <p><strong>Filter by Taxonomy : </strong></p>
            	<ul id="categorychecklist" class="categorychecklist" >
                	<?php
                        wp_terms_checklist( 0, array( 'taxonomy' => $this->post_taxonomy ) );
                    ?>
                </ul>
            </div>
            <div id="multi-select-export">
                <p><strong>Select Option</strong></p>
                <div class="row">
                    <div class="col-xs-5">
                        <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                            <?php
							sort($fields);
                            if($fields) {
                                foreach( $fields as $field ){
                                    ?><option value="<?php echo $field; ?>"><?php echo $field; ?></option><?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" id="multiselect_rightAll" class="btn btn-block"><span class="dashicons dashicons-controls-skipforward"></span></button>
                        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><span class="dashicons dashicons-controls-forward"></span></button>
                        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><span class="dashicons dashicons-controls-back"></span></button>
                        <button type="button" id="multiselect_leftAll" class="btn btn-block"><span class="dashicons dashicons-controls-skipback"></span></button>
                    </div>
                    <div class="col-xs-5">
                        <select name="meta-fields[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
                            <?php 
                                $options = get_option( 'multiselect_settings' );
                                if($options) {
                                    foreach ($options as $option) {
                                    echo "<option value=\"$option\">$option</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
			<div style="clear:both;"></div>
            <input type="hidden" name="post_type" value="wpcargo_shipment" />
            <input type="hidden" name="page" value="<?php echo $page; ?>" />
            <p><input style="margin-top: 24px;" class="button button-primary button-large" type="submit" name="submit" value="Export Shipment" /></p>
        </form>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
		$('#multiselect').multiselect({
			sort: false,
			autoSort: false,
			autoSortAvailable: false,
		});	
		$("#multiselect_to, #multiselect").on('change',function() {		
			setTimeout(function(){			
				var selectoptions= [];				
						$.each($("#multiselect_to option"), function() {				
						selectoptions.push($(this).attr("value"));				
				});
				jQuery.ajax({				
					url : 'admin-ajax.php',				
					type : 'post',				
					data : {				
						action : 'update_import_option_ajax_request',				
						multiselect_settings: selectoptions				
					},				
					success : function( response ) {				
						//alert(response)				
					}				
				});				
			}, 1000);		
		});  
		});
		</script>
	    <?php
	}
	
	
	function wpc_import_export_search_shipper(){
		global $wpdb, $post;
		// Handle request then generate response using WP_Ajax_Response
		$term = $_GET['term'];
		$wpc_get_fields = $wpdb->get_results("SELECT tbl2.meta_value AS meta_value FROM `$wpdb->posts` AS tbl1 INNER JOIN `$wpdb->postmeta` AS tbl2 ON tbl1.ID = tbl2.post_id WHERE tbl1.post_type LIKE 'wpcargo_shipment' AND tbl2.meta_key LIKE 'wpcargo_shipper_name' AND tbl2.meta_value LIKE '%".$term."%' GROup BY meta_value");
		if( !empty($wpc_get_fields) ){
			foreach( $wpc_get_fields as $shipper ){
				$suggestions[] = array(
					'label'	=> $shipper->meta_value,
				);
			}
		}
		$response = wp_send_json( $suggestions );
		echo $response;
		die();
	}
	
	
	function wpc_ie_header_tab(){
		$view = $_GET['page'];
		?>
		<div class="wpc-ie-tab">
			<h2 class="nav-tab-wrapper">
            <a href="<?php echo admin_url( 'edit.php?post_type=wpcargo_shipment&page=wpc-report-export' );?>" class="nav-tab<?php if($view == 'wpc-report-export') { ?> nav-tab-active<?php } ?>">Shipment Reports</a>			
			</h2>
		</div>
		<?php
		if( $view == 'wpc-report-export' ){
			$this->wpc_export_request( );
		}
	}
}
$wpc_export_admin = new WPC_Export_Admin();

