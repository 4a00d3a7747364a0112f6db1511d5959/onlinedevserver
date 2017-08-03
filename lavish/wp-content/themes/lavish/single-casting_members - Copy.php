<?php
/**
 * Template Name: modelprofile Page
 */
get_header('model');
?>
<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
				//echo get_the_ID();?>
				
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
          <?php echo get_post_meta( $post->ID, 'weight_', true ); ?>
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
					<span class="icon"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
				</div>
				<div class="btn-next arrow arrow-lg">
					<span class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
	</div>
    
	<article class="gallery-container-div">
							<div class="gallery-container">
								<ul id="gupi_ul" >
									
									<?php
$images = get_post_meta( $post->ID, 'all_images_slider_images' );

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
       <p>  <?php echo get_post_meta( $post->ID, 'address_', true ); ?> </p>
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
                <form>
                  <div class="booking-box-left clearfix">
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Your Full name <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Age <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Nationally <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Your E-mail <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Conform E-mail </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="email" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Your phone number </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Mobile phone number <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Address <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> City </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Zip Code <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="password" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Hotel/room </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="password" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Desired Mate </label> </div>
                    <div class="vip-fields"> 
                       <select class="xxxxxxxxxxxxxx">
                         <option value="Lavish">Yvonno</option>
                         <option value="Silver">Angelina</option>
                         <option value="Gold">Angelina</option>
                         <option value="Platinum">Kristinak</option>
                         <option value="Black">Jade</option>
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Alternative Mate </label> </div>
                    <div class="vip-fields"> 
                       <select>
                         <option value="Yvonno">Yvonno</option>
                         <option value="Angelina">Angelina</option>
                         <option value="Marie">Marie</option>
                         <option value="Kristinak">Kristinak</option>
                         <option value="Jade">Jade</option>
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> How many mates </label> </div>
                    <div class="vip-fields"> 
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
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Time of Meeting </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Best times to call </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Duration </label> </div>
                    <div class="vip-fields"> 
                       <select>
                         <option value="1hr">1hr</option>
                         <option value="2hrs">2hrs</option>
                         <option value="3hrs">3hrs</option>
                         <option value="3hrs">3hrs</option>
                         <option value="3hrs">3hrs</option>
                         <option value="6hrs">6hrs</option>
                         <option value="8hrs">8hrs</option>
                         <option value="12hrs">12hrs</option>
                         <option value="1day">1 day</option>
                         <option value="2days">2 days</option>
                         <option value="other">other</option>
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Any likes or Dislikes </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Dress Style </label> </div>
                    <div class="vip-fields"> 
                       <select>
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
                    <div class="vip-fields"> 
                       <select>
                         <option value="Cash Payment">Cash Payment</option>
                         <option value="Bank Card">Bank Card</option>
                         <option value="Credit Card Payment">Credit Card Payment </option>
                       </select> 
                    </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> How did you find us? <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> What is your desired message for your mate?  <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="vip-form-box-field-textarea">
                    <div class="vip-label"> <label> (Any special requests you have of your girl example special wardrobe etc.)	 </label> </div>
                    <div class="vip-fields">
                     <textarea placeholder="" rows="3" cols="20" required></textarea>
                    </div>
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
          <h4> Peter 07.2017 </h4>
          <p> Helen is one of the most charming escort models that I have met in recent years. From our dinner date to the sensualmoments in intimate togetherness I never had the impression I booked an escort. I will definitely see Helen again. Thank you Scarlett for your recommendation! </p>
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
          <div class="bx-viewport">
             <ul class="lady_list">
         
                      <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-1.jpg" alt="">
                        </a>
                        <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Kiara                            </a>
                            <div class="lady_age">Age: Mid 20´s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Dusseldorf, Cologne, Bonn</div>
                        </div>
                    </li>
                      <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-2.jpg" alt="">
                        </a>
                          <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Mia                            </a>
                            <div class="lady_age">Age: Mid 20s </div>
                            <div class="trips">Europe</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Cannes, St. Tropez, Monaco, Geneva</div>
                        </div>
                    </li>
                     <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-3.jpg" alt="">
                        </a>
                         <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Aaliyah                            </a>
                            <div class="lady_age">Age: Mid 30s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Paris, Brussels, Geneva, London, Frankfurt</div>
                        </div>
                    </li>
                                                                <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-4.jpg" alt="">
                        </a>
                          <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Victoria                            </a>
                            <div class="lady_age">Age: Mid 20´s</div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Stuttgart, Munich, Frankfurt, Zurich</div>
                        </div>
                    </li>
                       <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                           <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-5.jpg" alt="">
                        </a>
                          <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Stella                            </a>
                            <div class="lady_age">Age: Late 20´s</div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Hanover, Berlin, Hamburg, Frankfurt</div>
                        </div>
                    </li>
                       <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                           <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-6.jpg" alt="">
                        </a>
                          <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Claudia                            </a>
                            <div class="lady_age">Age: Early 30s </div>
                            <div class="trips">Europe</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Innsbruck, Salzburg, Vienna, Stuttgart</div>
                        </div>
                    </li>
                      <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-7.jpg" alt="">
                        </a>
                          <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Anna                            </a>
                            <div class="lady_age">Age: Mid 20s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Hanover, Hamburg, Berlin, Marbella</div>
                        </div>
                    </li>
                      <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="http://www.targetescorts.com/evelyn-escort-service.htm">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-8.jpg" alt="">
                        </a>
                          <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Evelyn                            </a>
                            <div class="lady_age">Age: Early 20</div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Berlin, Hamburg, Hanover, Leipzig</div>
                        </div>
                    </li>
                       <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="http://www.targetescorts.com/julia-escort-service.htm">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-9.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Julia                            </a>
                            <div class="lady_age">Age: Late 20´s </div>
                            <div class="trips">Europe</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Munich, Nuremberg, Stuttgart, Salzburg</div>
                        </div>
                    </li>
                       <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-10.jpg" alt="">
                        </a>
                            <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Amelie                            </a>
                            <div class="lady_age">Age: Early 20s</div>
                            <div class="trips">Europe</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Dusseldorf, Cologne, Bonn, Frankfurt</div>
                        </div>
                    </li>
                        <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-11.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Carolina                            </a>
                            <div class="lady_age">Age: Early 20</div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Vienna, Salzburg, Graz, Munich</div>
                        </div>
                    </li>
                      <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-12.jpg" alt="">
                        </a>
                         <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Jasmin                            </a>
                            <div class="lady_age">Age: Mid 20´s</div>
                            <div class="trips">Europe</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Nuremberg, Munich, Mainz, Frankfurt</div>
                        </div>
                    </li>
                        <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-13.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Emily                            </a>
                            <div class="lady_age">Age: Mid 20´s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Mannheim, Frankfurt, Stuttgart</div>
                        </div>
                    </li>
                         <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-14.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Sophie                            </a>
                            <div class="lady_age">Age: Mid 20´s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Zurich, Basel, Bern, Geneva</div>
                        </div>
                    </li>
                                                                <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-15.jpg" alt="">
                        </a>
                                                    <div class="new_lady"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/heart-new.png" alt="New"></div>
                                                <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Alice                            </a>
                            <div class="lady_age">Age: Early 20s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Stuttgart, Karlsruhe, Frankfurt</div>
                        </div>
                    </li>
                         <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-16.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Isabelle                            </a>
                            <div class="lady_age">Age: 30</div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Cologne, Dusseldorf, Frankfurt</div>
                        </div>
                    </li>
                                    <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;" class="bx-clone">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-17.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Lina                            </a>
                            <div class="lady_age">Age: Mid 20s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Mannheim, Karlsruhe, Frankfurt, Stuttgart</div>
                        </div>
                    </li><li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;" class="bx-clone">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-18.jpg" alt="">
                        </a>
                                                <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Laura                            </a>
                            <div class="lady_age">Age: Mid 20´s</div>
                            <div class="trips">Europe</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Dresden, Leipzig, Berlin</div>
                        </div>
                    </li><li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;" class="bx-clone">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-19.jpg" alt="">
                        </a>
                                                    <div class="new_lady"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/heart-new.png" alt="New"></div>
                                                <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Alina                            </a>
                            <div class="lady_age">Age: Early 30´s </div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Zurich, Basel, Bern, Geneva</div>
                        </div>
                    </li>
                     <li id="got_overlay" style="float: left; list-style: outside none none; position: relative; width: 300px;" class="bx-clone">
                        <a href="#">
                            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/model-listing/model-listing-20.jpg" alt="">
                        </a>
                           <div class="lady_overlay">
                            <a class="overlay-name" href="#">
                            Sasha                            </a>
                            <div class="lady_age">Age: 20</div>
                            <div class="trips">Worldwide</div>
                            <a class="button" href="#">
                                More
                            </a>
                            <div>Nuremberg, Frankfurt, Munich, Wiesbaden</div>
                        </div>
                       </li>
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



<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>
<?php
get_footer();
?>