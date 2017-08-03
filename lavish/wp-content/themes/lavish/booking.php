<?php
/**
 * Template Name: booking Page
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
<section id="booking-about" class="booking-about-div">
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
    <div class="booking-details-top">
      <h3> Book Your Lavish Mate® </h3>
      <h3> Model Now </h3>
      
     <div class="booking-details-content">
      <p> The need for reservations is very high at Lavish Mate®. Since we work with escort models that are well established in their personal and professional life, it is important that they be informed 
beforehand of any date/ travel engagement that you might be looking forward to. In our exclusive VIP member lounge we provide pictures of our charming ladies where you 
may admire also their beautiful faces; this helps you to choose one of the fascinating models for an unforgettable date. </p>
      <p> The beautiful and alluring Lavish Mate ® models also travel companions love to escort you somewhere new, and always enjoy a chance to venture out of their locale and savor an extended travel 
assignment with you. Whether you're booking 6 hours for a coast-to-coast business trip, or a multi-day indulgence, we can definitely assist you. Perhaps you're seeking a revitalizing 
weekend away, or a relaxing vacation for a few weeks? Regardless of your timing, we'll do our best to accommodate your schedule and preferences for companionship. Your time 
will be fondly remembered.As soon as you become a client of our high-class escort agency we offer you free access promptly and smoothly, have a nice time in the member lounge. </p>
     </div> 
      
    </div>
    
  </div>
</section>

<section id="booking-login-details" class="booking-login-details-div">
  <div class="booking-login-details-box">
    <ul class="accordion">
      <li>
            <div class="accordion-tab">
             Login Details
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <div class="booking-login-form">
                  <form>
                   <div class="login-box-field">
                    <div class="vip-label">
                     <label> User Id <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </div>
                   <div class="login-box-field">
                    <div class="vip-label">
                     <label> Password <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input placeholder="" value="" type="text" required> </div>
                   </div>
                   <div class="login-box-submit-btn">
                    <input name="submit" value="Submit" type="submit">
                   </div> 
                  </form>
                 </div>
               </div>
             </div> 
            </div> 
        </li>
    </ul>
    
    <div class="login-content-box">
     <div class="container">
      <p> We would like to thank you in advance for your trust and look forward to answering your booking inquiry immediately and discreetly.
Please note that online booking requires 2 hours in advance in order to process for our operators. If you would like to let us know any of your wishes please use the required forms attached. </p>

      <div class="casting-tab">
        <ul>
        <li>
        <a class="casting-tab-name" href="#">Personal Info</a>
        </li>
        <li>
        <a class="casting-tab-name" href="#">About your mate</a>
        </li>
        <li>
        <a class="casting-tab-name" href="#">Credit card info</a>
        </li>
        </ul>
      </div>

     </div>
    </div>
    
  </div>
</section>

<section id="model-booking" class="booking-div">
  
  <div class="model-booking-description">
  
    <h3> BOOKING FORM </h3>
    
    <div class="container">
      <div class="model-booking-box">
        <?php echo(the_content()); ?>
        <div class="model-booking-box-btn">
         
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
                   
                   <li class="booking-box-field location">
                    <div class="vip-label">
                     <label> Location <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="location" placeholder="" value="" type="text" required> </div>
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
                         <option value="<?php print_r($recent_posts['post_title'] );?>"><?php print_r($recent_posts['post_title'] );?></option>
                         
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
      
    </div>
  </div>
  
</section>

<section id="lavish-free-guide" class="lavish-free-guide-div">
 <div class="lavish-free-guide-box">
    <div class="lavish-free-guide-content">
      <div class="container">
        <h3> Lavish Mate fees guide </h3>
        <p> Lavish Mate® luxury escort agency accepts cash or credit card to settle your account for your time with your elite date. For travel companion appointments, pre-payment is required 
(minimum 2-5 days before flights). You can view all the actual fee schedules above. </p>
        <p> Our elegant companions are available to travel worldwide. Whether throughout United State, or to Europe, Middle East or Oceania (Asia/ Australia/ New Zealand), we will have an 
extraordinary, upscale woman who can make your time unforgettable. Our model escort companions are frequently called to international locations please see our Gentleman FAQ 
for more details on booking a beautiful experience with one of our gorgeous angels. </p>
      </div>
    </div>
    <div class="lavish-free-guide-details">
     <ul class="accordion">
      <li>
            <div class="accordion-tab">
              Booking Details
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> When you're ready to make an appointment, please contact our friendly helpful booking agents, and inquire whether the model you have in mind is available. We will be delighted to discuss your needs and recommend the most suitable companion escort for you. We can also help you in deciding on the most appropriate restaurant or venue to bring your date for dinner. </p>
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
              Booking your companion of choice
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> Your companion can meet you at a pre-planned venue or public event, however we recommend meeting at your hotel room so you can make payment before the date starts. This is to ensure privacy and confidentiality and to get your date off to the best possible start. </p>
                 <p> While we go out of our way to meet our clients’ needs there are rare occasions when a companion is not available. Our companions are autonomous people, not objects. In the event that your desired companion is not available for your preferred date, we request some flexibility, either in terms of the timing of the date or the companion in question. </p>
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
              Your Obligations
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> Please ensure you approach the agency and the companions as a gentleman. We are selective, and will have no hesitation to politely decline your business if you are not behaving as a man of honor. We reserve the right to refuse the business of any caller. Our agency exists exclusively to cater for the most refined and high-quality clientele only. Our elite female companions definitely have no need or desire to be ‘busy'; they prefer to exchange energies with just a select few tasteful, appreciative souls, for mutually enjoyable engagements. </p> 
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
              Models Attire
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> The Lavish Mate® ladies are always attired impeccably; attractive yet discreet. Presentation is a priority for the high class women with whom we work, and looking ‘obvious’ is never an option. If you have any preferences as to the type of attire you prefer, in terms of style, color etc., please feel free to let us know. Your elite companion will do her best to accommodate your every preference, within reason. </p>
               </div>
             </div> 
            </div> 
        </li>
      <li>
            <div class="accordion-tab">
              Working with the best in the world
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p> As a global leader in the companion industry Lavish Mate® has a database of thousands of international clients. We have achieved this through our high-end service and high levels of discretion and confidentiality. We also believe that variety is the spice of life, and provide a diverse selection of companions for our clientele to choose from. We put as much emphasis on looks as we do on education, confidence and personality because these are the key ingredients for you to have a good time. Our intensive screening process ensures that our companions have the intelligence and beauty that discerning gentlemen look for in women. </p>
                 <p> We are pleased to partner with you for exclusive and private dates to the theater and opera, visits to the spa, dinner dates, weekends away and extended vacations. Should you wish to book a travel companion Lavish Mate® will happily make the arrangements on your behalf. <p>
                 <p> Wherever you choose to go, the experience will revolve around you and your needs. Our beautiful models will ensure you are always the center of attention. We aim to exceed our clients’ expectations every time, and considering how long some of our clients have been with us, this is a tall order! </p>
                 <p> Our exclusive concierge service will take you to your desired location, whether in a chauffeured car or chartered jet or helicopter. Experience the world from a new level of luxury. Look through our selection of gorgeous companions and book your date now. </p>
                 <p> For your convenience booking requests can be submitted by chat, email or telephone. Please note that the text booking service is reserved for existing clients only. We will do our best to assist with last minute bookings. </p>
                 <p> <strong> You can send us your booking request via e-mail, chat and/or of course for telephone booking you can reach us 24/7; Text booking is for existing clients only. We will do our best to make your last minute booking possible! </strong> </p>
               </div>
             </div> 
            </div> 
        </li>
    </ul>
    </div>
 </div>   
</section>

<section id="booking-copy-space" class="booking-copy-space-div">
  <div class="container">
   <div class="copy-space-box">
     <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish mate-copyscape-2.png" alt="" />
     <p> Life is short. Have some pleasure </p>
     <p> Voted the world’s #1 elite escort agency with premium discretion </p>
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
<?php
get_footer();
?>
