<?php
/*
 * Author: Shourya Chowdhury	
 * Description: The Fabric Part in side the product page design
 * Version : 1.0
 * 
 * */
?>

<?php $productId = get_the_ID(); ?>
 <?php
        
        $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'Fabric',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	$bobc='fab_'.$recent_posts['ID'];
	$fab_name =  get_post_meta($productId,$bobc,true);
	
	 if($fab_name !="Null Data")
	 {
		 
			$page = get_page_by_title($fab_name, OBJECT, 'fabric');
			$fab_post_id = $page->ID;
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $fab_post_id ), 'single-post-thumbnail' ); 
			
			$args = array(
				'numberposts' => -1,
				'offset' => 0,
				'order' => 'ASC',
				'post_type' => 'fabric',
				'post_status' => 'publish',
				'post__in' => array($fab_post_id),
				'suppress_filters' => true
			);
			$post_new = new WP_Query( $args );
			$post_count =0;

			while($post_new->have_posts())
			{
				$post_new->the_post();	
			
		 
		 ?>
	 <div class="productRow exact_width_underline_left_align left_align_head clearfix">
        <div class="productContentInner clearfix">
          <div class="proDuctImg getPopup getPopupfab" id="img_fabric-<?php echo $fab_post_id;?>">
            <div class="imgArea"> <img src="<?php echo $image[0];?>" alt="#"> </div><!--Get The Featured Image -->
          </div>
          <!-- product image -->
          <div class="productInfo">
            <div class="productFeatures full_width_underline">
              <h4 class="head_four left_align_head full_width right_star_head getPopup getPopupfab" id="fabric-<?php echo $fab_post_id;?>"><?php the_title();?> 
<!--
               <span>
                 <ul>
                  <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                  <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                  <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                  <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                  <li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>
                 </ul>
               </span>
-->
              </h4>
              <ul class="featuresLi">
				<?php
				global $custom_mb;
				$meta = get_post_meta(get_the_ID(), $custom_mb->get_the_ID(), TRUE);

				foreach ($meta['docs']as $meat)
				{?>
				<li><a href="javascript:void(0)"><img src="<?php echo $meat['imgurl']?>" alt=""></a> <span><?php echo $meat['title']?></span> </li>

				<?php
				}
				?>
				 

              </ul>
            </div>
            <!-- product features -->
            <div class="productSpec full_width_underline">
              <h4 class="head_four left_align_head full_width">Specifications </h4>
              <ul>
                <?php $post_filed_custom =  get_post_custom_keys(get_the_ID()); 
				  
						foreach($post_filed_custom as $post_filed_custom_name)
						{
							//print_r($post_filed_custom_name);
							$post_meta = get_post_meta(get_the_ID(),$post_filed_custom_name,true);
							if($post_filed_custom_name !='_edit_last' && $post_filed_custom_name !='_edit_lock' && $post_filed_custom_name !='_custom_meta' && $post_filed_custom_name !='_thumbnail_id'&& $post_filed_custom_name !='dfiFeatured'&& $post_filed_custom_name !='_thumbnail_id'&& $post_filed_custom_name !='fabric_name_technology_fabric_name')
							{
								?>
								<li><?php echo $post_filed_custom_name;?><span><?php echo $post_meta;?></span></li>
								<?php
								}
						}
						?>
              </ul>
            </div>
          </div>
          <!-- product info --> 
        </div>
        <!-- product more description -->
        
        <!-- product content end -->
      </div>
      
      <!-- productRow 1 -->
	 <?php
		}
		wp_reset_postdata();//end while
	 
	 }// end if
	
}// end foreach
        
        ?>



