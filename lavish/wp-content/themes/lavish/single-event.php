<?php
/**
 * Template Name: eventsinner Page
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
                   
                  

                  </div> 
                  <div class="booking-box-right clearfix">
                   <li class="booking-box-field">
                    <div class="vip-label">
                     <label> Best times to call </label> </div>
                    <div class="vip-fields"> <input id="time_call_events" placeholder="" value="" type="text"> </div>
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
var nationality = '<?php echo $nationality; ?>';

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
