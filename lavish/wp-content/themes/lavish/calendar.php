<?php
/**
 * Template Name: calendar Page
 */
 
get_header('small');
?>
<?php

if ( is_user_logged_in() ) 
  {
   $login =1;
  } 

?>
<?php
if($login == 1)
{
while (have_posts()) : the_post();

the_content();
$pid = get_the_ID();

endwhile;
?>

<link rel="stylesheet" type="text/css"  href="http://onlinedevserver.biz/dev/lavish/wp-content/themes/lavish/css/vertical-tab.css">

<?php

global $userdata;
?>
<section id="members-dashboard" class="members-dashboard-div">
   <div class="container">
     <div class="calendar-heading-box">
      <div class="calendar-heading-box-right">
       <h4> Welcome <?php echo $userdata->display_name;?> </h4>
       <p> We require that you are discreet, sensual, honest, and flexible display the utmost respect to our client. In return, you will enjoy rare access to the 
exclusive lifestyle of high society
       </p>
       <p> We expect that all of our ladies will be exclusively signed to our agency and do not have backgrounds in the adult industry or elsewhere 
that might cause our clients embarrassment </p>
<h4> At Lavish Mate we recognize your marvelous warmth service our gratitude toward you is priceless </h4>
       <p> Thank you </p>
       <p> Kristen </p>
       <p> Manager </p>
      </div>
     </div>
     <div class="members-dashboard-box clearfix">
       
      <div class="vertical-tab">
      <ul class="tabs">
       <li class="vertical-panel active" rel="tab1">My Info <span> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/info-leady.png" alt="info leady" > </span></li>
       <li class="vertical-panel" rel="tab2">My Calendar <span> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/calendar-icon.png" alt="calendar" > </span></li>
     </ul>
     </div> 
      <div class="tab_container">
      <div class="d_active tab_drawer_heading" rel="tab1">
       <h3> My Info </h3>
      </div>      
      <div id="tab1" class="tab_content">
       <div class="payment-method-box clearfix">
        <div class="payment-method-client">
           <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/ladey-info.png" alt="ladey info" >
        </div>
        <div class="payment-method-client-content">
	      <h3> <?php echo $userdata->display_name;?> </h3>
          <h4> <?php echo $userdata->user_login;?> </h4>
        </div> 
       </div>
       <div class="billing-payment-box">
       <h3> Account Details </h3>
      </div>
       <div class="payment-info-box">
        <table class="rwd-table" cellpadding="0" cellspacing="0">
          <tr class="payment-info-box-top">
            <th>Client name/User name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
          </tr>
          <tr>
            <td data-th="Client name/User name"> <strong><?php echo $userdata->display_name;?> </br>
<?php echo $userdata->user_nicename;?></strong></td>
            <td data-th="Address">
<?php echo esc_attr( get_the_author_meta( 'address', $userdata->ID ) ); ?></td>
            <td data-th="Phone"><?php echo esc_attr( get_the_author_meta( 'phone', $userdata->ID ) ); ?></br>
                <?php echo esc_attr( get_the_author_meta( 'mobphone', $userdata->ID ) ); ?> </td>
            <td data-th="Email" class="payment-email"> <?php echo $userdata->user_email;?> </td>
          </tr>
          <tr class="payment-info-box-bottom">
            <td data-th="Client name/User name"> </td>
            <td data-th="Address"><a href="http://onlinedevserver.biz/dev/lavish/wp-admin/profile.php">Edit</a></td>
            <td data-th="Phone"><a href="http://onlinedevserver.biz/dev/lavish/wp-admin/profile.php">Edit</a></td>
            <td data-th="Email"><a href="http://onlinedevserver.biz/dev/lavish/wp-admin/profile.php">Edit</a></td>
          </tr>
        </table>
        
        <div class="Back-to-Escort-Ladies-btn">
          <a href="http://onlinedevserver.biz/dev/lavish/escort-ladies/"> Back to Escort Ladies </a>
        </div>
        
      </div>
       
      </div>
     <!-- #tab1 -->
      <div class="tab_drawer_heading" rel="tab2"><h3>My Calendar </h3></div>
      <div id="tab2" class="tab_content">
    <div class="dashboard-get_option">
      <div class="dashboard-box">
		  
		  <table class="rwd-table dashboard-member-details" cellpadding="0" cellspacing="0" width="100%">
			  <tr class="odd">
                        <th>Client Name</th>
                        <th>Dress style</th>
                        <th>Date Location</th>
                        <th>Type</th>
                        <th>Date of meeting</th>
                        <th>Time of meeting</th>
                        <th>Duration</th>
                        <th>Message</th>
                      </tr>
			  
			  <?php
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'ASC',
	'order' => 'ASC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'booking_post_type',
	
	
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );

$input = array();
foreach($recent_posts as $recent_posts)
{
	$mate_name = get_post_meta( $recent_posts['ID'], 'booking_forms_desired_mate', true );
	$j=1;
	if($mate_name == $userdata->display_name)
	{
		$class_name="";

		if($j%2==0)
		{
		$class_name="odd";
		}
		else
		{
		$class_name = "even";
		}
		$j++;?>
		
		<tr class="<?php echo $class_name;?>">
                        <td data-th="Model" class="dashbord-model-name">
                          <h5><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_first_name', true ); ?></h5>
                          <p>Age <?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_age', true ); ?></p>
                        </td>
                        <td data-th="Dress style"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_dress_style', true ); ?> </td>
                        <td data-th="Location"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_hotel_room', true ); ?></td>
                        <td data-th="Type"></td>
                        <td data-th="Date of meeting"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_date_of_meeting', true ); ?></td>
                        <td data-th="Time of meeting"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_time_of_meeting', true ); ?> </td>
                        <td data-th="Duration"><?php $dur = get_post_meta( $recent_posts['ID'], 'booking_forms_duration', true ); 
                        
                        $dur = explode(":",$dur);
                        echo $dur[0];
                        ?></td>
                        <td data-th="Message"> 
                         <p><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_what_is_your_desired_message_for_your_mate_', true ); ?> </p>
                        </td>
                      </tr>  
		

<?php	}
	
}
?>
			  
			        
                 </table>
      </div>          
    </div>
  </div>
  <!-- #tab2 -->
  </div>
    
     </div>
   </div>
</section>


<?php
get_footer();
}

else
{
	$url = esc_url(home_url())."/dashboard";
	
	 header('Location: '.$url);   
	
}


?>
