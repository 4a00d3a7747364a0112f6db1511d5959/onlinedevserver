<?php
/**
 * Template Name: Home Page
 */
get_header();
?>

<section id="about-box" class="about-div">
 <div class="container clearfix">
  <div class="home-about-box">
   <div class="home-about-col-1">
     <h3>  <?php echo get_option('webq_es_srv');?> </h3>
     <p><?php echo get_option('webq_es_srv_des');?></p>
   </div>
   <div class="home-about-col-2">
     <h3>  <?php echo get_option('webq_es_srv2');?> </h3>
     <p><?php echo get_option('webq_es_srv_des2');?></p>
   </div>
   <div class="home-about-col-3">
     <h3>  <?php echo get_option('webq_es_srv3');?> </h3>
     <p><?php echo get_option('webq_es_srv_des3');?></p>
   </div>
 </div>
  <div class="about-box-divider"><span> </span></div>
 </div> 
</section>
<!--Mate of the year and mate of the month section-->
<section id="home-model" class="home-model-div">
	<?php
		$login=0;
		if ( is_user_logged_in() ) 
		{
			$login =1;
		} 
		else 
		{

		}
	
	?>
	
 <div class="container">
	 <div class="home-model-box clearfix">
	 <?php
	 $brand_name = "mate-of-the-month";
	 $original_query = $wp_query;
$wp_query = null;
$args=array('posts_per_page'=>1,'post_type' => 'casting_members', 'tag' => $brand_name);
$wp_query = new WP_Query( $args );
if ( have_posts() ) :

    while (have_posts()) : the_post();
    
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
		 
		 if($login==1)
		 {
			 $image_final = $fullSizedImage;
		 }
		 else
		 {
			 $image_final = $image[0];
		 }
		 
		 
		 ?>
    <div class="home-model-box-left model-box">
      <div class="home-model-box-img">
       <a href="<?php echo get_permalink();?>">
			<img src="<?php echo $image_final;?>" />
       </a>
      </div>
      <div class="home-model-box-content">
       <div class="home-model-box-content-top">
        <h3> <a href="<?php echo get_permalink();?>"><?php the_title();?></a> </h3>
           <h4> <?php
          
          $tags = wp_get_post_tags($id, array(
           'exclude' => 63
        )
    );
         //print_r($tags);
          foreach($tags as $tgs){
              echo $tgs->name;
          }
          
          ?> </h4>
        <div class="model-description">
          <p>A pleasure-seeking Penthouse model with a sexy smile… Nicky is a pleasure to be around model with a sexy smile… Nicky is a pleasure to be around</p>
        </div>
       </div>
       <div class="home-model-box-details">
        <a href="<?php echo get_permalink();?>"> View this model <span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span></a>
       </div> 
      </div>
    </div>
    <?php endwhile;
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();
	 
	 ?>
	 
	<?php $brand_name_year = "mate-of-the-year";
	 $original_query = $wp_query;
$wp_query = null;
$args=array('posts_per_page'=>1,'post_type' => 'casting_members', 'tag' => $brand_name_year);
$wp_query = new WP_Query( $args );
if ( have_posts() ) :

    while (have_posts()) : the_post();
    
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
		 if($login==1)
		 {
			 $image_final = $fullSizedImage;
		 }
		 else
		 {
			 $image_final = $image[0];
		 }
    
     ?>
   
    <div class="home-model-box-right model-box">
      <div class="home-model-box-img">
       <a href="<?php echo get_permalink();?>"><img src="<?php echo $image_final;?>" / alt=""></a>
      </div>
      <div class="home-model-box-content">
       <div class="home-model-box-content-top">
        <h3> <a href="<?php echo get_permalink();?>"><?php the_title();?></a> </h3>
           <h4> <?php
          
          $tags = wp_get_post_tags($id, array(
           'exclude' => 63
        )
    );
         //print_r($tags);
          foreach($tags as $tgs){
              echo $tgs->name;
          }
          
          ?> </h4>
        <div class="model-description">
          <p>A pleasure-seeking Penthouse model with a sexy smile… Nicky is a pleasure to be around model with a sexy smile… Nicky is a pleasure to be around</p>
        </div>
       </div>
       <div class="home-model-box-details">
        <a href="<?php echo get_permalink();?>"> View this model <span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span></a>
       </div> 
      </div>
    </div>
    <?php endwhile;
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();
	 
	 ?>
   </div>
 </div>
</section><!--End Section-->
<!---Others model section--->
<section id="model-view" class="model-view-div">
 <div class="container">
  <div class="model-view-box">
   <ul>
	   <?php
$args = array(
	'numberposts' => 3,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'rand',
	'order' => 'ASC',
	'tag__not_in' => array( 62,63 ),
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'casting_members',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{ 
	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID'] ), 'single-post-thumbnail' ); 
	
	if( class_exists('Dynamic_Featured_Image') ) 
		{

			global $dynamic_featured_image;

			$featured_images = $dynamic_featured_image->get_featured_images($recent_posts['ID'] );

			//print_r($featured_images);

			foreach($featured_images as $featured_image) 
			{

				$fullSizedImage = $dynamic_featured_image->get_image_url($featured_image['attachment_id'], 'full');

			 
			}  
		 
		 }
		if($login==1)
		 {
			 $image_final = $fullSizedImage;
		 }
		 else
		 {
			 $image_final = $image[0];
		 }
	
	?>
	

    <li>
     <div class="model-view-img">
      <a href="<?php echo $recent_posts['guid']?>"><img src="<?php echo $image_final;?>" /></a>
     </div>
     <div class="model-view-content">
      <div class="model-view-content-top">
       <h3> <a href="<?php echo $recent_posts['guid']?>"><?php print_r($recent_posts['post_title'] );?></a> </h3>
       <h4> <?php
      
      $tags = wp_get_post_tags($recent_posts['ID'], array(
       'exclude' => 69,68
    )
);
     //print_r($tags);
      foreach($tags as $tgs){
		  echo $tgs->name;
	  }
      
      ?> </h4>
        <div class="model-description">
         <p>A pleasure-seeking Penthouse model with a sexy smile… Nicky is a pleasure to be around  </p>
        </div>
       </div>
      <div class="home-model-box-details">
        <a href="<?php echo $recent_posts['guid']?>"> View this model <span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span></a>
      </div>
     </div>
    </li>
    
		<?php } ?>
     
   </ul>
  </div>
 </div>
</section>

<section id="city-section" class="city-section-div">
    <div class="container">
       <div class="city-details clearfix">
         <div class="city-details-left">
           <h3> <?php echo get_option('webq_dis_srv');?> </h3>
           <p> <?php echo get_option('webq_dis_srv_des');?> </p>
         </div>
         <div class="city-details-right">
           <h3> <?php echo get_option('webq_dis_srv2');?> </h3>
           <p> <?php echo get_option('webq_dis_srv_des2');?> </p>
         </div>
       </div> 
        <div class="city-buttons">
                       <ul> 
						 
<?php 
						   $args = array('child_of' => '4', 'orderby' => 'ID','order' => 'ASC',);
$categories = get_categories( $args );
$j=1;
foreach($categories as $category) { 
	
   // print_r($category);
    if($j<=25)
    {
		$url = esc_url(home_url())."/city-inner/?cat-name=".$category->name;;
		
		
    echo ' <li><a href="' . $url . '">'. $category->name.'</a></li>';
}
$j++;
} ?>


                       </ul> 
                    </div>
        <div class="city-more-btn-div">             
         <a class="city-more-btn" id="show-city-list" href="<?php echo esc_url(home_url())?>/cities">View All Lavish Mate Cities</a>
        </div> 
    </div>
</section> <!----- city name section -->

<section id="exclusive-models" class="exclusive-models-div">
  <div class="container">
    <div class="exclusive-models-box">
       <a href="<?php echo esc_url(home_url())?>/escort-ladies/"> View All Exclusive Models </a>
<?php //echo get_option('webq_ex_models');?>
    </div>
  </div>
</section> <!----- Exclusive Models -->

<section id="latest-news-section" class="latest-news-div">
 <div class="container">
  <div class="latest-news-header">
    <div class="latest-news-heading"> <h3><span class="latest-head"><?php echo get_option('webq_lat_news');?></span></h3> </div>
    <div class="latest-news-sub-heading"><p> <?php echo get_option('webq_lat_news_sub_heading');?></p> </div>
  </div>
  <div class="latest-news-box clearfix">
<?php
$args = array(
	'numberposts' => 3,
	'offset' => 0,
	'category' => 28,
	'orderby' => 'rand',
	'order' => 'ASC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'post',
	'post_status' => 'draft, publish, future, pending, private',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
foreach($recent_posts as $recent_posts)
{ 
	//print_r($recent_posts);

$class_name = "latest-news-col-".$j;	
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID'] ), 'single-post-thumbnail' ); 
$post_content = $recent_posts['post_content'];
$post_title = $recent_posts['post_title'];
$guid = $recent_posts['guid'];
?>

 
   <div class="<?php echo $class_name;?> latest-news">
     <div class="latest-news-img">
       <a href="#"><img src="<?php echo $image[0];?>" / alt=""></a>
     </div>
     <div class="latest-news-content">
       <h2><a href="<?php echo $guid;?>"> <?php echo $post_title; ?> </a></h2>
       <h4> <?php echo get_the_time('F j, Y', $recent_posts['ID']);?> </h4>
       <p> <?php echo $post_content; ?></p>
       <div class="read-btn">
        <a href="<?php echo $guid;?>"> Read article <span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span></a>
       </div>
     </div>
   </div>
   <?php $j++; } ?>	 

  </div>
  <div class="copyscape-btn">
    <a href="#"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/copyscape-banner-gray.png" / alt=""></a>
  </div>
 </div>
</section> <!----- Latest News -->


<?php get_footer();?>
