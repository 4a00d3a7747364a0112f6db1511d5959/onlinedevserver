<?php
/**
 * Template Name: Newsinner Page
 */
get_header('casting');
?>

<section id="news-top-bar" class="news-top-bar-div">
  <div class="container">
    <div class="news-top-bar-box">
      <ul> 
       <li> <a href="#"> HOME </a></li>
       <li> <a href="#"> DESIRES OF MEN’S </a></li>
       <li> <a href="#"> EROTIC TIPS </a></li>
       <li> <a href="#"> ROMANTIC ADVENTURES </a></li>
       <li> <a href="#"> EVENTS & MORE </a></li>
      </ul>
    </div>
  </div>
</section>

<section id="casting-about" class="casting-about-div gentlemen-top-div">
  <div class="container">
    <div class="casting-about-top gentlemen-top">
       <h3> Lavish Mate® Latest News</h3>
       
      <div class="about-box-divider"> <span> </span> </div>
    </div>
    <div class="casting-about-bottom">
      
      <div class="casting-about-bottom-content">
        
        <p> We allow sensual insights in our News about the exciting world of our VIP escorts! Here, you may be the first to know, for example, 
when one of the charming escort models presents new photos of herself. This is also the page where we introduce you to the newest ladies of our VIP 
escort agency, and where you may read the latest feedback from other gentlemen about our escort service. </p>
      </div>
    </div>
  </div>
</section>


<section id="model-view" class="model-view-div news-div">
 <div class="container">

   <!-- masonry grid ---->
    <div class="news-masonry-grid">
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
	'post_type' => 'News',
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
<div class="news-masonry-box">
       <div class="news-masonry-img">
         <a href="<?php echo $recent_posts['guid']?>"><img src="<?php echo $image_final;?>" /></a>
       </div>
       <div class="news-masonry-content">
        <h3> <a href="<?php echo $recent_posts['guid']?>"><?php print_r($recent_posts['post_title'] );?></a> </h3>
        <p> <?php print_r($recent_posts['post_content'] );?>  </p>
       <!-- <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. </p>-->
       </div>
       <div class="news-masonry-details">
        <a href="<?php echo $recent_posts['guid']?>"> Read Article <span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span></a>
      </div>
      </div>

	  <?php } ?>    
     </div>
   <!-- masonry grid end ---->
  </div>
  
  
  
  
 </div>
</section>


<section id="model-listing" class="model-listing-div ten-steps-listing-div">
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

<section id="about-copy-right" class="about-copy-right-box">
  <div class="container">
    <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/copyscape-banner-gray-200x25.png" alt="" />
      
  </div>
</section>



<?php
get_footer();
?>
