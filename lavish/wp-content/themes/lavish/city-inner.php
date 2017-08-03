<?php
/**
 * Template Name: Cityinner Page
 */
get_header('small');
?>
<?php

$cat_name = $_REQUEST['cat-name'];
 $page = get_page_by_title($cat_name, OBJECT, 'City_Sub');
$pid = $page->ID;
?>
<section id="casting-about" class="casting-about-div">
  <div class="container">
    <div class="casting-about-top gentlemen-top">
     
      <ul>
       <li><a href="#"> rates </a></li>
       <li><a href="#"> Escort ladies  </a></li>
       <li><a href="#"> about lavish mate </a></li>
       <li><a href="#"> cities </a></li>
       <li><a href="#"> contact </a></li>
      </ul>
      <div class="about-box-divider"> <span> </span> </div>
    </div>
    <div class="casting-about-bottom">
      
      <div class="casting-about-bottom-content">
         <h3> <?php echo $cat_name;?> High-class companions </h3>
        <p> <?php echo get_post_meta($pid,'Arm In Arm With Your Escort',true);?> </p>
      </div>
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
 'category' => $pid,
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

<section id="cities-inner" class="cities-inner-div">
 <div class="container">
  <div class="cities-inner-content-box">
    <h3> Experience Royal Moments Of Happiness With Our Elite Escort Service <?php echo $cat_name;?> </h3>
    <p> <?php echo get_post_meta($pid,'Experience Royal Moments Of Happiness With Our Elite Escort Service',true);?> </p>
    
    <div class="about-box-divider"> <span> </span> </div>
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Premium Escort Service <?php echo $cat_name;?> </h3>
    <p> <?php echo get_post_meta($pid,'Premium Escort Service',true);?> </p>

    <h3> Watch the video about the <?php echo get_post_meta($pid,'Watch the video about the',true);?> </h3>
    
    <div class="cities-video-box">
      <iframe width="100%" height="100%" src="<?php echo get_post_meta($pid,'Video lInk Hotel',true);?>" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="about-box-divider"> <span> </span> </div>
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Experience <?php echo $cat_name;?> Arm In Arm With Your Escort </h3>
    <p> <?php echo get_post_meta($pid,'Arm In Arm With Your Escort',true);?> </p>
    
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Visit <?php echo $cat_name;?>’s Most Magnificent Attractions With Your Beautiful Companion </h3>
    <p> <?php echo get_post_meta($pid,'Most Magnificent Attractions With Your Beautiful Companion',true);?></p>
    
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Elite And Discreet Escorts <?php echo $cat_name;?> </h3>
    <p> <?php echo get_post_meta($pid,'Elite And Discreet Escorts',true);?></p>
    <div class="about-box-divider"> <span> </span> </div>
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Five-Star Escort Agency <?php echo $cat_name;?> & Unadulterated Luxury </h3>
    <p> <?php echo get_post_meta($pid,'Five-Star Escort Agency',true);?></p>

    <h3> Watch the video about the Hôtel <?php echo get_post_meta($pid,'Watch the video about the',true);?> </h3>
    
    <div class="cities-video-box">
      <iframe width="100%" height="100%" src="<?php echo get_post_meta($pid,'Video lInk Hotel',true);?>" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="about-box-divider"> <span> </span> </div>
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Culinary Delights for You and Your Premium Escort </h3>
    <p> <?php echo get_post_meta($pid,'Culinary Delights for You and Your Premium Escort',true);?> </p>
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Sensual Nightlife And Pleasures With VIP Escort <?php echo $cat_name;?> </h3>
    <p> <?php echo get_post_meta($pid,'Sensual Nightlife And Pleasures With VIP Escort',true);?></p>
  </div>
  
  <div class="cities-inner-content-box">
    <h3> Experience Best Chef In The World With Your VIP Escort <?php echo $cat_name;?> </h3>
    <p> <?php echo get_post_meta($pid,'Experience Best Chef In The World With Your VIP Escort',true);?> </p>
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
 'category' => $pid,
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

<section id="booking-copy-space" class="booking-copy-space-div city-copy-space-div">
  <div class="container">
    <div class="copy-space-box">
     <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish mate-copyscape-2.png" alt="" />
     <p> Our research has highlighted specific attributes that our clients find desirable so all escort ladies are screened according to this criteria. We seek out
models that are confident, comfortable, adventurous and open-minded, addition to being physically attractive.
 </p>
     <p> Please note that the models you see on the Lavish Mate® website work exclusively with us </p>
     <p> Please contact us directly with any questions or concerns </p>
     <p> Thank you for your support and understanding </p>
     <p> Yours  </p>
     <p> Kristen (Manager ) </p>
     </div>
   </div>
  
  
  <div class="copy-right-booking-box copy-right-booking-box-cities">
    <div class="about-box-divider">
     <span> </span>
    </div>
   <div class="copy-text-accordion">
    <ul class="accordion">
    <li>
    <div class="accordion-tab"> Copyright </div>
    <div class="accordion-panel" style="display: none;">
    <div class="container">
    <div class="accordion-pane-box">
    <p>All contents of our web sites (including but not limited to: Chihuahua head symbol, logo, texts, graphics, audio, video and layout) are exclusive copyright of Lavish Mate®. Our web pages or elements of our web pages are protected by copyright law and law of unfair competition and may not by copied, distributed or modified without our written consent. It is illegal and punishable by criminal law to copy, distribute or modify our copyrighted material without our prior consent. Lavish Mate® will pursue all legal remedies against infringements of our rights. Lavish Mate® is a registered trademark in the United States, Canada and numerous other countries. This is also proof of the recognized expertise of Lavish Mate® which has emerged as a modern and globally operating elite escort agency over the years. In case of violation of our registered trademark Lavish Mate® we will initiate civil litigation for damages and will seek criminal prosecution by local law enforcement authorities.</p>
    </div>
    </div>
    </div>
    </li>
    </ul>
   </div>
    <div class="about-box-divider">
     <span> </span>
    </div>
  </div>
</section>

<?php
get_footer();
?>
