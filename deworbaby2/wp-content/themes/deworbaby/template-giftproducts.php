<?php
/*
Template Name: Gift Products
*/

get_header(); 

?>
<!-- slider -->
<section class="sliderSec clearfix">
  <div class="slider-container">  
        <div class="slider" >    
          <div class="slide">    
            <img src="<?php echo get_template_directory_uri(); ?>/images/gift-banner.jpg" alt=""> 
            <div class="overlay">
                  
            </div>
              <div class="caption">
                <div class="capContent container">
                    <div class="maincaptionHolder">
                      <div class="mainCapInner">
                        <h1>Share The Love </h1>
                        <p>Surprise your littleone with thegift of softness. Let them discover  the experience of our </p>
                        <p>bamboo diapers. </p>
                        <a href="javascript:void(0)" class="btn show_now hvr-shutter-out-horizontal banner_text blue_btn"><span class="hvr-shutter-out-horizontal blue_btn">Gift A Box Today</span></a>
                        <a href="<?php echo get_permalink(459); ?>" class="btn show_now hvr-shutter-out-horizontal banner_text"><span class="hvr-shutter-out-horizontal"><?php echo get_the_title(459); ?> </span></a>
                      </div>
                    </div>
                </div>
                
              </div> 
          </div>
        </div>
        
  </div>
</section>
<!-- slider ends -->
<!-- process -->
<section id="sub_process" class="gift-process">
  <div class="container clearfix">
      <div class="left-img">
        <img src="<?php echo get_template_directory_uri(); ?>/images/gift-left-img.jpg"/>
      </div>
      <div class="gift-right-process">
       <div class="process">

         <h2>STEPS TO EFFORTLESS GIFTING</h2>
         <p> Spoil your loved ones with gift that keeps on giving monthly. It is simple and fast.  </p>

         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo get_template_directory_uri(); ?>/images/gift-icon-1.png" alt="#">
                <div class="line"></div>
            </div>
            <div class="content">
               <h4>PLENTY TO CHOOSE</h4>
               <p>Give a Dewor Baby Subscription Gift Certificateto anyone that you choose. This can be redeemed for a 1, 3, 6, or 12-month subscription. Your lucky giftee decides when they want to start their subscription, and where they want the boxes sent. It's that easy!</p>
            </div>
         </div>
         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo get_template_directory_uri(); ?>/images/gift-icon-2.png" alt="#">
                <div class="line"></div>
            </div>
            <div class="content">
               <h4>SIMPLICITY OF GIVING</h4>
               <p>Provide us your lucky giftee's name and email address along with your wishful message, then we will send them a gift certificate to redeem in our web site. All they have to do is to enter their delivery address and a date to start their subscription.  Effortless!</p>
            </div>
         </div>
         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo get_template_directory_uri(); ?>/images/gift-icon-3.png" alt="#">

            </div>
            <div class="content">
               <h4>JOY OF RECEVING</h4>
               <p>Our gift subscription is just like being a regular subscriber except it does not automatically renew. Your giftee will have the comfort to customize their delivery and size options anytime. </p>
            </div>
         </div>
      </div>
      </div>
  </div>
</section>
<!-- process end-->

<!-- gift subscription -->
<section id="gift_subscription" class="gift_subscription-div">
  <div class="container clearfix">
    <div class="container-heading">
     <h2> Diapers Gift Subscription </h2>
     <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque </p>
    </div> 
    
    <?php

$args = array( 'post_type' => 'product', 'posts_per_page' => 4,'product_cat' => 'gift', 'orderby' =>'date','order' => 'ASC' );
  $loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product; 
$id=$product->id;
//print_r($product);
$giftp[]=array('name'=>get_the_title($id),'img'=>wp_get_attachment_url( get_post_thumbnail_id($id) ),'price'=>$product->subscription_price,'sortdec'=>get_post($id)->post_excerpt,'dec'=>get_post($id)->post_content, 'addtocart'=>'?add-to-cart='.$id);

endwhile;
wp_reset_query(); 
?>

    
    <div class="subscription_gift_box">
      <ul>
       <li>
        <div class="subscription_gift_box-img">
         <img src="<?php echo $giftp[0]['img'];?>" alt="<?php echo $giftp[0]['name'];?>">
         <span class="gift-price"> $<?php echo $giftp[0]['price'];?>  </span>
        </div>
        <div class="subscription_gift_box-content clearfix">
          <h4><?php echo $giftp[0]['name'];?> </h4>
          <div class="subscription_gift_box_details">
           <div class="subscription_gift_box_details_left">
        <?php echo $giftp[0]['sortdec'];?>           
           </div>
           <div class="subscription_gift_box_details_right">
		   <?php echo $giftp[0]['dec'];?>    
           </div>
           
          </div>
        </div>
        <div class="subscription_gift_box-btn">
         <a href="<?php echo $giftp[0]['addtocart'];?>"> GIFT NOW </a>
        </div>
       </li>
       <li>
        <div class="subscription_gift_box-img">
         <img src="<?php echo $giftp[1]['img'];?>" alt="<?php echo $giftp[1]['name'];?>">
         <span class="gift-price"> $<?php echo $giftp[1]['price'];?>  </span>
        </div>
        <div class="subscription_gift_box-content clearfix">
          <h4><?php echo $giftp[1]['name'];?> </h4>
          <div class="subscription_gift_box_details">
           <div class="subscription_gift_box_details_left">
        <?php echo $giftp[1]['sortdec'];?>           
           </div>
           <div class="subscription_gift_box_details_right">
		   <?php echo $giftp[1]['dec'];?>    
           </div>
           
          </div>
        </div>
        <div class="subscription_gift_box-btn">
         <a href="<?php echo $giftp[1]['addtocart'];?>"> GIFT NOW </a>
        </div>
       </li>
       <li>
        <div class="subscription_gift_box-img">
         <img src="<?php echo $giftp[2]['img'];?>" alt="<?php echo $giftp[2]['name'];?>">
        <span class="gift-price"> $<?php echo $giftp[2]['price'];?>  </span>
        </div>
        <div class="subscription_gift_box-content clearfix">
          <h4><?php echo $giftp[2]['name'];?> </h4>
          <div class="subscription_gift_box_details">
           <div class="subscription_gift_box_details_left">
        <?php echo $giftp[2]['sortdec'];?>           
           </div>
           <div class="subscription_gift_box_details_right">
		   <?php echo $giftp[2]['dec'];?>    
           </div>
           
          </div>
        </div>
        <div class="subscription_gift_box-btn">
        <a href="<?php echo $giftp[2]['addtocart'];?>"> GIFT NOW </a>
        </div>
       </li>
       <li>
        <div class="subscription_gift_box-img">
          <img src="<?php echo $giftp[3]['img'];?>" alt="<?php echo $giftp[3]['name'];?>">
         <span class="gift-price"> $<?php echo $giftp[3]['price'];?>  </span>
        </div>
        <div class="subscription_gift_box-content clearfix">
          <h4><?php echo $giftp[3]['name'];?></h4>
          <div class="subscription_gift_box_details">
          <div class="subscription_gift_box_details_left">
        <?php echo $giftp[3]['sortdec'];?>           
           </div>
           <div class="subscription_gift_box_details_right">
		   <?php echo $giftp[3]['dec'];?>    
           </div>
           
          </div>
        </div>
        <div class="subscription_gift_box-btn">
         <a href="<?php echo $giftp[3]['addtocart'];?>"> GIFT NOW </a>
        </div>
       </li>      
       
      </ul>
    </div>
    
    <div class="gift-size-btn"> 
  
    
      <a href="<?php echo $deworbaby_options['shop_size_chart']['url'];?>" class="btn show_now hvr-shutter-out-horizontal banner_text blue_btn zoom"><span class="hvr-shutter-out-horizontal blue_btn">View Size, Quantity and Materials</span></a>
    </div>
    
  </div>
</section>
<!-- gift subscription end-->

<!-- sub_sec_3 -->
  <section class="sub_sec_2 sub_sec_3 gift-welcome-box">
    <div class="container">
      <div class="contentArea clearfix">
          <div class="imgHolder">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gift-welcome-img.png" alt="">
          </div>          
          <div class="description">
            <div class="descrip_table_display">
              <div class="descrip_table_cell_dis">
                <h2>WELCOME TO DEWOR BABY</h2>
                <p>We're glad to count you among our subscribers. Simply enter the codethat was provided to you in your email notification below and follow the steps to set up your account.</p>
                <!--<a href="javascript:void(0)" class="btn show_now subscrib_now hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">SUbscribe now</span></a>-->
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
<!-- sub_sec_3 end -->
<!-- enter code -->
  <section class="enter-code">
    <div class="container">
      <div class="contentArea clearfix"> 
        <div class="enter-code-box">         
            <h4>WELCOME TO DEWOR BABY</h4>
            <form id="redeemform" name="redeemform" action="" method="post" >
              <input type="text" name="redeemcode" required="required">
              <button type="submit" class="btn show_now hvr-shutter-out-horizontal banner_text blue_btn">
               <span class="hvr-shutter-out-horizontal blue_btn">Redeem Now</span>
              </button> 
            </form> 
            <!--<a href="javascript:void(0)" class="btn show_now subscrib_now hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">SUbscribe now</span></a>-->
        </div>
      </div>
    </div>
  </section>
<!-- enter code end-->
<?php get_footer(); ?>