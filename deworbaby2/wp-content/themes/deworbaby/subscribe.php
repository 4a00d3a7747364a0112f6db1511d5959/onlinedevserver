<?php
/*
Template Name: Subscribe Page Template
*/

get_header(); 

?>
<!-- slider -->
<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
	if ( has_post_thumbnail() ) {
?>
<section class="sliderSec clearfix subscribe">
  <div class="slider-container">  
        <div class="slider" >    
          <div class="slide">    
            <?php
            	the_post_thumbnail('full');
            ?>
            <div class="overlay"></div>
              <div class="caption">
                <div class="capContent container">
                    <div class="maincaptionHolder">
                      	<div class="mainCapInner">
	                        <?php the_excerpt(); ?>
                      	</div>
                    </div>
                </div>                
              </div> 
          </div>
        </div>
  </div>
</section>

<!-- slider ends -->
<!-- sub_sec_2 -->

  <section class="sub_sec_2" id="sub_sec_2">
    <div class="container">
      <div class="contentArea clearfix">
          <div class="imgHolder">	
            <?php
              $instant_saving_img = get_field('instant_saving_image');
            ?>		
            <img src="<?php echo $instant_saving_img['url']; ?>" alt="">
          </div>          
          <div class="description">
            <div class="descrip_table_display">
              <div class="descrip_table_cell_dis">
                <!-- <h2>Instant Savings <span>With Our Subscription Plan</span></h2>
                <p>We made it super easy and fast for you to subscribe and start enjoying your free time with your precious one. </p>
                <a href="#ready_subscribe" class="btn show_now hvr-shutter-out-horizontal banner_text"><span class="hvr-shutter-out-horizontal">SEE SUBSCRIPTION PLAN</span></a> -->
                <?php the_content(); ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
  <?php } endwhile; endif; ?>
<!-- sub_sec_2 end -->

<section id="sub_process">
  <div class="container clearfix">
      <div class="process">

         <h2>Easy process to subscribe</h2>
          <?php
            $icon1 = get_field('first_process_icon');
            $icon2 = get_field('second_process_icon');
            $icon3 = get_field('third_process_icon');
          ?>

         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo $icon1['url']; ?>" alt="#">
                <div class="line"></div>
            </div>
            <div class="content">
               <?php the_field('first_process_content'); ?>
            </div>
         </div>

         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo $icon2['url']; ?>" alt="#">
                <div class="line"></div>
            </div>
            <div class="content">
               <?php the_field('second_process_content'); ?>
            </div>
         </div>

         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo $icon3['url']; ?>" alt="#">

            </div>
            <div class="content">
               <?php the_field('third_process_content'); ?>
            </div>
         </div>

      </div>
  </div>
</section>

<!-- sub_sec_3 -->
<form method="post" action='' enctype="multipart/form-data">
  <section id="ready_subscribe" class="sub_sec_2 sub_sec_3 plans">
    <div class="container">
      <div class="contentArea clearfix">
      <?php 
        global $post; 
        $product_id = 188;
        $post = get_post($product_id , OBJECT );
        setup_postdata( $post ); 
        $_product = wc_get_product( $product_id );
      ?>
			<div class="description-img">
			<?php echo $_product->get_image(array( 300, 300 ));?>
			</div>	
      <?php wp_reset_postdata(); ?>		
          <div class="description">
            <div class="descrip_table_display">
              <div class="descrip_table_cell_dis">

                <?php the_field('subscribe_product_description'); ?>

				        <!-- <input type="hidden" class="quantity" name="quantity" value="1" >
                <input type='hidden' value="188" name="add-to-cart" class="add-to-cart"> -->
                <p class="special"><?php the_field('subscription_special_point'); ?></p>
                <a  href='<?php echo esc_url( home_url( '/' ) ); ?>?add-to-cart=188' class="btn show_now subscrib_now hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">Ready to Subscribe</span></a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
</form>


<!-- sub_sec_3 end -->
<section id="tryOut">
  <div class="container clearfix">
     <div class="content">
        <?php the_field('free_diaper_content'); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>free-trial" class="btn show_now hvr-shutter-out-horizontal banner_text"><span class="hvr-shutter-out-horizontal">Get free Trial</span></a>
     </div>
  </div>
</section>


<script>
   jQuery("#flexiselDemo3").flexisel({
        visibleItems: 2,
        itemsToScroll: 1,         
        autoPlay: {
            enable: true,
            interval: 5000,
            pauseOnHover: true
        }        
    });
	
	/* $(document).ready(function(){
		$('.hvr-shutter-out-horizontal').click(function(){		
		 var call_url = "/cart";
			$.ajax({
				type: "POST",
				url: call_url,
				data: {
					add-to-cart: $('.add-to-cart').val(),
					quantity: $('.class').val(),
					action: ''
				},
				success: function(result){									
					window.location.href = "<?php echo esc_url( home_url( '/subscribe-checkout' ) ); ?>";
				},
				
		   });
		});	
	}); */
	
</script>

<?php get_footer(); ?>