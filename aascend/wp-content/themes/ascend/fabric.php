<?php
/**
 * Template Name: Fabric Template
 */
 
 if($_REQUEST['post_id'] !='')
 {
	$args = array( 'numberposts' => '1', 'post_type' => 'fabric',
				'post_status' => 'publish',
				 'post__in' => array($_REQUEST['post_id']),
				'suppress_filters' => true );
$post_new = new WP_Query( $args );
$post_count =0;

while($post_new->have_posts()):
$post_count++;

$post_new->the_post();	

$id = get_the_ID();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' ); 
    
    

	if( class_exists('Dynamic_Featured_Image') ) 
	{

		global $dynamic_featured_image;

		$featured_images = $dynamic_featured_image->get_featured_images( );

		//print_r($featured_images);

		foreach($featured_images as $featured_image) 
		{

			$fullSizedImage = $dynamic_featured_image->get_image_url($featured_image['attachment_id'], 'full');

		 
		}  
	 
	 } 


?>
		
		
			<div class="productRow exact_width_underline_left_align left_align_head clearfix" id="fabric-<?php echo get_the_ID();?>">
				<h3 class="grey exact_width head_three"><?php the_title();?></h3>
				

				<!-- product content -->
					<div class="productContentInner clearfix">
						<div class="proDuctImg">
							<div class="imgArea">
								<img src="<?php echo $image[0];?>" alt="#">
							</div>
						</div>
						<!-- product image -->
						<div class="productInfo">
							<div class="productFeatures full_width_underline">
								<h4 class="head_four left_align_head full_width grey">Features :</h4>

								<ul class="featuresLi">
									<?php
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
								<h4 class="head_four left_align_head full_width">Specifications :</h4>
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
				<!-- product content end -->
				<!-- product more description -->
					<?php the_content();?>
					
			</div>
			<!-- productRow 1 -->
			
			
<?php

endwhile;


	 exit();
	 
 }
 
get_header();
?>

<?php
while (have_posts()) : the_post();
echo $_REQUEST['q'];
?>
<!-- chamois slider -->
<section class="slider fabric">
	<div class="banner_header">
		<h1 class="head_one white">FABRICS</h1>
	</div>
</section>

<!-- chamois slider ends -->


<!-- Main content area -->
<div class="container contents fabric_container clearfix">
	 
	
	<!-- main sidebar -->
	<aside class="mainSidebar">
		<div class="asideContainer">	
			
			<section class="filterSection itsAccordion">
				<ul class="main_items">
		  <?php
			
			$args = array('orderby' => 'ID','order' => 'ASC','parent' => 0);
			$categories = get_categories( $args );
			foreach($categories as $category_par) 
			{ 
				if($category_par->name!='Uncategorized')
				{
					//echo $category->term_id."<br/>";?>
					<li><a data-val="<?php echo $category_par->name;?>" href="javascript:void(0)"><?php echo $category_par->name;?> <i class="fa fa-angle-down"></i></a>
					<ul class="sub_items">
					<?php
					$args = array('child_of' => $category_par->term_id);
					$categories = get_categories( $args );
					foreach($categories as $category) 
					{ ?>
						
						<li <?php if($_REQUEST['q'] == $category->name) echo "class='current_li'";?>><a data-val="<?php echo $category->name;?>"
						<?php if($_REQUEST['q'] == $category->name) echo "class='active'";?>
						 href="http://onlinedevserver.biz/dev/ascend/technology_fabric/?q=<?php echo $category->name;?>"><i class="square"></i> <?php echo $category->name;?> </a></li>
						
						
					<?php
					}
					?>
						</ul>
					</li>
						
				<?php
				}
				
			}
		  
		  ?>
		  
		  </ul>
			</section>
			<!-- filter top section -->
            
			<!-- filter bottom section -->
		</div>
		<!-- end aside container -->
	</aside>
	<!-- main sidebar ends -->
	<!-- content Section -->
	<section class="productContent">

	    <section id="page_header">
   <div class="container exact_width_underline_left_align clearfix">
      <div class="header_offset_from_left">
		  <?php if($_REQUEST['q'] !='') {?>
			  <h2 class="grey head_two exact_width left_align_head"><?php echo $_REQUEST['q']?> </h2>
		  <?php } else
		  
		  { //echo "here";?>	  
         <h2 class="grey head_two exact_width left_align_head">Moisture Wicking </h2>
         <?php } ?>
      </div> 
   </div>
</section>
		<!-- <h3 class="no_selection"></h3> -->
	   <!-- product row holder -->
	   <div id="show_loader"><img src="http://www.internet.ch/images/icons/icon_loading_animated2.gif"/></div>
		<!-- product row holder -->
		<div class="productRowHolder">
		
		<?php
		if($post !='')
		{
			$q= $_REQUEST['q'];
			$args = array(
				'numberposts' => -1,
				'offset' => 0,
				'category_name' => $q,
				'order' => 'ASC',
				'post_type' => 'fabric',
				'post_status' => 'publish',
				'suppress_filters' => true
			);
		}
		else
		{

			$args = array(
				'numberposts' => -1,
				'offset' => 0,
				'category' => 0,
				'order' => 'ASC',
				'post_type' => 'fabric',
				'post_status' => 'publish',
				'suppress_filters' => true
			);
	}
$post_new = new WP_Query( $args );
$post_count =0;

while($post_new->have_posts()):
$post_count++;

$post_new->the_post();	

$id = get_the_ID();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' ); 
    
    

	if( class_exists('Dynamic_Featured_Image') ) 
	{

		global $dynamic_featured_image;

		$featured_images = $dynamic_featured_image->get_featured_images( );

		//print_r($featured_images);

		foreach($featured_images as $featured_image) 
		{

			$fullSizedImage = $dynamic_featured_image->get_image_url($featured_image['attachment_id'], 'full');

		 
		}  
	 
	 } 


?>
		
		
			<div class="productRow exact_width_underline_left_align left_align_head clearfix" id="fabric-<?php echo get_the_ID();?>">
				<h3 class="grey exact_width head_three"><?php the_title();?></h3>
				<!---Rating Code Is Commented By Shourya Chowdhury As Per As The Client Requirement On 9-3-17-->
				<!-- rating -->
<!--
					<div class="ratingHolder">
						<div class="ratingArea">
							<ul>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
							</ul>							
						</div>
						<div class="ratingText">
							<span class="ratingPoint">
								0
							</span>
							<span>Comfort Rating</span>
						</div>
					</div>
-->
				<!-- ratin end -->

				<!-- product content -->
					<div class="productContentInner clearfix">
						<div class="proDuctImg">
							<div class="imgArea">
								<img src="<?php echo $image[0];?>" alt="#">
							</div>
						</div>
						<!-- product image -->
						<div class="productInfo">
							<div class="productFeatures full_width_underline">
								<h4 class="head_four left_align_head full_width grey">Features :</h4>

								<ul class="featuresLi">
									<?php
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
								<h4 class="head_four left_align_head full_width">Specifications :</h4>
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
				<!-- product content end -->
				<!-- product more description -->
					<div class="readMoreContent">
					<div class="productHeading">
						<span>Description : </span>
					</div>
						<?php the_content();?>
					</div>
					<div class="btnHolder">
										<a class="btn btn_readMore" href="javascript:void">Read More <i class="fa fa-angle-double-down" aria-hidden="true"></i>
						</a>
					</div>

			</div>
			<!-- productRow 1 -->
			
			
<?php

endwhile;

?>
<?php if($post_count ==0)
{?>
	<script>
		
		jQuery('.no_selection').text("No Fabric is match in this selection");
		</script>

<?php } ?>
	
		</div>
		<!-- product row holder ends -->
	</section>
	<!-- end content section -->
</div>

<!-- Footer Start -->
<?php
endwhile;
?>

<?php
get_footer();
?>
