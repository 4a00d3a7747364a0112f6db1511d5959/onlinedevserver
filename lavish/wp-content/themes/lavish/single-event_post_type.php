<?php
/**
 * Template Name: eventsinner Page
 */
get_header('model');
?>
<?php

while (have_posts()) : the_post();

the_content();
$pid = get_the_ID();
$title = get_the_title();
$event_date = get_post_meta($pid,'event_dates_date_of_event',true);

endwhile;
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
			
			
			}?>

<section id="model-booking" class="events-inner-box">
  
  <div class="model-booking-description">
  
    <h3> Event Booking </h3>
    
    <div class="container">
      <div class="model-booking-box">
        <?php echo(the_content()); ?>
        <div class="model-booking-box-btn">
         
            <div class="booking-form-div events-form-div">
                <form action="" method="post" onSubmit="return emailClicked();">
                  <div class="booking-box-left clearfix">
                   <li class="booking-box-field firstname">
                    <div class="vip-label">
                     <label> Your Full name <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="firstname_events" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field age">
                    <div class="vip-label">
                     <label> Age <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="age_events" placeholder="" value="" type="text" required> </div>
                   </li>
                    <li class="booking-box-field">
                    <div class="vip-label"> <label> Gender </label> </div>
                    <div class="vip-fields" id="gender_events"> 
                       <select>
						   <option value="-1" selected="selected">— Select —</option>
                         <option value="I’m a gentleman">I’m a gentleman</option>
                         <option value="I’m a lady">I’m a lady</option>
                         <option value="We are couple">We are couple</option>
                        </select> 
                    </div>
                   </li>
                   
                   <li class="booking-box-field email">
                    <div class="vip-label">
                     <label> Your E-mail <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="email_events" placeholder="" value="" type="text" required> </div>
                   </li>
                   
                   <li class="booking-box-field phn">
                    <div class="vip-label">
                     <label> Your phone number </label> </div>
                    <div class="vip-fields"> <input id="phn_events" placeholder="" value="" type="text"> </div>
                   </li>
                  
                   
                  

                  </div> 
                  <div class="booking-box-right clearfix">
					   <li class="booking-box-field mob_phn">
                    <div class="vip-label">
                     <label> Mobile phone number <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="mob_phn_events" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field address">
                    <div class="vip-label">
                     <label> Address <span class="required">*</span> </label> </div>
                    <div class="vip-fields"> <input id="address_events" placeholder="" value="" type="text" required> </div>
                   </li>
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Best times to call </label> </div>
                    <div class="vip-fields"> <input id="time_call_events" placeholder="" value="" type="text"> </div>
                   </li>
                     <li class="booking-box-field">
                    <div class="vip-label"> <label> Payment Method </label> </div>
                    <div class="vip-fields" id="payment_events"> 
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
                    <div class="vip-fields"> <input id="find_us_events" placeholder="" value="" type="text" required> </div>
                   </li>
                  
                   
                   <li class="booking-box-checkbox">
                     <span> 
                       <label>
                         <input name="wpuf_accept_toc_events" required="required" type="checkbox">
                       </label> 
                       </span> <p> Yes, I understand and agree to the Lavish Mate®. Terms of Service, including the Disclaimer and <a href="#">Privacy Policy. *</a> </p>

                   </li>
                  </div> 
                  
                  
                  <div class="booking-form-submit-btn">
                   <input name="submit_events" value="Submit" type="submit">
                  </div> 
                </form>
               </div>
          
        </div>
      </div>
      
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


jQuery('#firstname_events').val(usre_name);
jQuery('#email_events').val(usre_email);

jQuery('#phn_events').val(phone);
jQuery('#mob_phn_events').val(mobile_phone);
jQuery('#address_events').val(address);
jQuery('#age_events').val(age);


//~ jQuery('.firstname').hide();
//~ jQuery('.firstname_').hide();
//~ jQuery('.email').hide();
//~ jQuery('.email_').hide();
//~ jQuery('.conemail').hide();
//~ jQuery('.phn').hide();
//~ jQuery('.mob_phn').hide();
//~ jQuery('.address').hide();
//~ jQuery('.age').hide();
//~ jQuery('.nationality').hide();

			</script>
			<?php
			
		}
		?>
<script type="text/javascript">
	
function emailClicked() 
{
	var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
	var event_name = '<?php echo $title; ?>';
	var first_name_events = $('#firstname_events').val();
	var age_events = $('#age_events').val();
	var email_events = $('#email_events').val();
	var phn_events = $('#phn_events').val();
	var mob_phn_events = $('#mob_phn_events').val();
	var address_events = $('#address_events').val();
	
	var gender_events = $( "#gender_events option:selected" ).text();
	var payment_events = $( "#payment_events option:selected" ).text();
	
	var find_us_events = $('#find_us_events').val();
	if(first_name_events !='' && age_events!=''  && email_events !='' && mob_phn_events !='' && address_events!=''  && gender_events!='' && payment_events!='' && find_us_events!='')
	{
	
	var data = {
        action: 'get_booking_events',
		dataType: 'json',
		event_name:event_name,
		first_name_events: first_name_events,
		age_events: age_events,
		gender_events: gender_events,
		email_events:email_events,
		phn_events:phn_events,
		mob_phn_events:mob_phn_events,
		address_events:address_events,
		payment_events:payment_events,
	    find_us_events:find_us_events
	   
	    
    };
	$.post(ajaxurl, data, function(response) {
		alert(response); 
		
		//~ window.location.href  = "http://onlinedevserver.biz/dev/lavish/dashboard/";
     
   });
  }
  else
  {
    //alert("Please Fill the Form Successfully");	
  }
  return false;
}

</script>

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>
<?php
get_footer();
?>
