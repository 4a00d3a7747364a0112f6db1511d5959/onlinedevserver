<?php
/**
 * Template Name: City Page
 */
get_header('small');
?>
<section id="casting-about" class="casting-about-div">
  <div class="container">
    <div class="casting-about-top gentlemen-top">
     
      <ul>
       <li><a href="#"> Escort ladies </a></li>
       <li><a href="#"> Booking  </a></li>
       <li><a href="#"> Gentalman FAQ </a></li>
       <li><a href="#"> 10 Steps To Conquer </a></li>
      </ul>
      <div class="about-box-divider"> <span> </span> </div>
    </div>
    <div class="casting-about-bottom">
      
      <div class="casting-about-bottom-content">
         <h3> Our escort ladies can serve you in every city </h3>
        <p> 
Lavish Mate® beautiful models are available to travel to any extravagant establishment worldwide will sweeten your stay everywhere in United States also our models travel around the globe 
within our restriction.Look forward to a passionate rendezvous with an intelligent, romantic and open-minded escort lady in Canada, Europe, Germany, Austria, Switzerland and Spain or in 
the other countries.You may fully rely on the discreet and comprehensive service our prestigious escort agency offers you.Should you choose to invite one of our first class girlfriend escorts 
to join you on a date, all you have to do is to choose one of our top models and simply enjoy models... </p>
      </div>
    </div>
  </div>
</section>

<section id="casting-about" class="cities-page-div">
  <div class="container">
    <div class="casting-about-top">
     
      <div class="about-box-divider about-box-divider-top"> <span> </span> </div>
       
       <h3> Florida </h3>
       <p>VIP companions in Florida - if you are in Florida on business, our local beautiful models can add a little spice to your stay. We know that everyone is different,that’s why we have recruited local escorts that complement every preference. If you are staying in Florida for business or pleasure and intend to stay longer than a weekend, our international models are happy   
to fly over to entertain you. Can’t wait to experience what our Florida models have to offer? We can bring them to you, regardless of where you are in the world. </p>
       
      <div class="about-box-divider about-box-divider-bottom"> <span> </span> </div>
      
    </div>
    
  </div>
</section>


<?php
$args = array(
 'numberposts' => 6,
 'offset' => 0,
 'category' => 0,
 'orderby' => 'post_modified',
 'order' => 'ASC',
 'tag__not_in' => array( 62,63 ),
 'include' => '',
 'exclude' => '',
 'meta_key' => '',
 'meta_value' =>'',
 'post_type' => 'City',
 'post_status' => 'publish',
 'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	if($j%2==0)
	{
	?>

<section id="casting-about" class="cities-page-div">
  <div class="container">
    <div class="cities-top">
     
      <div class="about-box-divider about-box-divider-top"> <span> </span> </div>
       <div class="cities-button-name cities-button-name-middel"> <a href="#"> <?php print_r($recent_posts['post_title']);?> </a> </div>
           <p> <?php print_r($recent_posts['post_content']);?></p>
           
          <div class="city-buttons">
			  
           <ul> 
			   <?php $post_categories = wp_get_post_categories( $recent_posts['ID'] );
			  //print_r($post_categories);
				foreach($post_categories as $c)
				{
				$cat = get_category( $c );?>
				
				<li><a href="<?php echo esc_url(home_url());?>/city-inner/?cat-name=<?php echo $cat->name;?>"><?php echo $cat->name;?> </a></li>
			<?php	}
			  ?>
 
           </ul> 
          </div>
              
      </div>
    
  </div>
</section>

<?php 
}
else
{
	?>
	<section id="city-section" class="city-section-div city-section-div-inner">
    <div class="container">
       <div class="cities-button-name"> <a href="#"> <?php print_r($recent_posts['post_title']);?> </a> </div>
       <div class="city-details clearfix">
         <p> Whether in or going to these cities for business or pleasure our escort models can make your time pleasurable. We are based in Florida, but have been successfully servicing the United States and 
international clients since our inception. We are highly sought-after for our superior match-making skills and our success in meeting all of our clients’ needs.
No matter which sweet escort model from Escort United States you select – an exciting time full of sensuality and romance is guaranteed! As one of the leading high-class escort agencies,for us 
and our VIP escorts your satisfaction comes first. From Florida to New York or California– Your stylish escort lady will inspire you. With charm, class and a sophisticated open-mindedness all elite 
escort girls exceed even the highest expectations of refined gentlemen. </p>
       </div> 
        <div class="city-buttons">
               <ul> 
			   <?php $post_categories = wp_get_post_categories( $recent_posts['ID'] );
			  //print_r($post_categories);
				foreach($post_categories as $c)
				{
				$cat = get_category( $c );?>
				
				<li><a href="<?php echo esc_url(home_url());?>/city-inner/?cat-name=<?php echo $cat->name;?>"><?php echo $cat->name;?> </a></li>
			<?php	}
			  ?>
 
           </ul> 
                    </div>
   
    </div>
</section> <!----- city name section -->
	
<?php
}


$j++;
}
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

 <?php
$args = array(
 'numberposts' => 6,
 'offset' => 0,
 'category' => 0,
 'orderby' => 'post_modified',
 'order' => 'DESC',
 'tag__not_in' => array( 62,63 ),
 'include' => '',
 'exclude' => '',
 'meta_key' => '',
 'meta_value' =>'',
 'post_type' => 'City',
 'post_status' => 'publish',
 'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	if($j%2==0)
	{
	?>

<section id="casting-about" class="cities-page-div">
  <div class="container">
    <div class="cities-top">
     
      <div class="about-box-divider about-box-divider-top"> <span> </span> </div>
       <div class="cities-button-name cities-button-name-middel"> <a href="#"> <?php print_r($recent_posts['post_title']);?> </a> </div>
           <p> <?php print_r($recent_posts['post_content']);?></p>
           
          <div class="city-buttons">
           <ul> 
			   <?php $post_categories = wp_get_post_categories( $recent_posts['ID'] );
			  //print_r($post_categories);
				foreach($post_categories as $c)
				{
				$cat = get_category( $c );?>
				
				<li><a href="<?php echo esc_url(home_url());?>/city-inner/?cat-name=<?php echo $cat->name;?>"><?php echo $cat->name;?> </a></li>
			<?php	}
			  ?>
 
           </ul>  
          </div>
              
      </div>
    
  </div>
</section>

<?php 
}
else
{
	?>
	<section id="city-section" class="city-section-div city-section-div-inner">
    <div class="container">
       <div class="cities-button-name"> <a href="#"> <?php print_r($recent_posts['post_title']);?> </a> </div>
       <div class="city-details clearfix">
         <p> Whether in or going to these cities for business or pleasure our escort models can make your time pleasurable. We are based in Florida, but have been successfully servicing the United States and 
international clients since our inception. We are highly sought-after for our superior match-making skills and our success in meeting all of our clients’ needs.
No matter which sweet escort model from Escort United States you select – an exciting time full of sensuality and romance is guaranteed! As one of the leading high-class escort agencies,for us 
and our VIP escorts your satisfaction comes first. From Florida to New York or California– Your stylish escort lady will inspire you. With charm, class and a sophisticated open-mindedness all elite 
escort girls exceed even the highest expectations of refined gentlemen. </p>
       </div> 
        <div class="city-buttons">
               <ul> 
			   <?php $post_categories = wp_get_post_categories( $recent_posts['ID'] );
			  //print_r($post_categories);
				foreach($post_categories as $c)
				{
				$cat = get_category( $c );?>
				
				<li><a href="<?php echo esc_url(home_url());?>/city-inner/?cat-name=<?php echo $cat->name;?>"><?php echo $cat->name;?> </a></li>
			<?php	}
			  ?>
 
           </ul>  
                    </div>
   
    </div>
</section> <!----- city name section -->
	
<?php
}


$j++;
}
?>


<section id="booking-copy-space" class="booking-copy-space-div city-copy-space-div">
  <div class="container">
    <div class="copy-space-box">
     <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish mate-copyscape-2.png" alt="" />
     <?php
while (have_posts()) : the_post();

the_content();

endwhile;
?>
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
		 <?php
while (have_posts()) : the_post();
?>
    <p><?php echo get_post_meta(14,'Copy Right',true);?></p>
    <?php
    endwhile;
?>
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
