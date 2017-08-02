<?php
/*
Template Name: Redeem Page
*/

get_header(); 
	if(have_posts()) : while(have_posts()) : the_post(); 
?>
<!-- slider -->
<section class="sliderSec redeemgift clearfix">
 <div class="slider-container">
   <div class="slider">
    <div class="slide">
    <div class="container">
   
     <!--<div class="overlay">
     </div>-->
     <div class="caption-1">
                <div class="capContent container">
                    <div class="redeemgift-left">
                     <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );?>" alt="<?php the_title();?>"/>
                    </div>
                    <div class="redeemgift-right">
                     <div class="maincaptionHolder">
                      <div class="mainCapInner">
                        <h1>Welcome to the Deworbaby</h1>
                       <?php the_content();?>
                        <div class="enter-code-box">         
                          <form id="redeemform" name="redeemform" action="" method="post" >
                              <input type="text" name="redeemcode" placeholder="Enter your gift code"  required="required">
                              <button type="submit" class="btn show_now hvr-shutter-out-horizontal banner_text blue_btn">
                               <span class="hvr-shutter-out-horizontal blue_btn">Redeem Now</span>
                              </button> 
                            </form>      
                        </div>
                      </div>
                    </div>
                    </div>
                </div>
                
              </div>
    </div>           
   </div>
   </div>
 </div> 
</section>
<!-- slider ends -->
<?php
	endwhile; endif; 
	 get_footer(); ?>