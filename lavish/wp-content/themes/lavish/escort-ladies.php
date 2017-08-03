<?php
/**
 * Template Name: escortladies Page
 */
get_header();
?>

<section id="casting-amazing" class="casting-amazing-div escort-ladies-div">
  <div class="container">
    <div class="casting-amazing-top clearfix">
      <div class="about-box-divider"> <span> </span> </div>
      <div class="casting-amazing-top-left">
        <div class="casting-amazing-top-heading">
          <h3> <?php echo get_option('webq_amz_one_head');?> </h3>
        </div>
        <div class="casting-amazing-top-contant">
          <p> <?php echo get_option('webq_amz_one_des');?></p>
        </div>
      </div>
      <div class="casting-amazing-top-right">
        <div class="casting-amazing-top-heading">
          <h3> <?php echo get_option('webq_amz_two_head');?> </h3>
        </div>
        <div class="casting-amazing-top-contant">
          <p> <?php echo get_option('webq_amz_two_des');?></p>
        </div>
      </div>
    </div>
  </div>
</section>


<!--Mate of the year and mate of the month section-->
<section id="home-model" class="home-model-div escort-ladies-model-div">
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

		 
		 if(is_user_logged_in())
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


<section id="model-listing" class="model-listing-div secort-ladies-listing-slider">
  <div class="block-lady_list">
    <div class="strip-full"><h3><span class="left-right slider-custom-left"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/left-arrow.png" alt="left" border="0"></span> Escort Ladies <span class="left-right slider-custom-right"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/right-arrow.png" alt="right" border="0"></span></h3></div>
    <div class="wrap-thumbs">
        <div class="bx-wrapper">
          <div class="bx-viewport flexslider">
             <ul class="lady_list slides">
         
                   <?php
$args = array(
 'numberposts' => 10,
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
 $login=0;
  if ( is_user_logged_in() ) 
  {
   $login =1;
  } 
  else 
  {

  }
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
                      <li id="got_overlay">
                        <a href="#">
                            <img src="<?php echo $image_final;?>" alt="">
                        </a>
                        
                        <div class="lady_overlay flex-caption">
                            <a class="overlay-name" href="#">
                            <?php print_r($recent_posts['post_title'] );?>                            
                            </a>
                            <div class="lady_age">Age: <?php echo get_post_meta( $recent_posts['ID'], 'extra_profile_fileds_age', true ); ?> </div>
                            <div class="trips">Worldwide</div>
                            
                            <div><?php echo get_post_meta( $recent_posts['ID'], 'extra_profile_fileds_cuisine', true ); ?></div>
                            <a class="button" href="<?php echo $recent_posts['guid']?>">
                                More
                            </a>
                        </div>
                  
                    </li>
                     <?php   }
?>
                     </ul>
                    </div>
                      
                    </div>
    </div>
</div>
</section>

<!---Others model section--->
<section id="model-view" class="model-view-div escort-ladies-box">
  <div class="escort-ladies-content-section">
   <div class="container">
     <h3> High Class Escort Services - Charming Models </h3>
     <p> At our VIP escort agency for the demanding gentleman you will find discrete models for our classy elite escort services. Our first class escort services offer hostesses for events or travel escorts for business trips and business lunches. Fashion models 
are looking forward to being your charming weekend, travel or holiday escort. Whether it is for a party, a gala, an event, 
or the cinema, theatre, opera, musical, fitness or a dinner, our top model escort agency arranges dates and hot games 
with attractive and charming escort models. </p>
   </div>
  </div> 
 <div class="container">
  <div class="model-view-box">
   <ul>
	   <?php
$args = array(
	'numberposts' => 9,
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

<section id="model-copy-right" class="model-copy-right-div escort-ladies-box-copy-right">
  <div class="container">
   <div class="model-copy-right-box">
      <A href="#"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/copyscape-banner-gray.png" alt=""></a>
   </div>
  </div>
</section>

<?php get_footer();?>
