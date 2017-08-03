<?php

get_header('newsinner');
?>
<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
				//echo get_the_ID();
				?>

<section id="news-inner" class="news-inner-div">
 <div class="container clearfix">
    <div class="news-inner-left">
     <div class="news-top-bar-div">
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
     
     <div class="news-inner-content-div">
      <div class="casting-about-top gentlemen-top">
       <h3> <?php echo the_title();?></h3>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
       <div class="inner-news-post-img">
        <img src="<?php echo $image[0]?>" />
       </div>
       
      <div class="about-box-divider"> <span> </span> </div>
    </div>
    
      <div class="news-inner-post-content">
		   
        <div class="post_details_front"> by <?php echo get_the_author();?> | <?php $tags = get_the_tags();
		   
		  foreach($tags as $tgs){
              echo $tgs->name;
          }
		   
		   ?> | <?php echo get_the_date(); ?> | View All Post</div>
           <?php the_content(); ?>
          <div class="news-inner-share-box">
           <h3> Share This:
           <ul>
            <li class="fb"> <a href="#"><span> <i class="fa fa-facebook" aria-hidden="true"></i> </span> facebook </a> </li>
            <li class="twi"> <a href="#"><span> <i class="fa fa-twitter" aria-hidden="true"></i> </span> Twitter </a> </li>
            <li class="link"> <a href="#"><span> <i class="fa fa-linkedin" aria-hidden="true"></i> </span> Linkedin </a> </li>
            <li class="pint"> <a href="#"><span> <i class="fa fa-pinterest" aria-hidden="true"></i> </span> Pinterest </a> </li>
            <li class="insta"> <a href="#"><span> <i class="fa fa-instagram" aria-hidden="true"></i> </span> Instagram </a> </li>
            <li class="env"> <a href="#"><span> <i class="fa fa-envelope" aria-hidden="true"></i> </span> Email </a></li>
            <li class="google-plus"> <a href="#"><span> <i class="fa fa-google-plus" aria-hidden="true"></i> </span> Google Plus </a> </li>
           </ul>
          </div> 
      </div>
   
     </div>
    <!-- masonry grid ---->
     <div class="news-div">
      <h3> FEATURED <span> ARTICLES </span> </h3>
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
     </div>  
    <!-- masonry grid end ----> 
    </div>
   
   <div class="news-inner-right">
    <div class="right-container">
	  <div class="tags-news">
		

<?php if ( is_active_sidebar( 'lavish-tag-widget' ) ) : ?>
	
		<?php dynamic_sidebar( 'lavish-tag-widget' ); ?>
	
<?php endif; ?>
	</div>	
	
	  <div class="archive"> 
	   <h2 class="archive-heading">
		 Archive
	   </h2>
		<?php $args = array(
        'type'            => 'monthly',
        'limit'           => '',
        'format'          => 'html', 
        'before'          => '',
        'after'           => '',
        'show_post_count' => false,
        'echo'            => 1,
        'order'           => 'DESC',
            'post_type'     => 'post'
    );
    wp_get_archives( $args ); ?>
	</div>

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
  
    <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/copyscape-banner-gray-200x25.png" alt="" />
      
 
</section>

<?php	
				endwhile; // End of the loop.
			?>

<?php
get_footer();
?>
