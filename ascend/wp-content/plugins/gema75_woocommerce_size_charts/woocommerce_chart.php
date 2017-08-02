<?php
/*
Plugin Name: Woocommerce Sizes Charts by Gema75
Plugin URI: http://codecanyon.net/user/Gema75
Description: A simple plugin woocommerce product size charts.
Version: 1.81
Author:  Gema75
Author URI: http://codecanyon.net/user/Gema75
*/


//check if woocommerce is active at all 
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {



add_action( 'init', 'gema75_wc_size_charts_register_cpt' );

function gema75_wc_size_charts_register_cpt() {

    $labels = array( 
        'name' => _x( 'Woocommerce Size Charts', 'gema75_wc_size_charts' ),
        'singular_name' => _x( 'WC Chart', 'gema75_wc_size_charts' ),
        'add_new' => _x( 'Add New', 'gema75_wc_size_charts' ),
        'add_new_item' => _x( 'Add New Size Chart', 'gema75_wc_size_charts' ),
        'edit_item' => _x( 'Edit Chart', 'gema75_wc_size_charts' ),
        'new_item' => _x( 'New Chart', 'gema75_wc_size_charts' ),
        'view_item' => _x( 'View Chart', 'gema75_wc_size_charts' ),
        'search_items' => _x( 'Search Charts', 'gema75_wc_size_charts' ),
        'not_found' => _x( 'No Charts found', 'gema75_wc_size_charts' ),
        'not_found_in_trash' => _x( 'No Charts found in Trash', 'gema75_wc_size_charts' ),
        
        'menu_name' => _x( 'WC Charts', 'gema75_wc_size_charts' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Add options to every product so you can add charts',
		'supports' => array( 'title','editor' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 65,
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => false,
        'can_export' => true,
        
         'register_meta_box_cb' => 'gema75_wc_size_chart_meta_box', // Callback function for custom metaboxes
    );

    register_post_type( 'gema75_wc_size_chart', $args );
}


//add our metaboxes to Charts CPT and Woocommerce products
add_action( 'add_meta_boxes', 'gema75_wc_size_chart_meta_box');
function gema75_wc_size_chart_meta_box() {
   
    //add color/text/padding/margin metabox to the Chart CPT
    add_meta_box('chart-cpt-meta-box', 'Chart Information', 'gema75_add_metabox_to_charts', 'gema75_wc_size_chart','normal','high');


    //remove "slug" metabox from Chart CPT
    remove_meta_box( 'slugdiv', 'gema75_wc_size_chart', 'normal' );

    //add metabox to woocommerce product 
     add_meta_box('chart-products-meta-box', 'Chart Information', 'gema75_charts_add_metabox_to_wc_products', 'product','side');
}



//REMOVE "VIEW Chart" LINK start

	//Hides the 'view' button in the post edit page
	function gema75_hide_chart_sizes_view_button() {
	 
		$current_screen = get_current_screen();
	 
		if( $current_screen->post_type === 'gema75_wc_size_chart' ) {
			echo '<style>#edit-slug-box{display: none;}</style>';
		}
		
		return;
	 
	}
	add_action( 'admin_head', 'gema75_hide_chart_sizes_view_button' );
	 
	//Removes the 'view' link in the admin bar
	function gema75_hide_chart_size_view_admin_bar() {
	 
		global $wp_admin_bar;
	 
		if( get_post_type() === 'gema75_wc_size_chart'){
	 
		$wp_admin_bar->remove_menu('view');
	 
		}
	 
	}
	add_action( 'wp_before_admin_bar_render', 'gema75_hide_chart_size_view_admin_bar' );
	 
	//Removes the 'view' button in the posts list page
	function gema75_remove_view_chart_row_action( $actions ) {
	 
		if( get_post_type() === 'gema75_wc_size_chart' )
			unset( $actions['view'] );
		return $actions;
	 
	}
	add_filter( 'post_row_actions', 'gema75_remove_view_chart_row_action', 10, 1 );

//REMOVE "VIEW CHART" LINK ends




//adds text/color/padding/margin metaboxes to the "chart" CPT
function gema75_add_metabox_to_charts(){

global $post;
 
   $actual_chart_meta = get_post_meta( $post->ID, 'gema75_single_chart_info',true);
  
   if(empty($actual_chart_meta)){
   		//Not an existing chart  ...no values to retreive ... lets create a default array 
   		$actual_chart_meta = array(
   				'chart_margin_top' => '9',
   				'chart_margin_left' => '8',
   				'charts_text_color' => '#336699',
   				'chart_popup_background_color' => '#000000',
   				'chart_padding_top' => '11',
   				'chart_padding_right' => '12',
   				'chart_padding_bottom' => '13',
   				'chart_padding_left' => '14',
   				'charts_tab_header_or_modal_link_text' => 'Show Chart',
   				'chart_radius_top_left' => '15',
   				'chart_radius_top_right' => '16',
   				'chart_radius_bottom_right' => '17',
   				'chart_radius_bottom_left' => '18',
				'chart_image' =>'',
				'popup_or_tab' =>'popup',
				
				//default chart table ... no values 
				'table' => array( array("Click the + on the top and right to add cols or rows"))

   			);
			

   }  //ends if empty chart meta
   

//enqueue color pickers scripts/style     
wp_enqueue_script('wp-color-picker');
wp_enqueue_style( 'wp-color-picker' );


   ?>
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {   
			
				//WP colorpicker
                $('#gema75_chart_text_color , #chart_popup_background_color').wpColorPicker({
                	color: true,
                });
				
				$('#gema75_chart_table_input').editTable({'isFrontend':false});
            
			});             
        </script>
        
    <form  action="" method="post">
    <div class="gema75_charts_structure_table">

		<!-- popup or product tab -->
        <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label >Show as</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                <select name="gema75_chart[popup_or_tab]"  id="gema75_chart_popup_or_tab">
					<option value="popup" <?php if($actual_chart_meta['popup_or_tab']=='popup'){echo ' selected="selected" ';}?> >Popup</option>
					<option value="tab"   <?php if($actual_chart_meta['popup_or_tab']=='tab'){echo ' selected="selected" ';}?>>Additional Tab</option>
				</select>
                <p class="description">Select if the chart will be added as a popup or as a product tab</p>
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div> 	
        
		
		
	   <!-- tab header or modal popup link text -->
	   <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label for="gema75_charts_text_color">Tab header/Link Text</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                <input name="gema75_chart[charts_tab_header_or_modal_link_text]" type="text" id="charts_tab_header_or_modal_link_text" value="<?php echo  $actual_chart_meta['charts_tab_header_or_modal_link_text']; ?>" >
                <p class="description">Text of the additional tab or modal popup link</p>
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div>

		
        <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label for="gema75_charts_text_color">Text Color</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                <input name="gema75_chart[charts_text_color]" type="text" id="gema75_chart_text_color" value="<?php echo  $actual_chart_meta['charts_text_color']; ?>" data-default-color="<?php echo  $actual_chart_meta['charts_text_color']; ?>">
                <p class="description">Select the text color of the chart</p>
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div>   
        
        <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label>Popup Overlay Color</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                <input name="gema75_chart[chart_popup_background_color]" type="text" id="chart_popup_background_color" value="<?php echo  $actual_chart_meta['chart_popup_background_color']; ?>" data-default-color="<?php echo  $actual_chart_meta['chart_popup_background_color']; ?>">
                <p class="description">Select the background color of the modal popup overlay</p>
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div>   

       <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label >Position</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                    
                        <ul>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_margin_top]" id="gema75_chart_margin_top" value="<?php echo  $actual_chart_meta['chart_margin_top']; ?>" class="text" type="text" size="2"><p class="description">Top </p></li>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_margin_left]"  id="gema75_chart_margin_left" value="<?php echo  $actual_chart_meta['chart_margin_left']; ?>" class="text" type="text" size="2"><p class="description">Left </p></li>

                        </ul>
                    
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div>   

        <div class="gema75_charts_structure_tr">
             <div class="titledesc gema75_charts_structure_td_left"><label >Paddings (pixels)</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                    
                        <ul>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_padding_top]" id="gema75_chart_padding_top" value="<?php echo  $actual_chart_meta['chart_padding_top']; ?>" class="text" type="text" size="2"><p class="description">Top </p></li>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_padding_bottom]" id="gema75_chart_padding_bottom" value="<?php echo  $actual_chart_meta['chart_padding_bottom']; ?>" class="text" type="text" size="2"><p class="description">Bottom </p></li>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_padding_left]" id="gema75_chart_padding_left" value="<?php echo  $actual_chart_meta['chart_padding_left']; ?>" class="text" type="text" size="2"><p class="description">Left </p></li>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_padding_right]" id="gema75_chart_padding_right" value="<?php echo  $actual_chart_meta['chart_padding_right']; ?>" class="text" type="text" size="2"><p class="description">Right </p></li>
                        </ul>
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div>

       <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label >Popup radius (pixels)</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
                    
                        <ul>
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_radius_top_left]" id="gema75_chart_radius_top_left" value="<?php echo  $actual_chart_meta['chart_radius_top_left']; ?>" class="text" type="text" size="2"><p class="description">Top-Left </p></li>
                            
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_radius_top_right]" id="gema75_chart_radius_top_right" value="<?php echo  $actual_chart_meta['chart_radius_top_right']; ?>" class="text" type="text" size="2"><p class="description">Top-Right </p></li>
                            
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_radius_bottom_left]" id="gema75_chart_radius_bottom_left" value="<?php echo  $actual_chart_meta['chart_radius_bottom_left']; ?>" class="text" type="text" size="2"><p class="description">Bottom-Right </p></li>
                            
                            <li style="float:left;margin-right:20px"><input name="gema75_chart[chart_radius_bottom_right]" id="gema75_chart_radius_bottom_right" value="<?php echo  $actual_chart_meta['chart_radius_bottom_right']; ?>" class="text" type="text" size="2"><p class="description">Bottom-Left </p></li>

                        </ul>
            </div>
			<div style="width:100%;height:1px;clear:both"></div>
        </div>

        <div class="gema75_charts_structure_tr">
             <div class="titledesc gema75_charts_structure_td_left"><label >Product categories</label></div>
             <div class="forminp gema75_charts_structure_td_right" >

				<?php
					$chart_belongs_to_wc_category =0;
					
					if(isset($actual_chart_meta['chart_belong_to_wc_category_id']) && is_numeric($actual_chart_meta['chart_belong_to_wc_category_id'])){
						$chart_belongs_to_wc_category = $actual_chart_meta['chart_belong_to_wc_category_id'];
					}
				?>
<?php
$args_woocommerce_categories = array(
  'orderby' => 'id',
  'order' => 'ASC',
  'taxonomy' => 'product_cat',
  'hide_empty' => '0',
  'hierarchical' => '1'
  );
	$gema75_charts_woocommerce_categories = get_categories($args_woocommerce_categories);
	
	if(!isset($gema75_charts_woocommerce_categories['errors'] )){
		if(count($gema75_charts_woocommerce_categories)>=1){
			foreach($gema75_charts_woocommerce_categories as $gema75_charts_woocommerce_category) { 
			
				$checked=' ';
			
				if(isset($actual_chart_meta['chart_belong_to_wc_category_id'])){
				if(in_array($gema75_charts_woocommerce_category->cat_ID,$actual_chart_meta['chart_belong_to_wc_category_id'])){
						$checked=' checked="checked" ';
					}
				}
				
				echo '<input type="checkbox"  ' . $checked . '  name="gema75_wc_product_categories_list[]" class="gema75_wc_product_categories" value="'.$gema75_charts_woocommerce_category->cat_ID.'"> '. $gema75_charts_woocommerce_category->cat_name .' <br>';
			
			} 
			echo '<p class="description">Select category if you want to show the chart only for products in a given category  </p>';
		}else{
			echo 'No product categories found';
		}
	}
?>
                
            </div>
        </div>
		<div style="width:100%;height:1px;clear:both"></div>
  </div>  
  

<!-- edittable start -->
       <div class="gema75_charts_structure_tr">
            <div class="titledesc gema75_charts_structure_td_left"><label for="gema75_charts_text_color">Chart Table</label></div>
            <div class="forminp gema75_charts_structure_td_right" >
               <textarea id="gema75_chart_table_input" style="display:none" name="gema75_chart[table]" col="40" rows="30"  ><?php 
			   
				$table_chart_values = json_encode($actual_chart_meta['table']);
			   
				//print_r($table_chart_values );
			   
				if(isset($table_chart_values) && count($table_chart_values)<=0 && $table_chart_values){
					echo "ska gjoooooooooo";
				}else{
					echo $table_chart_values;
				}
	
	?></textarea>   
            
                <p class="description">Edit the chart table above</p>
            </div>
          <div style="width:100%;height:1px;clear:both"></div> 
        </div>            
    <!-- edittable ends -->

	<!-- nonce to prevent CPT meta data deleted when moved to trash -->
	<input type="hidden" name="prevent_delete_meta_movetotrash" id="prevent_delete_meta_movetotrash" value="<?php echo wp_create_nonce(plugin_basename(__FILE__).$post->ID); ?>" />
	
    </form>             
        
        
    <?php

} // ENDS gema75_add_metabox_to_charts



function gema75_charts_add_metabox_to_wc_products() {

    $post_id = get_the_ID();

    $gema75_product_chart_data = get_post_meta( $post_id, 'gema75_product_chart',true );
	
    $gema75_product_chart_id = ( empty( $gema75_product_chart_data['id'] ) ) ? '' : $gema75_product_chart_data['id'];

    ?>
   
    <p> <label>Select which chart to apply</label><br />
       
	<select name="gema75_product_chart[id]" >
	
	<option>Select chart to apply</option>
	
	<?php
	//get all charts and make a dropdown on the product page   
	$args_get_chart = array(
		'post_type' => 'gema75_wc_size_chart',
		'posts_per_page' => '-1',
	 );
	
	$gema75_charts_lists = get_posts( $args_get_chart );
	
	wp_reset_query() ;
	
	foreach ($gema75_charts_lists as $gema75_chart) {

		if($gema75_chart->ID == $gema75_product_chart_id){
			$selected= 'selected="selected"';
		}else{
			$selected='';
		}
		echo '<option value="'.$gema75_chart->ID.'"   '.$selected.'  >'.$gema75_chart->post_title.'</option>';
	}

	?>
 </select> 

    </p>

    <?php
} // gema75_charts_add_metabox_to_wc_products  ENDS

//set post meta ( chart id )  to woocommerce product
add_action( 'save_post', 'gema75_wc_charts_product_save_post' );
function gema75_wc_charts_product_save_post( $post_id ) {


	
	//CHART IS FOR SINGLE PRODUCT
    if ( !empty( $_POST['gema75_product_chart'] ) ) {
       
        $gema75_product_chart_data['id'] = ( empty( $_POST['gema75_product_chart']['id'] ) ) ? '' : sanitize_text_field( $_POST['gema75_product_chart']['id'] );
 
        update_post_meta( $post_id, 'gema75_product_chart', $gema75_product_chart_data );
    
	} else {
    
		delete_post_meta( $post_id, 'gema75_product_chart' );

    }

}

//save settings for a single "chart" CPT
add_action( 'save_post', 'gema75_chart_save_post' );
function gema75_chart_save_post( $post_id ) {


  global $post;
 
	  if (! isset( $_POST['prevent_delete_meta_movetotrash']) || !wp_verify_nonce($_POST['prevent_delete_meta_movetotrash'], plugin_basename(__FILE__).$post->ID)) {
		return $post_id; 
	  }


  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }
  if(defined('DOING_AJAX')) {
    return;
  }

	//get old chart meta
	$old_meta = get_post_meta( $post_id, 'gema75_single_chart_info', true );
 
    if ( !empty($_POST['gema75_chart']['chart_popup_background_color'])  ) {  
	
		//save chart table 
		$gema75_single_chart_info['table'] = json_decode(stripslashes($_POST['gema75_chart']['table']));
		$gema75_single_chart_info['chart_id'] = $post_id;
		
		//save chart mode ... popup or additional tab
		$gema75_single_chart_info['popup_or_tab']= ( empty( $_POST['gema75_chart']['popup_or_tab'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['popup_or_tab'] );
      
        //save bg color , text color , chart text
        $gema75_single_chart_info['chart_popup_background_color']= ( empty( $_POST['gema75_chart']['chart_popup_background_color'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_popup_background_color'] );
        $gema75_single_chart_info['charts_text_color']= ( empty( $_POST['gema75_chart']['charts_text_color'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['charts_text_color'] );
        $gema75_single_chart_info['charts_tab_header_or_modal_link_text']= ( empty( $_POST['gema75_chart']['charts_tab_header_or_modal_link_text'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['charts_tab_header_or_modal_link_text'] );
      
 
        
        $gema75_single_chart_info['chart_margin_top']= ( empty( $_POST['gema75_chart']['chart_margin_top'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_margin_top'] );
        $gema75_single_chart_info['chart_margin_left']= ( empty( $_POST['gema75_chart']['chart_margin_left'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_margin_left'] );

        //save padding
        $gema75_single_chart_info['chart_padding_top']= ( empty( $_POST['gema75_chart']['chart_padding_top'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_padding_top'] );
        $gema75_single_chart_info['chart_padding_bottom']= ( empty( $_POST['gema75_chart']['chart_padding_bottom'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_padding_bottom'] );
        $gema75_single_chart_info['chart_padding_left']= ( empty( $_POST['gema75_chart']['chart_padding_left'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_padding_left'] );
        $gema75_single_chart_info['chart_padding_right']= ( empty( $_POST['gema75_chart']['chart_padding_right'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_padding_right'] );

        //save border radius
        $gema75_single_chart_info['chart_radius_top_left']= ( empty( $_POST['gema75_chart']['chart_radius_top_left'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_radius_top_left'] );
        $gema75_single_chart_info['chart_radius_top_right']= ( empty( $_POST['gema75_chart']['chart_radius_top_right'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_radius_top_right'] );
        $gema75_single_chart_info['chart_radius_bottom_left']= ( empty( $_POST['gema75_chart']['chart_radius_bottom_left'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_radius_bottom_left'] );
        $gema75_single_chart_info['chart_radius_bottom_right']= ( empty( $_POST['gema75_chart']['chart_radius_bottom_right'] ) ) ? '' : sanitize_text_field( $_POST['gema75_chart']['chart_radius_bottom_right'] );


	
		
		//chart is for one ore more WooCommerce category ... update category meta	
		if(!empty($_POST['gema75_wc_product_categories_list']) && is_array($_POST['gema75_wc_product_categories_list'])){
			
			foreach($_POST['gema75_wc_product_categories_list'] as $gema75_wc_product_categories_list_key => $gema75_wc_product_categories_list_value){
//					echo $gema75_wc_product_categories_list_value;
			
					$category_id_to_assign_chart_to = $gema75_wc_product_categories_list_value;
					
					
					//delete OLD option
					if(isset($old_meta['chart_belong_to_wc_category_id'])){
						foreach($old_meta['chart_belong_to_wc_category_id'] as $old_meta_chartBelongsToWcCategory_key =>$old_meta_chartBelongsToWcCategory_value ){
						
							delete_option('gema75_wc_cat_id_'.$old_meta_chartBelongsToWcCategory_value.'_chart_id_'.$post_id );

						}
					}
					
					//set option 
					//key : concatenating the WC product ID with chartID 
					//		example  if product id=23 AND chartID = 10  THEN  key = gema75_wc_cat_id_23_chart_id_10
					//value : chart ID
					
					update_option('gema75_wc_cat_id_'.$category_id_to_assign_chart_to.'_chart_id_'.$post_id,$post_id);

					//save the category the chart belongs to also on the chart meta itself as an array
					$gema75_single_chart_info['chart_belong_to_wc_category_id'][]= $category_id_to_assign_chart_to ;
			}
		}else{
			//remove  option (gema75_wc_cat_id_23_chart_id_10)
			if(isset($old_meta['chart_belong_to_wc_category_id'])){
				foreach($old_meta['chart_belong_to_wc_category_id'] as $old_meta_chartBelongsToWcCategory_key =>$old_meta_chartBelongsToWcCategory_value ){
				
					delete_option('gema75_wc_cat_id_'.$old_meta_chartBelongsToWcCategory_value.'_chart_id_'.$post_id );

				}
			}
			unset($gema75_single_chart_info['chart_belong_to_wc_category_id']);
		}

		//update CHART CPT 
		update_post_meta( $post_id, 'gema75_single_chart_info', $gema75_single_chart_info );
        
    } else {
		if(isset($old_meta['chart_belong_to_wc_category_id'])){
		foreach($old_meta['chart_belong_to_wc_category_id'] as $old_meta_chartBelongsToWcCategory_key =>$old_meta_chartBelongsToWcCategory_value ){
			//remove  option (gema75_wc_cat_id_23_chart_id_10)
			@delete_option('gema75_wc_cat_id_'.$old_meta_chartBelongsToWcCategory_value.'_chart_id_'.$post_id );
		}
		}
		//remove CHART CPT METAs
        delete_post_meta( $post_id, 'gema75_single_chart_info' );
    }
	
	
} //ENDS  gema75_chart_save_post






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND FRONTEND 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//hook to add our chart on frontend                                             
add_action( 'woocommerce_single_product_summary', 'gema75_show_product_loop_new_chart' ,80); 

// Display the new chart
function gema75_show_product_loop_new_chart() {
 global $post ,$product ,$woocommerce;

 echo '<!-- starting charts -->' ; 
 
 

 
 //Check if product belongs to a category that has a chart assigned ... START

//if product belongs to many categories the category with the highest ID will be used
$get_product_categories = get_the_terms($post->ID, 'product_cat' );

if($get_product_categories ){

	foreach ($get_product_categories as $single_category) {
		$product_cat_id['id']= $single_category->term_id;
		
		
	}
}



//get all chart that belongs to this WC product`s category
$args_get_charts_for_category_args = array(
	'post_type' => 'gema75_wc_size_chart',
	'posts_per_page' => '-1',
	'posts_status' => 'publish',
	'orderby'=>'ID',
	'order'=>'ASC'
   );
$gema75_category_chart_array = get_posts( $args_get_charts_for_category_args );



//wp_reset_query() ;

foreach ($gema75_category_chart_array as $gema75_category_chart_single) {

	$get_chart_options_array = get_post_meta($gema75_category_chart_single->ID , 'gema75_single_chart_info',true);
	
	if(isset($get_chart_options_array['chart_belong_to_wc_category_id']) ){
		
		//Found a chart assigned to this WC product`s category
		$category_chart['chart_id_'.$gema75_category_chart_single->ID] = array( 'chart_id' => $gema75_category_chart_single->ID,
								   'chart_belongs_to_wc_category_id' => $get_chart_options_array['chart_belong_to_wc_category_id'],
								   'chart_content' => $get_chart_options_array
								 );

	}


}

//Check if product belongs to a category that has a chart assigned ... ENDS


//check if product has a own chart (meta) assigned  
//and if chart itself exists (try to read the meta by the chart ID)
//...apply the own chart
$has_own_chart_assigned =  get_post_meta( $post->ID, 'gema75_product_chart',true);


if(isset($has_own_chart_assigned['id'] ) &&  is_numeric($has_own_chart_assigned['id'] ) && (get_post_meta( $has_own_chart_assigned['id'] , 'gema75_single_chart_info') ) ){

	echo '<!-- own chart -->' ; 

	//check if chart is published or not
	if(get_post_status($has_own_chart_assigned['id'])=='publish'){
		
		$gema75_chart_meta = get_post_meta( $has_own_chart_assigned['id'], 'gema75_single_chart_info', true );
	}

}else{
	//no own chart ... try to apply the product`s category chart 
	if(isset($category_chart)){
	
		
		foreach($category_chart as $category_chart_single){

			
				if(isset($product_cat_id)){
			
					if(in_array($product_cat_id['id'],$category_chart_single['chart_content']['chart_belong_to_wc_category_id'])){
						echo '<!-- category chart -->' ; 
						$gema75_chart_meta = $category_chart_single['chart_content'];
					}
				
				}

			}

		
		
	}
}



//if user has chosed to show the chart as a new product tab
if(isset($gema75_chart_meta['popup_or_tab'])){
	if($gema75_chart_meta['popup_or_tab']=='tab'){
		gema75_chart_show_chart_as_tab($gema75_chart_meta['chart_id']);
	}
}



       if(isset($gema75_chart_meta['charts_tab_header_or_modal_link_text']) ){ ?>

				<?php 
				//show modal popup link if chart mode is "popup"
				if($gema75_chart_meta['popup_or_tab']=='popup'){ ?> 
					<a href="#" id="popupbpopup"><?php echo $gema75_chart_meta['charts_tab_header_or_modal_link_text']; ?></a> 
				<?php } ?>
				
				
				<style type="text/css">
						
					.gema75_wc_chart_table{
						color: <?php echo $gema75_chart_meta['charts_text_color']; ?>;
					}
				
				</style>

				<div class="gema75_chart_table_container">
				
					<?php 
						$GLOBALS['gema75_chart_id'] = $gema75_chart_meta['chart_id'];
						$chart_content = get_post($gema75_chart_meta['chart_id']); 
						echo apply_filters('the_content',$chart_content->post_content);
					?>
				
					<div id="gema75_chart_table_input" class="gema75_wc_chart_table"></div>

				</div>
				
				
				<?php
				
				
				
				function replace_unicode_escape_sequence($match) {
					return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
				}
				$str = preg_replace_callback('/u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence',stripslashes(json_encode($gema75_chart_meta['table'])));
				
				?>
				
				 <script type="text/javascript">
					jQuery(document).ready(function($) {   
						
					 var tabela_produktit =  $('.gema75_wc_chart_table').editTable({'isFrontend':true});
					 tabela_produktit.loadJsonData('<?php echo $str  ;?>');
					 
					 //bpopup modal popup
					 $('#popupbpopup').click(function(){
						  $('.gema75_chart_table_container').bPopup({
							modalColor : '<?php echo $gema75_chart_meta['chart_popup_background_color']; ?>',
						  });
						  return false;
					 });
					 
					});             
				</script>

					<style  type="text/css">

					.gema75_chart_table_input{
						
						z-index: 10;
						color:   <?php echo $gema75_chart_meta['charts_text_color']; ?> ;
						padding: <?php echo $gema75_chart_meta['chart_padding_top']; ?>px <?php echo $gema75_chart_meta['chart_padding_right']; ?>px <?php echo $gema75_chart_meta['chart_padding_bottom']; ?>px <?php echo $gema75_chart_meta['chart_padding_right']; ?>px  !important;
						
						 -webkit-border-top-left-radius: <?php echo $gema75_chart_meta['chart_radius_top_left']; ?>px !important;
						-webkit-border-top-right-radius:  <?php echo $gema75_chart_meta['chart_radius_top_right']; ?>px !important;
						-webkit-border-bottom-right-radius: <?php echo $gema75_chart_meta['chart_radius_bottom_right']; ?>px !important;
						-webkit-border-bottom-left-radius: <?php echo $gema75_chart_meta['chart_radius_bottom_left']; ?>px !important;
						
						-moz-border-radius-topleft:  <?php echo $gema75_chart_meta['chart_radius_top_left']; ?>px !important;
						-moz-border-radius-topright:  <?php echo $gema75_chart_meta['chart_radius_top_right']; ?>px !important;
						-moz-border-radius-bottomright:  <?php echo $gema75_chart_meta['chart_radius_bottom_right']; ?>px !important;
						-moz-border-radius-bottomleft: <?php echo $gema75_chart_meta['chart_radius_bottom_left']; ?>px !important;
						
						border-top-left-radius:  <?php echo $gema75_chart_meta['chart_radius_top_left']; ?>px !important;
						border-top-right-radius:  <?php echo $gema75_chart_meta['chart_radius_top_right']; ?>px !important;
						border-bottom-right-radius:  <?php echo $gema75_chart_meta['chart_radius_bottom_right']; ?>px !important;
						border-bottom-left-radius: <?php echo $gema75_chart_meta['chart_radius_bottom_left']; ?>px !important;

					}
				
				</style>


            <?php 
            } //ENDS if($gema75_chart_meta['charts_tab_header_or_modal_link_text'])
	
 echo '<!-- charts end -->' ; 				
				
}  //ends gema75_show_product_loop_new_chart()





//Enqueue admin scripts
add_action('admin_print_scripts-post.php', 'gema75_chart_image_admin_scripts');
add_action('admin_print_scripts-post-new.php', 'gema75_chart_image_admin_scripts');

function gema75_chart_image_admin_scripts() {
   
	wp_enqueue_script( 'jquery-edittable-script-admin',plugins_url( 'gema75_woocommerce_size_charts/js/jquery.edittable.js' ),array( 'jquery'), '1.0.0', true );

}

//Enqueue admin styles
add_action('admin_print_styles-post.php', 'gema75_chart_image_admin_styles');
add_action('admin_print_styles-post-new.php', 'gema75_chart_image_admin_styles');

function gema75_chart_image_admin_styles() {
	wp_enqueue_style( 'editable-css-admin', plugins_url( 'gema75_woocommerce_size_charts/css/jquery.edittable.css' ) );
	wp_enqueue_style( 'editable-plugin-options-admin', plugins_url( 'gema75_woocommerce_size_charts/css/plugin_admin.css' ) );
}



//Enqueue frontend scripts/css
add_action( 'wp_enqueue_scripts', 'gema75_chart_load_css_scripts' );
function gema75_chart_load_css_scripts() {

	//editable plugin 
	wp_enqueue_style( 'editable-css', plugins_url( 'gema75_woocommerce_size_charts/css/jquery.edittable.css' ) );
	wp_enqueue_style( 'plugin-frontend-css', plugins_url( 'gema75_woocommerce_size_charts/css/plugin_frontend.css' ) );
	wp_enqueue_script( 'jquery-edittable-script',plugins_url( 'gema75_woocommerce_size_charts/js/jquery.edittable.js' ),array( 'jquery'), '1.0.0', true );

	//modal popup 
	wp_enqueue_script( 'jquery-bpopup-script',plugins_url( 'gema75_woocommerce_size_charts/js/jquery.bpopup.min.js' ),array( 'jquery'), '1.0.0', true );
	
}


//add the chart as a new product tab if user chosed to do so 
function gema75_chart_show_chart_as_tab($chart_id){

	add_filter( 'woocommerce_product_tabs',  'gema75_chart_add_product_tab');
}

function gema75_chart_add_product_tab($tabs) {

	if(isset($GLOBALS['gema75_chart_id'])){

		$chart_id = $GLOBALS['gema75_chart_id'];
		
		$chart_post_content = get_post($chart_id);
		
		//get chart data
		$chart_data = get_post_meta($chart_id,'gema75_single_chart_info',true);
		
		$chart_data_table = stripslashes(json_encode($chart_data['table']));
		
		$tab_title = $chart_data['charts_tab_header_or_modal_link_text'];
		
		$chart_content = apply_filters('the_content',$chart_post_content->post_content) ;
		
		//append our chart table
		$chart_content.= '<div class="gema75_wc_chart_table"></div>';
		
		//unset the global
		unset($GLOBALS['gema75_chart_id']);
		
	}else{
		$chart_content ='';
	}

	global $product;
			$tabs['25'] = array(
				'title'    =>  $tab_title,
				'priority' => 90,
				'callback' => 'gema75_product_tabs_panel_content',
				'content'  => $chart_content
			);


	return $tabs;
}

function gema75_product_tabs_panel_content( $key, $tab ) {

	echo $tab['content'];
}



}	//end check if woocommerce is active at all
else{
	//Show notice "woocommerce is not active"
	add_action( 'admin_notices', 'gema75_charts_wc_not_active' );
	function gema75_charts_wc_not_active(){
		echo '<div class="updated"><p>Woocommerce is not activated. Chart Size plugin will not show on the menus till Woocommerce is activated</p></div>';
	}
	

}
 