<?php 
       //~ global $gema75_chart_meta;
        //~ $has_own_chart_assigned =  get_post_meta( $post->ID, 'gema75_product_chart',true);
        //~ if(isset($has_own_chart_assigned['id'] ) &&  is_numeric($has_own_chart_assigned['id'] ) && (get_post_meta( $has_own_chart_assigned['id'] , 'gema75_single_chart_info') ) )
       //~ {
		   //~ echo $gema75_chart_meta = get_post_meta( $has_own_chart_assigned['id'], 'gema75_single_chart_info', true );
	   //~ }
        
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
					jQuery(document).ready(function() {   
						
					 var tabela_produktit =  jQuery('.gema75_wc_chart_table').editTable({'isFrontend':true});
					 tabela_produktit.loadJsonData('<?php echo $str  ;?>');
					 
					 //bpopup modal popup
					 jQuery('#popupbpopup').click(function(){
						  jQuery('.gema75_chart_table_container').bPopup({
							modalColor : '<?php echo $gema75_chart_meta['chart_popup_background_color']; ?>',
						  });
						  return false;
					 });
					 
					 jQuery('#popupbpopup1').click(function(){
						  jQuery('.gema75_chart_table_container').bPopup({
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
            }
		
        
        ?>
