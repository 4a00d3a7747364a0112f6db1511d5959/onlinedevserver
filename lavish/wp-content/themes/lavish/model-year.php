<?php
/**
 * Template Name: modelofyear Page
 */
get_header();
?>
<?php
	 $brand_name = "mate-of-the-year";
	 $original_query = $wp_query;
$wp_query = null;
$args=array('posts_per_page'=>1,'post_type' => 'casting_members', 'tag' => $brand_name);
$wp_query = new WP_Query( $args );
if ( have_posts() ) :

    while (have_posts()) : the_post();
    
    $post_id = get_the_ID();
  $post_title = get_the_title( $post_id );
     
    ?>
    <?php endwhile;
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();
	 
	 ?>
	 
	 <?php //echo $post_id; ?>
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
			
			
			}?>
			

<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
				//echo get_the_ID();
				echo the_content();	
				endwhile; // End of the loop.
			?>

<!--Mate of the year and mate of the month section-->
<section id="home-model" class="home-model-div escort-model-of-year-div">
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

<?php echo get_option('webq_mate_extra');?>

<section id="more-about-me" class="more-about-me-div">
  <div class="container clearfix">
    <a href="#"> More About me </a>
  </div>
</section>

<!---Others model section--->
<section id="model-view" class="model-view-div model-of-year-listing-box">
   
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
   <div class="Latest-about-me">
     <a href="#"> Latest about me </a>
   </div>
   <div class="Latest-about-me-contant-box">
    <p> Exclusive videos about Lavish Mate models of the year, </p>
    <p> nightlife, VIP entertainment & lifestyle.... </p>
   </div>
  </div>
 </div>
</section>

<section id="model-listing" class="model-listing-div model-of-year-listing-slider">
  <div class="block-lady_list">
    <div class="strip-full"><h3><span class="left-right slider-custom-left"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/left-arrow.png" alt="left" border="0"></span> Special About Me <span class="left-right slider-custom-right"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/right-arrow.png" alt="right" border="0"></span></h3></div>
    <div class="wrap-thumbs">
        <div class="bx-wrapper">
          <div class="bx-viewport flexslider">
             <ul class="lady_list slides">
         
                  <?php
									
$login=0;
		if ( is_user_logged_in() ) 
		{
			
			$images = get_post_meta( $post_id, 'all_images_slider_images_full_body' );
		} 
		else 
		{
			$images = get_post_meta( $post_id, 'all_images_slider_images' );
		}									
									
									


if ( $images ) {
	$j=0;
    foreach ( $images as $attachment_id ) {
      
        $thumb = wp_get_attachment_image( $attachment_id, 'full' );
        $full_size = wp_get_attachment_url( $attachment_id ); ?>

			  <li id="got_overlay">
                        <a href="#">
                            <img src="<?php echo $full_size;?>" alt="">
                        </a>
                        
                        <div class="lady_overlay flex-caption">
                            <a class="overlay-name" href="#">
                                                       
                            </a>
                            <div class="lady_age">Age:  </div>
                            <div class="trips">Worldwide</div>
                            
                            <div></div>
                            <a class="button" href="">
                                More
                            </a>
                        </div>
                  
                    </li>
   <?php  $j++; }
}

?>
                    
                   
                     </ul>
                    </div>
                      
                    </div>
    </div>
</div>
</section>

<section id="more-about-me" class="more-about-me-div book-me-div">
  <div class="container clearfix">
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
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Age <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="age" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
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
                   <li class="booking-box-field">
                    <div class="vip-label"> <label> Desired Mate </label> </div>
                    <div class="vip-fields" id="mate"> 
                       <select class="select_field">
						   <?php $brand_name_year = "mate-of-the-year";
	 $original_query = $wp_query;
$wp_query = null;
$args=array('posts_per_page'=>1,'post_type' => 'casting_members', 'tag' => $brand_name_year);
$wp_query = new WP_Query( $args );
if ( have_posts() ) :

    while (have_posts()) : the_post();
    ?>
                         <option value="<?php the_title();?>"><?php the_title();?></option>
                         <?php endwhile;
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();
	 
	 ?>
                     
                       </select> 
						<?php
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); 

							if( class_exists('Dynamic_Featured_Image') ) 
							{

								global $dynamic_featured_image;

								$featured_images = $dynamic_featured_image->get_featured_images($post_id );

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
						   <option value="-1" selected="selected">— Select —</option>
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
						   <option value="-1" selected="selected">— Select —</option>
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
    <p> To expereience the most exclusive girlfriend encounter and </p>
    <p> the most elite moment of your life, </p>
  </div>
</section>
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

jQuery('#firstname').val(usre_name);
jQuery('#firstname_').val(usre_name);
jQuery('#email').val(usre_email);
jQuery('#email_').val(usre_email);
jQuery('#conemail').val(usre_email);
jQuery('#phn').val(phone);
jQuery('#mob_phn').val(mobile_phone);
jQuery('#address').val(address);

jQuery('.firstname').hide();
jQuery('.firstname_').hide();
jQuery('.email').hide();
jQuery('.email_').hide();
jQuery('.conemail').hide();
jQuery('.phn').hide();
jQuery('.mob_phn').hide();
jQuery('.address').hide();

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
	
	if(first_name !='' && age!='' && nationality !='' && email !='' && mob_phn !='' && address!='' && zip!='' && message!='')
	{
	
	var data = {
        action: 'get_booking',
		dataType: 'json',
		first_name: first_name,
		age: age,
		nationality: nationality,
		
		email:email,
		conemail:conemail,
		phn:phn,
		
		
		mob_phn:mob_phn,
		address:address,
		city:city,
		
		zip:zip,
		hotel:hotel,
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


<?php get_footer();?>
