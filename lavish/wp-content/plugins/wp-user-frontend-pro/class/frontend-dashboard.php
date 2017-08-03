<?php

/**
 * Dashboard class
 *
 * @author Tareq Hasan
 * @package WP User Frontend
 */
class WPUF_Frontend_Dashboard {

    function __construct() {
        add_shortcode( 'wpuf_dashboard', array($this, 'shortcode') );
    }

    /**
     * Handle's user dashboard functionality
     *
     * Insert shortcode [wpuf_dashboard] in a page to
     * show the user dashboard
     *
     * @since 0.1
     */
    function shortcode( $atts ) {

        extract( shortcode_atts( array('post_type' => 'post'), $atts ) );

        ob_start();

        if ( is_user_logged_in() ) {
            $this->post_listing( $post_type );
        } else {
            $message = wpuf_get_option( 'un_auth_msg', 'wpuf_dashboard' );

            if ( empty( $message ) ) {
                $msg = '<div class="wpuf-message">' . sprintf( __( "This page is restricted. Please %s to view this page.", 'wpuf' ), wp_loginout( get_permalink(), false ) ) . '</div>';
                echo apply_filters( 'wpuf_dashboard_unauth', $msg, $post_type );
                wp_login_form();
            } else {
                echo $message;
            }
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * List's all the posts by the user
     *
     * @global object $wpdb
     * @global object $userdata
     */
    function post_listing( $post_type ) {
        global $post;

        $pagenum = isset( $_GET['pagenum'] ) ? intval( $_GET['pagenum'] ) : 1;

        //delete post
        if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == "del" ) {
            $this->delete_post();
        }

        //show delete success message
        if ( isset( $_GET['msg'] ) && $_GET['msg'] == 'deleted' ) {
            echo '<div class="success">' . __( 'Post Deleted', 'wpuf' ) . '</div>';
        }

        $args = array(
            'author' => get_current_user_id(),
            'post_status' => array('draft', 'future', 'pending', 'publish', 'private'),
            'post_type' => $post_type,
            'posts_per_page' => wpuf_get_option( 'per_page', 'wpuf_dashboard', 10 ),
            'paged' => $pagenum
        );

        $original_post = $post;
        $dashboard_query = new WP_Query( apply_filters( 'wpuf_dashboard_query', $args ) );
        $post_type_obj = get_post_type_object( $post_type );

        //~ wpuf_load_template( 'dashboard.php', array(
            //~ 'post_type' => $post_type,
            //~ 'userdata' => wp_get_current_user(),
            //~ 'dashboard_query' => $dashboard_query,
            //~ 'post_type_obj' => $post_type_obj,
            //~ 'post' => $post,
            //~ 'pagenum' => $pagenum
        //~ ) );

        wp_reset_postdata();

        $this->user_info();
    }

    /**
     * Show user info on dashboard
     */
    function user_info() {
        global $userdata;

        if ( wpuf_get_option( 'show_user_bio', 'wpuf_dashboard', 'on' ) == 'on' ) {
            ?>
             <link rel="stylesheet" type="text/css"  href="<?php echo esc_url( get_template_directory_uri() )?>/css/vertical-tab.css">

<section id="members-dashboard" class="members-dashboard-div">
<!--
   <div class="members-dashboard-heading-tag">
     <div class="container">
       <ul>
        <li>Book a new model</li>
        <li>My VIP plan</li>
        <li>My upcoming events</li>
       </ul>
     </div>  
   </div>
-->
<?php 

$role = implode(', ', $userdata->roles);
if($role == "Model")
{
	$url_cal = esc_url(home_url())."/calendar";
	header('Location: '.$url_cal);  
	
}

?>
   <div class="container">
     <div class="members-dashboard-box clearfix">
       
     <div class="vertical-tab">
     <ul class="tabs">
      <li class="vertical-panel active" rel="tab1">My Info <span> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/dashboard-icon-1.png" alt=""> </span></li>
      <li class="vertical-panel" rel="tab2">Previous History <span> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/dashboard-icon-2.png" alt=""> </span></li>
      <li class="vertical-panel" rel="tab3">Payment Methods<span> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/dashboard-icon-3.png" alt=""> </span></li>
     </ul>
    <div class="tab_container">
      <div class="d_active tab_drawer_heading" rel="tab1">
       <h3> My Info </h3>
      </div>
      
      <div id="tab1" class="tab_content">
       <div class="payment-method-box clearfix">
        <div class="payment-method-client">
          <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/dashboard-client.png" alt="">
        </div>
        <div class="payment-method-client-content">
			<?php
			
			//print_r($userdata);
			?>
         <h3> <?php printf( esc_attr__( '%s', 'wpuf' ), $userdata->display_name ); ?> </h3>
         <h4> <?php printf( esc_attr__( '%s', 'wpuf' ), $userdata->user_nicename ); ?> </h4>
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
            <td data-th="Client name/User name"> <strong><?php printf( esc_attr__( '%s', 'wpuf' ), $userdata->display_name ); ?> </br>
<?php printf( esc_attr__( '%s', 'wpuf' ), $userdata->user_nicename ); ?></strong></td>
            <td data-th="Address">
<?php echo esc_attr( get_the_author_meta( 'address', $userdata->ID ) ); ?></td>
            <td data-th="Phone"><?php echo esc_attr( get_the_author_meta( 'phone', $userdata->ID ) ); ?></br>
                <?php echo esc_attr( get_the_author_meta( 'mobphone', $userdata->ID ) ); ?> </td>
            <td data-th="Email" class="payment-email"> <?php printf( esc_attr__( '%s', 'wpuf' ), $userdata->user_email ); ?> </td>
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
  <div class="tab_drawer_heading" rel="tab2"><h3>Previous History </h3></div>
  <div id="tab2" class="tab_content">
    <div class="dashboard-get_option">
      <div class="dashboard-box">
		  <table class="rwd-table dashboard-member-details" cellpadding="0" cellspacing="0" width="100%">
                      <tr class="odd">
                        <th>Model</th>
                        <th>Dress style</th>
                        <th>Location</th>
                        <th>Hotel#</th>
                        <th>Date of meeting</th>
                        <th>Time of meeting</th>
                        <th>Duration</th>
                        <th>Message</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                      </tr>
                      
                      
		  
                
    <?php
$args = array(
	
	's' => $userdata->display_name,
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
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	//print_r($recent_posts);
	$url = "http://onlinedevserver.biz/dev/lavish/payment-vip?pid=".$recent_posts['ID'];
	//print_r($recent_posts['ID']);
	
	$class_name="";
	
	if($j%2==0)
	{
		$class_name="odd";
	}
	else
	{
		$class_name = "even";
	}?>
	
	<tr class="<?php echo $class_name;?>">
                        <td data-th="Model" class="dashbord-model-name">
                          <h5><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_desired_mate', true ); ?></h5>
                          <p> Age <?php echo get_post_meta( $recent_posts['ID'], 'extra_profile_fileds_age', true ); ?> </p>
                          <a href="<?php echo $url;?>"> Book <?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_desired_mate', true ); ?> again ?</a>
                        </td>
                        <td data-th="Dress style"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_dress_style', true ); ?> </td>
                        <td data-th="Location">Hotel visit</td>
                        <td data-th="Hotel#"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_hotel_room', true ); ?></td>
                        <td data-th="Date of meeting"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_date_of_meeting', true ); ?></td>
                        <td data-th="Time of meeting"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_time_of_meeting', true ); ?> </td>
                        <td data-th="Duration"><?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_duration', true ); ?></td>
                        <td data-th="Message"> 
                         <p> <?php echo get_post_meta( $recent_posts['ID'], 'booking_forms_what_is_your_desired_message_for_your_mate_', true ); ?></p>
                        </td>
                        
                        <td data-th="Payment Status"> 
                         <p> <?php 
                         
								if(get_post_meta( $recent_posts['ID'], 'booking_forms_payment_status', true ) == "1")
								{
									echo get_post_meta( $recent_posts['ID'], 'booking_forms_payment_status', true ); 
								}
							else
							{
								$yrl = "http://onlinedevserver.biz/dev/lavish/payment-vip?pid=".$recent_posts['ID'];
								?>
								<a href="<?php echo $yrl; ?>"> Go For Payment </a>
						<?php
							}
                         
                         ?>
                         </p>
                        </td>
							
						<td data-th="Booking Status"> 
                         <p> <?php 
                         
							if(get_post_meta( $recent_posts['ID'], 'booking_forms_payment_status', true )=="")
							{
								echo "pending";
							}
							else
							{
								echo get_post_meta( $recent_posts['ID'], 'booking_forms_payment_status', true ); 
							}
                         ?>
                         </p>
                        </td>	
                     
                      </tr>  
	
	<?php
	$j++;  
}
?>                  
                      
                 </table>
                </div>          
    </div>
  </div>
  <!-- #tab2 -->
  <div class="tab_drawer_heading" rel="tab3"><h3> Payment Methods </h3></div>
  <div id="tab3" class="tab_content">
       <div class="payment-method-box">
       <h3> Payment  Methods </h3>
       <a href="#"> Add  payment method </a>
      </div>
       <div class="billing-payment-box">
       <h3> Billing & Payment Processing </h3>
      </div>
       <div class="payment-info-box">
        <table class="rwd-table" cellpadding="0" cellspacing="0">
          <tr class="payment-info-box-top">
            <th>Payment method</th>
            <th>Actions</th>
            <th>Actions</th>
          </tr>
          <tr>
            <td data-th="Payment method"><span><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/payment-icon.png" alt=""></span>Visa ending in 4650</td>
            <td data-th="Actions"><a href="#">Edit | remove</a></td>
            <td data-th="Actions">Primary </td>
          </tr>
          <tr class="payment-info-box-bottom">
            <td data-th="Payment method"><span><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/payment-icon.png" alt=""></span>Visa ending in 7474</td>
            <td data-th="Actions"><a href="#">Edit | remove</a></td>
            <td data-th="Actions">Set as primary</td>
          </tr>
        </table>
        <p> We accept all major credit cards, as well as electronic transfers and cash payments
We accept the following credit cards </p>
         <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/credit_grey.png" alt="">
         <p> Extra 5 % handling fee </p>
         <p class="payment-info-box-personal"> XE Personal Currency Assistant </p>
      </div>
  </div>
  <!-- #tab3 -->
  
</div>
    
</div>

            <?php
        }
    }

    /**
     * Delete a post
     *
     * Only post author and editors has the capability to delete a post
     */
    function delete_post() {
        global $userdata;

        $nonce = $_REQUEST['_wpnonce'];
        if ( !wp_verify_nonce( $nonce, 'wpuf_del' ) ) {
            die( "Security check" );
        }

        //check, if the requested user is the post author
        $maybe_delete = get_post( $_REQUEST['pid'] );

        if ( ($maybe_delete->post_author == $userdata->ID) || current_user_can( 'delete_others_pages' ) ) {
            wp_delete_post( $_REQUEST['pid'] );

            //redirect
            $redirect = add_query_arg( array('msg' => 'deleted'), get_permalink() );
            wp_redirect( $redirect );
        } else {
            echo '<div class="error">' . __( 'You are not the post author. Cheeting huh!', 'wpuf' ) . '</div>';
        }
    }

}
