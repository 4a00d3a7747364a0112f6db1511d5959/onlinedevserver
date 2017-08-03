<?php
/**
 * Template Name: gentlemen Page
 */
get_header('small');
?>

<?php
while (have_posts()) : the_post();

the_content();

endwhile;
?>

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

<section id="booking-copy-space" class="booking-copy-space-div ten-steps-copy-space-div">
  <div class="container">
    <div class="copy-space-box">
     <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish mate-copyscape-2.png" alt="" />
     <?php echo get_post_meta($pid,'Our research',true); ?>
     </div>
   </div>
  
  
  <div class="copy-right-booking-box">
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
    <p><?php echo get_post_meta($pid,'All contents of our web sites',true); ?></p>
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


<!--<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>-->
<?php
get_footer();
?>
