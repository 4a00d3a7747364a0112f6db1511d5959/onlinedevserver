<?php
/*
 * Author: Shourya Chowdhury	
 * Description: The Construction Part in side the product page design
 * Version : 1.0
 * 
 * */
?>
<?php $productId=get_the_ID(); ?>
 <div class="readMoreContent product_time-line">
	 
	 <?php
        
        $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'construction',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$count =1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	 $bobc='con_'.$recent_posts['ID'];
	
	$com_name =  get_post_meta($productId,$bobc,true);
	
	 if($com_name !="Null Data")
	 {
		  $page = get_page_by_title($com_name, OBJECT, 'construction');
			$com_post_id = $page->ID;
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $com_post_id ), 'single-post-thumbnail' ); 
			
			$args = array(
				'numberposts' => -1,
				'offset' => 0,
				'order' => 'ASC',
				'post_type' => 'construction',
				'post_status' => 'publish',
				'post__in' => array($com_post_id),
				'suppress_filters' => true
			);
			$post_new = new WP_Query( $args );
			

			while($post_new->have_posts())
			{
				
				$post_new->the_post();
				?>
				<?php if($count%2 ==0) {?>
					<div class="row clearfix">
              <div class="right_content">
                <div class="img_outer_box">
                   <div class="img_inner_box getPopup" id="img_construction-<?php echo $com_post_id;?>">
                      <img src="<?php echo $image[0]?>" alt="#">
                   </div>
                </div>
              </div>
              <div class="left_content">
            
            <div class="productHeading full_width_underline"> 
             <h4 class="head_four left_align_head content_width_underline getPopup" id="construction-<?php echo $com_post_id;?>"><?php the_title()?></h4>
           </div>
            <p><?php the_content();?></p>
              </div>
          </div>   
					
					<?php } else {?>
						 <div class="row fabrics clearfix">
              <div class="left_content">
                <div class="productHeading full_width_underline"> 
                  <h4 class="head_four left_align_head content_width_underline getPopup" id="construction-<?php echo $com_post_id;?>"><?php the_title()?></h4>
                </div>
                <p><?php the_content();?></p>
            </div>
              <div class="right_content">
                <div class="img_outer_box">
                   <div class="img_inner_box getPopup" id="img_construction-<?php echo $com_post_id;?>">
                      <img src="<?php echo $image[0]?>" alt="#">
                   </div>
                </div>
              </div>
              
          </div>
					<?php } ?>	
         
            
          
     
 
 <?php     
 $count++;
 }
 wp_reset_postdata();//end while
  }// end if
}//end of foreach
?>
</div>
