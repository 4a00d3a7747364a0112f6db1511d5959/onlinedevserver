<?php
/**
 * Template Name: vipmessage Page
 */
get_header('vipmessage');

 $uid = $_REQUEST['uid'];

global $wpdb;

$sql = "Select * from `lav`.`wp_vip_accounts` where `vip_user_id`=$uid;";

 $applications = $wpdb->get_results($sql);

    foreach ( $applications as $application ) {
    $customer_vid = $application->vip_account_id;
       $first_name =   $application->vip_first_name;
       $last_name =    $application->vip_last_name;
       $address =      $application->vip_address;
       $city =         $application->vip_city;
       $zipcode =      $application->vip_zipcode;
       $email =        $application->vip_email;
       $phone =        $application->vip_phone;
       $mobile_number =$application->vip_mob_num;
       $email = $application->vip_email;
      $package_name = $application->vip_total_package;
 }

?>

<section class="main-vip-message-bg">
    <div id="hello-dear" class="luxury-vip-div">
     <div class="luxury-vip-box">
      <div class="container">
        <div class="hello-dear-box">
          <h3> Congratulations <?php echo $first_name;?> You Have Become: </h3>
          <h3> A LUXURY VIP Member <span> placed on 12/23/2016 </span> </h3>
          <div class="luxury-vip-top-text">
          <p> We wanted to let you know that we're working on your VIP Luxury Package arrangement right now. If you have questions 
about your VIP programs, call 1-866-662-3669 or visit your booking details page.</p>
          </div>
          <p> We are dedicated to ensuring privacy and discretions is guaranteed , First and foremost, we promise 100% discretion and confidentiality forever. All our staff sign legal non-disclosure agreements, and we give our word to NEVER disclose 
the details of our clients, ever. How common, to stoop so low as to use someone else's trust in one, to gain notoriety or income! </p>
        </div>
      </div>
     </div> 
    </div>
    
    <div id="application-details" class="application-details-div">
     <div class="container">
      <div class="application-details-box">
       <div class="application-details-heading">
        <h1> booking details </h1>
       </div> 
      </div>      
     </div>
     <div class="application-details">
       
        <div class="application-detail-top">
         <p> Lavish Mate® motto is to treat every client like he is our only client. The agency provides 
more than just another millionaire dating service. Introducing you to fresh, refined 
companions internationally, you can be assured of excellence.  Hire a girlfriend today to 
create your own special memories.  </p>
          
         <div class="vip-luxury-package-div clearfix">
           <h4> VIP Luxury-Package  </h4>
           <h4> to: </h4>
           <div class="vip-luxury-package-div-left">
            <p> 1020 South Federal HWY </p>
            <p> Boca Raton, FL 33432 </p>
            <p> Phone: 561-692-3388 </p>
           </div>
            <div class="vip-luxury-package-div-right">
            <p> The Platinum VIP  </p>
            <p> With All 12 months  </p>
            <p> Regular Benefits Plus: </p>
           </div>
         </div>         
       
       </div>
       
       <div class="application-detail-bottom">
         
          <h1> good to know </h1>
          <div class="application-detail-bottom-list">
           <ul>
            <li> Want to know how our refund work? View our <span> Privacy policy. </span> </li>
            <li> our card will be will fully charged  for the VIP package. Prices are also confirmed at these times. </li>
            <li> f you activate a new card after you've placed a booking with the old card, but before the 
model is dispatched or emailed, your date with our mate will be canceled.  </li>
            <li> We'll call you or send you an email as soon as the account (s) are ready for booking  
your first date adventure.  </li>
            <li> Booking can be canceled by calling our office. Have more questions about your mate? <span> Visit our models help page. </span> </li>
           </ul>
          </div>
          
          <p> We do not confirm the booking price or charge your card until your date end, final price will be confirm when the escort model call our office to confirm the exact final time the date ended. This escort companion booking acknowledgement 
email simply means that your booking request has been received; it does not mean that your booking has been accepted for 
the booking date has picked, is the model ready to dispatch right away, or that the price or availability of the model has been 
confirmed </p>
          <p> This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message. </p>
          
          <div class="vip-message-footer">
            <p> © 2016 lavishmate.com. Lavish Mate are registered trademarks of Lavish Mate All rights reserved. </p>

          </div>
          
        </div>
        
      </div> 
    </div>
    
</section>
   



