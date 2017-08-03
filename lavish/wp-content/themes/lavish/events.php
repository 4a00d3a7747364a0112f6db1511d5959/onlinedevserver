<?php
/**
 * Template Name: events Page
 */
get_header();
?>
<?php
		while (have_posts()) : the_post();
		?>

<section id="events-top" class="events-top-div">
  <div class="container">
   <div class="events-top-box">
    <?php echo the_content(); ?>
   </div>
  </div>
</section>

<section id="events-box" class="events-box-div">
 <div class="container">
  <?php
$args = array(
 'numberposts' => 10,
 'offset' => 0,
 'category' => 0,
 'orderby' => 'rand',
 'order' => 'ASC',

 'include' => '',
 'exclude' => '',
 'meta_key' => '',
 'meta_value' =>'',
 'post_type' => 'event_post_type',
 'post_status' => 'publish',
 'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{ 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID'] ), 'single-post-thumbnail' ); 
	
	?>
  
   <div class="events-box">
     <div class="about-box-divider"> <span> </span> </div>
     <div class="events-box-top clearfix">
       <div class="events-box-top-left">
          <div class="events-box-top-left-top">
           <?php echo get_post_meta( $recent_posts['ID'], 'event_dates_day', true ); ?>
          </div>
          <h4> <?php echo get_post_meta( $recent_posts['ID'], 'event_dates_date_of_event', true ); ?> </h4>
          <h4> <?php echo get_post_meta( $recent_posts['ID'], 'event_dates_month_and_year_of_event', true ); ?></h4>
         </div>
       <div class="events-box-top-middle">
         <h3>  <?php print_r($recent_posts['post_title'] );?>   </h3>
         <p>  <?php print_r($recent_posts['post_content'] );?>   </p>
       </div>
       <div class="events-box-top-right">
         <a href="#"> VIEW THE FLYER </a>
         <a href="#"> JOINT THE PARTY </a>
       </div>
     </div>
     <div class="events-box-bottom">
      <img src="<?php echo $image[0];?>" alt="" />
     </div>
   </div>
   
   <?php } ?>
 </div>
</section>

<section id="future-ladies-acrodian" class="gentlemen-acrodian-div">
 <div class="lavish-free-guide-box">
    <div class="lavish-free-guide-details">
     
     <ul class="accordion">
      <div class="accordion-contant-div">
       <div class="container">
           <h3> Moderation Policy </h3>
           <p> <?php echo get_post_meta( get_the_ID(), 'Moderation Policy', true ); ?> </p>
        </div>
       </div>
      <li>
            <div class="accordion-tab">
             Community Use Policy  
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box future-ladies-accordion-pane-box">
                 <?php echo get_post_meta( get_the_ID(), 'Community Use Policy', true ); ?>
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
             Security
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> <?php echo get_post_meta( get_the_ID(), 'Security', true ); ?></p>
                
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
             Privacy Policy 
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <?php echo get_post_meta( get_the_ID(), 'Privacy Policy', true ); ?>
               </div>
             </div> 
            </div> 
        </li>

    </ul>
    </div>
 </div>   
</section>

<section id="event-information" class="event-information-div">
  <div class="container">
   <div class="event-information-box">
    <h3> What we collect (we may collect the following information): </h3>
     <?php echo get_post_meta( get_the_ID(), 'What we collect', true ); ?>
   </div>
  </div>
</section>

<section id="future-ladies-acrodian" class="gentlemen-acrodian-div">
 <div class="lavish-free-guide-box">
    <div class="lavish-free-guide-details">
    
     <ul class="accordion">
      <li>
            <div class="accordion-tab">
             Am I welcome to Lavish Mate Masquerade ball 
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box future-ladies-accordion-pane-box">
                 <?php echo get_post_meta( get_the_ID(), 'welcome to Lavish Mate Masquerade ball', true ); ?>
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
             Changes to the Community Use Policy 
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> <?php echo get_post_meta( get_the_ID(), 'Changes to the Community Use Policy', true ); ?></p>
                
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
             Prohibited Uses 
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <?php echo get_post_meta( get_the_ID(), 'Prohibited Uses', true ); ?>
               </div>
             </div> 
            </div> 
        </li>
        
      <li>
            <div class="accordion-tab">
             You also agree 
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                <?php echo get_post_meta( get_the_ID(), 'You also agree', true ); ?>
               </div>
             </div> 
            </div> 
        </li>

    </ul>
    </div>
 </div>   
</section>

<section id="events-video" class="events-video-div">
 <div class="container">
  <div class="events-video-box">
   <h3>  New Years Eve Masquerade Ball Dec, 2017 </h3>
   <div class="event-video-col">
    <video preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
     <source src="<?php echo esc_url( get_template_directory_uri() )?>/video/event.mp4"type="video/mp4">
    </video>

   </div>
  </div>
 </div>
</section>

<section id="booking-copy-space" class="booking-copy-space-div ten-steps-copy-space-div">
  <div class="container">
    <div class="copy-space-box">
     <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish mate-copyscape-2.png" alt="" />
     <?php echo get_post_meta( get_the_ID(), 'Our research', true ); ?>
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
    <p><?php echo get_post_meta( get_the_ID(), 'Copyright', true ); ?></p>
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
<?php endwhile;?>

<!--<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>-->
<?php
get_footer();
?>
