<?php
/**
 * Template Name: modelprofile Page
 */
get_header('model');

?>
<?php
if ( is_user_logged_in() ) 
		{
			global $userdata;
			$uid = $userdata->ID;
			$usre_name = $userdata->display_name;
			$usre_email = $userdata->user_email;
			$mobile_phone = esc_attr( get_the_author_meta( 'mobphone', $userdata->ID ) );
			$phone = esc_attr( get_the_author_meta( 'phone', $userdata->ID ) ); 
			$address = esc_attr( get_the_author_meta( 'address', $userdata->ID ) );
			$age = "xxxxxxx";
			$nationality  = "xxxxxxx";
			
			
			}?>
			
		
		
		
<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
				//echo get_the_ID();
				?>
				
				<section id="modelprofile-about" class="modelprofile-about-div">
  <div class="container">
  
    <div class="modelprofile-about-box">
      <ul>
       <li><a href="#"> rates </a></li>
       <li><a href="#"> Contact  </a></li>
       <li><a href="#"> Escort ladies </a></li>
       <li><a href="#"> cities </a></li>
      </ul>
      <div class="about-box-divider"> <span> </span> </div>
    </div>
    
    <div class="modelprofile-details">
     <ul>
      <li>
       <div class="modelprofile-details-title">
         Age
       </div>
       <div class="modelprofile-details-des">
         <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_age', true ); ?>
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Height 
       </div>
       <div class="modelprofile-details-des">
         <?php echo get_post_meta( $post->ID, 'how_tall_are_you_', true ); ?>	 
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Weight
       </div>
       <div class="modelprofile-details-des">
          <?php echo get_post_meta( $post->ID, 'weight', true ); ?>
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Bust
       </div>
       <div class="modelprofile-details-des">
          <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_bust', true ); ?>
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Waist
       </div>
       <div class="modelprofile-details-des">
         <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_waist', true ); ?>
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Hips 
       </div>
       <div class="modelprofile-details-des">
         <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_hips', true ); ?>	
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Hair
       </div>
       <div class="modelprofile-details-des">
         	<?php echo get_post_meta( $post->ID, 'extra_profile_fileds_hair', true ); ?>	
       </div>
      </li>
      <li>
       <div class="modelprofile-details-title">
         Eyes
       </div>
       <div class="modelprofile-details-des">
          <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_eyes', true ); ?>	
       </div>
      </li>
     </ul>
    </div>
    
  </div>
</section>

<section id="model-gallery" class="model-gallery-div">
  	<div class="container-fluid gallery-nav">
		<div class="row">
			<div class="gallery-arrow-div">
				<div class="btn-prev arrow arrow-lg">
					<!--<span class="icon"><i class="fa fa-angle-left" aria-hidden="true"></i></span>-->
				</div>
				<div class="btn-next arrow arrow-lg">
					<!--<span class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></span>-->
				</div>
			</div>
		</div>
	</div>
    
	<article class="gallery-container-div">
							<div class="gallery-container">
								<ul id="gupi_ul" >
									
									<?php
									
$login=0;
		if ( is_user_logged_in() ) 
		{
			
			$images = get_post_meta( $post->ID, 'all_images_slider_images_full_body' );
		} 
		else 
		{
			$images = get_post_meta( $post->ID, 'all_images_slider_images' );
		}									
									
									


if ( $images ) {
	$j=0;
    foreach ( $images as $attachment_id ) {
      
        $thumb = wp_get_attachment_image( $attachment_id, 'full' );
        $full_size = wp_get_attachment_url( $attachment_id ); ?>

			<li id="model-pic-<?php echo $j?>">
				<a href="<?php echo $full_size?>" class="fancybox" rel="gallery">
					<img src="<?php echo $full_size?>" alt="">
				</a>							
			</li>
   <?php  $j++; }
}

?>
</ul>
			</div>
		
			
	</article>   
</section>

<section id="model-descrip" class="model-descrip-div">
 <div class="container">
   <div class="model-descrip-box clearfix">
     <div class="model-descrip-left">
       <h3> My Location </h3>
       <p>  <?php echo get_post_meta( $post->ID, 'address', true ); ?> </p>
     </div>
     <div class="model-descrip-right">
       <h3> Travel Expenses </h3>
       <p> Minimum booking 2 hours: 0 Euro - Hanover, Marbella Minimum booking 2 hours: 100 - Hamburg </p>
     </div>
     <div class="about-box-divider"> <span> </span> </div>
   </div>
 </div>
</section>

<section id="model-booking" class="model-booking-div">
  <div class="model-booking-heading">
    <h3> <?php the_title();?> </h3>
    <h3> <?php echo(get_the_excerpt()); ?> </h3>
  </div>
  <div class="model-booking-description">
    <div class="container">
      <div class="model-booking-box">
        <?php echo(the_content()); ?>
        <div class="model-booking-box-btn">
         
          <ul class="accordion">
            <li>
            <div class="accordion-tab model-booking-box-tab">
             BOOK <?php the_title();?>
            </div>
             <div class="accordion-panel">
              <div class="accordion-pane-box">
               <div class="booking-form-div">
                <form action="" method="post" onSubmit="return emailClicked();">
                  <div class="booking-box-left clearfix">
                   <li class="booking-box-field firstname">
                    <div class="vip-label">
                     <label> Your Full name <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="firstname" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field age">
                    <div class="vip-label">
                     <label> Age <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="age" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Gender </label> </div>
                    <div class="vip-fields" id="gender"> 
                       <select>
						   <option value="-1" selected="selected">— Select —</option>
                         <option value="I’m a gentleman">I’m a gentleman</option>
                         <option value="I’m a lady">I’m a lady</option>
                         <option value="We are couple">We are couple</option>
                        </select> 
                    </div>
                   </li>
                   
                   <li class="booking-box-field nationality">
                    <div class="vip-label">
                     <label> Nationality <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="nationality" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field email">
                    <div class="vip-label">
                     <label> Your E-mail <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="email" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field conemail">
                    <div class="vip-label">
                     <label> Conform E-mail </label> </div>
                    <div class="vip-fields"> <input id="conemail" placeholder="" value="" type="email"> </div>
                   </li>
                   <li class="booking-box-field phn">
                    <div class="vip-label">
                     <label> Your phone number </label> </div>
                    <div class="vip-fields"> <input id="phn" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="booking-box-field mob_phn">
                    <div class="vip-label">
                     <label> Mobile phone number <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="mob_phn" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field address">
                    <div class="vip-label">
                     <label> Address <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="address" placeholder="" value="" type="text" required> </div>
                   </li>
<!--
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> City </label> </div>
                    <div class="vip-fields"> <input id="city" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Zip Code <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="zip" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Hotel/room </label> </div>
                    <div class="vip-fields"> <input id="hotel" placeholder="" value="" type="text"> </div>
                   </li>
-->
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Desired Mate </label> </div>
                    <div class="vip-fields" id="mate"> 
                       <select class="select_field">
						   <?php
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'rand',
	'order' => 'ASC',
	
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
?>
                         <option value="<?php print_r($recent_posts['post_title'] );?>"
                         <?php if($recent_posts['post_title'] == $post->post_title) echo "selected";?> ><?php print_r($recent_posts['post_title'] );?></option>
                         
                   <?php } ?>      
                       </select> 
						<?php
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

							if( class_exists('Dynamic_Featured_Image') ) 
							{

								global $dynamic_featured_image;

								$featured_images = $dynamic_featured_image->get_featured_images($post->ID );

							//print_r($featured_images);

								foreach($featured_images as $featured_image) 
								{

									$fullSizedImage = $dynamic_featured_image->get_image_url($featured_image['attachment_id'], 'full');


								}  

							}
							
							if ( is_user_logged_in() ) 
							{

								$image_link = $fullSizedImage;
							} 
							else 
							{
								$image_link = $image[0];
							}
						?>
						  <div class="select-image-mate">
							<img id="img-mate" src="<?php echo $image_link;?>"/>
						  </div> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Alternative Mate </label> </div>
                    <div class="vip-fields" id="altmate"> 
                       <select class="slect-alt">
                          <?php
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'rand',
	'order' => 'ASC',
	
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
?>
                         <option value="<?php print_r($recent_posts['post_title'] );?>"
                         ><?php print_r($recent_posts['post_title'] );?></option>
                         
                   <?php } ?> 
                    <option value="-1" selected="selected">— Select —</option>
                       </select> 
                       <div class="select-image-mate-alt">
							<img id="img-mate-alt" src=""/>
						  </div> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> How many mates </label> </div>
                    <div class="vip-fields" id="nomate"> 
                       <select>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="4">4</option>
                         <option value="5">5</option>
                         <option value="6">6</option>
                         <option value="7">7</option>
                         <option value="8">8</option>
                         <option value="9">9</option>
                         <option value="10">10</option>
                       </select> 
                    </div>
                   </li>

                  </div> 
                  <div class="booking-box-right clearfix">
                   
                   
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Date of meeting </label> </div>
                    <div class="vip-fields"> <input id="date" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Time of Meeting </label> </div>
                    <div class="vip-fields"> <input id="time" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Best times to call </label> </div>
                    <div class="vip-fields"> <input id="time_call" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Duration </label> </div>
                    <div class="vip-fields" id="duration"> 
                       <select>
						   <option value="-1" selected="selected">— Select —</option>
                         <option value="1hr">1hr</option>
                         <option value="2 Hours">2 Hours: $900</option>
                         <option value="3 Hours">3 Hours: $1300</option>
                         <option value="4 Hours">4 Hours: $1700</option>
                         <option value="6 Hours">6 Hours: $2500</option>
                         <option value="1 Night (up to 12 Hours)">1 Night (up to 12 Hours): $3600</option>
                         <option value="1 Day (24 Hours)">1 Day (24 Hours): $$4800</option>
                         
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Any likes or Dislikes </label> </div>
                    <div class="vip-fields"> <input id="dislike" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Dress Style </label> </div>
                    <div class="vip-fields" id="dress_type"> 
                       <select>
						   <option value="-1" selected="selected">— Select —</option>
                         <option value="short">short dress</option>
                         <option value="maxi">maxi dress</option>
                         <option value="cocktail">cocktail dress, </option>
                         <option value="skirt">skirt</option>
                         <option value="sporty">sporty chic</option>
                         <option value="business">business attire </option>
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Payment Method </label> </div>
                    <div class="vip-fields" id="payment"> 
                       <select>
						   <option value="-1" selected="selected">— Select —</option>
                         <option value="Cash Payment">Cash Payment</option>
                         <option value="Bank Card">Bank Card</option>
                         <option value="Credit Card Payment">Credit Card Payment </option>
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> How did you find us? <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="find_us" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> What is your desired message for your mate?  <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> 
						<textarea id="spcl_request" placeholder="(Any special requests you have of your girl example special wardrobe etc.)" rows="3" cols="20"></textarea>
				    </div>
                   </li>
                   
                   <li class="booking-box-checkbox">
                     <span> 
                       <label>
                         <input name="wpuf_accept_toc" required="required" type="checkbox">
                       </label> 
                       </span> <p> Yes, I understand and agree to the Lavish Mate®. Terms of Service, including the Disclaimer and <a href="#">Privacy Policy. *</a> </p>

                   </li>
                  </div> 
                  
                  
                  <div class="booking-form-submit-btn">
                   <input name="submit" value="Submit" type="submit">
                  </div> 
                </form>
               </div> 
              </div>
             </div> 
            </li>
          </ul>
        </div>
      </div>
      
    </div>
  </div>
  
</section>

<section id="vip-model-about" class="vip-model-about-div">
  <div class="container">
   <div class="vip-model-about-box clearfix">
    <div class="vip-model-about-video">
        <div class="vip-model-about-video-heading">
          <h3> more about me </h3>
        </div>  
        <!---Model Section --->
        <div class="index-slide">
            <ul class="target-slider"><!--ul start-->
<?php
$images = get_post_meta( $post->ID, 'model_videos' );

if ( $images ) {
	$j=0;
    foreach ( $images as $attachment_id ) {
      
        
        
        $full_size = wp_get_attachment_url( $attachment_id );
         ?>
<li> <video preload="auto" autoplay="true" loop="loop" muted="muted" volume="0" id="myVideo"><source src="<?php echo $full_size;?>"type="video/mp4"></video></li>
			
   <?php  $j++; }
}

?>
        
             
<!--
             <li> <video preload="auto" autoplay="true" loop="loop" muted="muted" volume="0" id="myVideo"><source src="http://localhost/public_html/newwp/lavish/wp-content/themes/lavish_new/video/movie.mp4"type="video/mp4"></video></li>
             <li> <video preload="auto" autoplay="true" loop="loop" muted="muted" volume="0" id="myVideo"><source src="http://localhost/public_html/newwp/lavish/wp-content/themes/lavish_new/video/movie.mp4"type="video/mp4"></video></li>
-->
             	 
           </ul><!--End ul-->
        </div><!--End Div-->  
         
        <div class="vip-model-feedback">
			 <h3> Feedback </h3>
			<?php
			$args = array(
	'author_email' => '',
	'author__in' => '',
	'author__not_in' => '',
	'include_unapproved' => '',
	'fields' => '',
	'ID' => '',
	'comment__in' => '',
	'comment__not_in' => '',
	'karma' => '',
	'number' => '',
	'offset' => '',
	'orderby' => '',
	'order' => 'DESC',
	'parent' => '',
	'post_author__in' => '',
	'post_author__not_in' => '',
	'post_ID' => $post->ID, // ignored (use post_id instead)
	'post_id' => $post->ID,
	'post__in' => '',
	'post__not_in' => '',
	'post_author' => '',
	'post_name' => '',
	'post_parent' => '',
	'post_status' => '',
	'post_type' => '',
	'status' => 'all',
	'type' => '',
        'type__in' => '',
        'type__not_in' => '',
	'user_id' => '',
	'search' => '',
	'count' => false,
	'meta_key' => '',
	'meta_value' => '',
	'meta_query' => '',
	'date_query' => null, // See WP_Date_Query
);
$comments = get_comments( $args );


foreach ($comments as $comments)
{
	?>

         
          <h4> <?php echo $comments->comment_author;?> <?php echo $comments->comment_date;?> </h4>
          <p> <?php echo $comments->comment_content;?></p>
        <?php   }
			?>
          <div class="feedback-box">
           <h3> Write Feedback </h3>
           
          </div>
          <div class="feedback-box-div">
            <h3> We look forward to your feedback! </h3>
           <div class="feadback-form-div">

             <form action="" method="post">
                  <div class="feadback-box-left clearfix">
                   <li class="feadback-box-field firstname_">
                    <div class="vip-label">
                     <label> Your name or nickname: </label> </div>
                    <div class="vip-fields"> <input id="firstname_" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="feadback-box-field email_">
                    <div class="vip-label">
                     <label> Your email address: </label> </div>
                    <div class="vip-fields"> <input id="email_" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="feadback-box-field">
                    <div class="vip-label">
                     <label> Name of the escort lady: </label> </div>
                    <div class="vip-fields"> <input id="name_lady_" placeholder="" value="" type="text"> </div>
                   </li>
                   <li class="feadback-box-field">
                    <div class="vip-label">
                     <label> Place and date: </label> </div>
                    <div class="vip-fields"> <input id="place_" placeholder="" value="" type="text"> </div>
                   </li>
                  
                  </div> 
                  <div class="feadback-box-right clearfix">
                               
                   <li class="vip-form-box-field-textarea">
                    <div class="vip-label"> <label> Feedback: </label> </div>
                    <div class="vip-fields">
                     <textarea id="spcl_request_new" placeholder="" rows="3" cols="20"></textarea>
                    </div>
                   </li>
                   
                   <li class="feadback-box-field">
                    <div class="vip-label"> <label> May we release your feedback to the public? </label> </div>
                    <div class="vip-fields"> 
                       <select id="place_feedback">
						   <option value="-1">— Select —</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
<!--
                         <option value="Please Choose">Please Choose</option>
-->
                       </select> 
                    </div>
                   </li>
                   
                  </div> 
                  
                  
                  <div class="booking-form-submit-btn clearfix">
                   <input name="submit" value="Submit" type="submit" onClick="saveFeedBack()">
                  </div> 
                </form>

           </div> 
          </div>
         
          
        </div>
          
    </div>
    <div class="model-fact-div">
       <h3> <?php the_title();?>,
       <?php $categories = get_the_category();
 
if ( ! empty( $categories ) ) {
    echo esc_html( " ".$categories[0]->name );   
} ?></h3>
       <div class="model-fact-div-service"> 
        <h3> Services </h3>
        <ul>
        <?php $services = get_post_meta( $post->ID, 'extra_profile_fileds_services', true );
        
            $service = explode(",", $services);
            
			foreach($service as $service) 
			{
				$service = trim($service);?>
				<li> <?php echo $service;?> </li>
				
			<?php }
        
         ?>	
        </ul>
       </div> 
       
       <h3> About Me </h3>
       <div class="fact-table">
        <ul>
        <li>
         <span class="fact-col">Ethnicity:</span>
         <span class="fact-col"><?php echo get_post_meta( $post->ID, 'extra_profile_fileds_ethnicity', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Conversasions:</span>
         <span class="fact-col"><?php echo get_post_meta( $post->ID, 'what_languages_do_you_speak_', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Age:</span>
         <span class="fact-col"><?php echo get_post_meta( $post->ID, 'extra_profile_fileds_age', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Sexual Orientation:</span>
         <span class="fact-col"><?php echo get_post_meta( $post->ID, 'extra_profile_fileds_sexual_orientation', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Education:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'what_s_your_education_level_', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Occupation:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'what_s_your_occupation_now_', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Cuisine:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_cuisine', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Drinks:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_drinks', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Flowers:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_flowers', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Hobbies:</span>
         <span class="fact-col">  <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_hobbies', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Perfumes:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_perfumes', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Hand bags by:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_hand_bags_by', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Loves shoes by:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_loves_shoes_by', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Character traits:</span>
         <span class="fact-col">  <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_character_traits', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Trips:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_trips', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Duo Service:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_duo_service', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Clothing Size:</span>
         <span class="fact-col">  <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_clothing_size', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Bra size:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'cup_size__normal_enhanced_', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Shoe size:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_shoe_size', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Jeans size:</span>
         <span class="fact-col">  <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_jeans_size', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Wardrobe:</span>
         <span class="fact-col">   <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_wardrobe', true ); ?></span>
        </li>
        <li>
         <span class="fact-col">Lingerie:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_lingerie', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Shave:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'extra_profile_fileds_shave', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Piecing:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'piercings', true ); ?> </span>
        </li>
        <li>
         <span class="fact-col">Tattoos:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'tattoos', true ); ?>  </span>
        </li>
        <li>
         <span class="fact-col">Smoke:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'do_you_smoke_', true ); ?>  </span>
        </li>
        <li>
         <span class="fact-col">Drug user:</span>
         <span class="fact-col"> <?php echo get_post_meta( $post->ID, 'do_you_do_drug_', true ); ?> </span>
        </li>
       </div>
    </div>
   </div>
  </div>
</section>


<section id="model-listing" class="model-listing-div">
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

<section id="model-copy-right" class="model-copy-right-div">
  <div class="container">
   <div class="model-copy-right-box">
      <A href="#"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/copyscape-banner-gray.png" alt=""></a>
   </div>
  </div>
</section>
			<?php	
				endwhile; // End of the loop.
			?>
			<?php
			if ( is_user_logged_in() ) 
		{
			?>
<script>
var uid = '<?php echo $uid; ?>';
var usre_name = '<?php echo $usre_name; ?>';
var usre_email = '<?php echo $usre_email; ?>';
var mobile_phone = '<?php echo $mobile_phone; ?>';
var phone = '<?php echo $phone; ?>';
var address = '<?php echo $address; ?>';
var age = '<?php echo $age; ?>';
var nationality = '<?php echo $nationality; ?>';

jQuery('#firstname').val(usre_name);
jQuery('#firstname_').val(usre_name);
jQuery('#email').val(usre_email);
jQuery('#email_').val(usre_email);
jQuery('#conemail').val(usre_email);
jQuery('#phn').val(phone);
jQuery('#mob_phn').val(mobile_phone);
jQuery('#address').val(address);
jQuery('#age').val(age);
jQuery('#nationality').val(nationality);

jQuery('.firstname').hide();
jQuery('.firstname_').hide();
jQuery('.email').hide();
jQuery('.email_').hide();
jQuery('.conemail').hide();
jQuery('.phn').hide();
jQuery('.mob_phn').hide();
jQuery('.address').hide();
jQuery('.age').hide();
jQuery('.nationality').hide();

			</script>
			<?php
			
		}
		?>
<script type="text/javascript">
	jQuery('.select_field').on('change', function(){
		var model_name = jQuery(this).val();
		var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
		var data = 
		{
		action: 'get_model_image',
		dataType: 'json',

		model_name:model_name,

		}
		jQuery.post(ajaxurl, data, function(response) {

			$('#img-mate').attr("src", response)
		});
	});
	
	jQuery('.slect-alt').on('change', function(){
		var model_name_alt = jQuery(this).val();
		//alert(model_name_alt);
		var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
		
		var data = 
		{
		action: 'get_model_image_alt',
		dataType: 'json',

		model_name_alt:model_name_alt,

		}
		jQuery.post(ajaxurl, data, function(response) {

			$('#img-mate-alt').attr("src", response)
		});

	});
function emailClicked() 
{
	var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
	var first_name = $('#firstname').val();
	var age = $('#age').val();
	var nationality = $('#nationality').val();
	var email = $('#email').val();
	var conemail = $('#conemail').val();
	var phn = $('#phn').val();
	var mob_phn = $('#mob_phn').val();
	var address = $('#address').val();
	var city = $('#city').val();
	var zip = $('#zip').val();
	var hotel = $('#hotel').val();
	var mate = $( "#mate option:selected" ).text();
	var gender = $( "#gender option:selected" ).text();
	var altmate = $( "#altmate option:selected" ).text();
	var nomate = $( "#nomate option:selected" ).text();
	var date = $( "#date").val();
	var time = $( "#time").val();
	var time_call = $( "#time_call").val();
	var duration = $( "#duration option:selected").text();
	var dislike = $( "#dislike").val();
	var dress_type = $( "#dress_type option:selected").text();
	var payment = $( "#payment option:selected").text();
	var find_us = $("#find_us").val();
	var message = $("#message").val();
	
	//~ alert(message);
	var spcl_request = $( "#spcl_request" ).val();
	
	if(first_name !='' && age!='' && nationality !='' && email !='' && mob_phn !='' && address!=''  && message!='')
	{
	
	var data = {
        action: 'get_booking',
		dataType: 'json',
		first_name: first_name,
		age: age,
		gender: gender,
		nationality: nationality,
		
		email:email,
		conemail:conemail,
		phn:phn,
		
		
		mob_phn:mob_phn,
		address:address,
		//~ city:city,
		
		//~ zip:zip,
		//~ hotel:hotel,
		mate:mate,
		
		altmate: altmate,
		nomate: nomate,
        date: date,
		time:time,
		time_call:time_call,
		duration:duration,
		
		dislike:dislike,
	    dress_type:dress_type,
	    
	    payment:payment,
	    find_us:find_us,
	    message:message,
	    spcl_request:spcl_request
    };
	$.post(ajaxurl, data, function(response) {
		//alert(response); 
		
		window.location.href  = "http://onlinedevserver.biz/dev/lavish/dashboard/";
     
   });
  }
  else
  {
    //alert("Please Fill the Form Successfully");	
  }
  return false;
}
function saveFeedBack()
{
	
	var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
	
	var first_name = $('#firstname_').val();
	var email = $('#email_').val();
	var name_of_lady = $('#name_lady_').val();
	var place = $('#place_').val();
	var request = $( "#spcl_request_new" ).val();
	var place_or_not = $('#place_feedback option:selected').text();
	//~ alert(first_name);
	alert(request);
	
	var data = {
	 action: 'save_feedback',
		dataType: 'json',
		
		first_name:first_name,
		email:email,
		name_of_lady:name_of_lady,
		place:place,
		request:request,
		place_or_not:place_or_not
	}
	jQuery.post(ajaxurl, data, function(response) {
		
     $('#firstname_').text("");
     $('#email_').text("");
     $('#name_lady_').text("");
     $('#place_').text("");
     $('#spcl_request_new').text("");
     $('#place_feedback option:selected').text("");
   });
  
  
}
</script>


<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>

<script>
	var l = $('#gupi_ul > li').length;
	var li_width = $('#gupi_ul > li').outerWidth(true);
	var total_width = li_width*l;
	var tw = total_width+(10*l);	
	$('#gupi_ul').css({'width': tw+'px'});
</script>


<!--<script type="text/javascript" src="<?php //echo esc_url( get_template_directory_uri() )?>/js/jquery_003.js" ></script>
<script type="text/javascript" src="<?php //echo esc_url( get_template_directory_uri() )?>/js/jquery_005.js" ></script>-->
<?php
get_footer();
?>
