<?php
/*
Template Name: Subscribe
*/

get_header(); 

?>
<!-- slider -->
<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
	if ( has_post_thumbnail() ) {
?>
<section class="sliderSec clearfix">
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
<?php
	}
	endwhile; endif; 
?>
<!-- slider ends -->
<!-- sub_sec_2 -->
  <section class="sub_sec_2" id="sub_sec_2">
    <div class="container">
      <div class="contentArea clearfix">
          <div class="imgHolder">
			
            <img src="<?php echo get_template_directory_uri(); ?>/images/subscribe_baby_image.png" alt="">
          </div>          
          <div class="description">
            <div class="descrip_table_display">
              <div class="descrip_table_cell_dis">
                <h2>Instant Savings <span>With Our Subscription Plan</span></h2>
                <p>We made it super easy and fast for you to subscribe and start enjoying your free time with your precious one. </p>
                <a href="javascript:void(0)" class="btn show_now hvr-shutter-out-horizontal banner_text"><span class="hvr-shutter-out-horizontal">sEE SUBSCRIPTION PLAN</span></a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
<!-- sub_sec_2 end -->

<section id="sub_process">
  <div class="cotainer clearfix">
      <div class="process">

         <h2>Easy process to subscribe</h2>

         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo get_template_directory_uri(); ?>/images/select_icon.png" alt="#">
                <div class="line"></div>
            </div>
            <div class="content">
               <h4>Select</h4>
               <p>View our Size chart and choose your size</p>
            </div>
         </div>
         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo get_template_directory_uri(); ?>/images/choose_icon.png" alt="#">
                <div class="line"></div>
            </div>
            <div class="content">
               <h4>Choose</h4>
               <p>Choose your delivery options </p>
            </div>
         </div>
         <div class="row clearfix">
            <div class="icon">
               <img src="<?php echo get_template_directory_uri(); ?>/images/save_icon.png" alt="#">

            </div>
            <div class="content">
               <h4>Save </h4>
               <p>Enjoy your savings and wait for our bamboo diapers to arrive at your front door</p>
            </div>
         </div>
      </div>
  </div>
</section>
<?php global $post; 
$product_id = 188;
$post = get_post($product_id , OBJECT );
setup_postdata( $post ); 
$_product = wc_get_product( $product_id );
?>
<!-- sub_sec_3 -->
<form method="post" action='' enctype="multipart/form-data">
  <section class="sub_sec_2 sub_sec_3 plans">
    <div class="container">
      <div class="contentArea clearfix">
			<div style="width:30%; float: left;">
			<?php echo $_product->get_image(array( 300, 300 ));?>
			</div>			
          <div class="description">
            <div class="descrip_table_display">
              <div class="descrip_table_cell_dis">
                <h2>Box Full of Softness and Joy</h2>
                <p><b>Our jumbo diapers pack include 2 diapers pack. </b></p>
                <p><?php echo the_content(); ?></p>
                <h4>Our Plan Offers </h4>
                <ul>
                  <li>2 or more jumbo packs depending on your order quantity.</li>
                  <li>Starting from as low as $<?php  echo $_product->get_price()*2;?> /month (Price for 2 jumbo packs)</li>
                  <li>Plus "Free Shipping" </li>
                </ul>
				<input type="hidden" class="quantity" name="quantity" value="2" >
				<input type='hidden' value="<?php echo $product_id; ?>" name="add-to-cart" class="add-to-cart">
                <p class="special">Change your quantity and size anytime when your little explorer is ready to upgrade to a new size </p>
                <a href='<?php echo esc_url( home_url( '/' ) ); ?>?add-to-cart=<?php the_id(); ?>' class="btn show_now subscrib_now hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">ready to Subscribe</span></a>
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
        <h4>Try out our diaper free</h4>
        <p>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes
        </p>
        <a href="javascript:void(0)" class="btn show_now hvr-shutter-out-horizontal banner_text"><span class="hvr-shutter-out-horizontal">Get free Trial</span></a>
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