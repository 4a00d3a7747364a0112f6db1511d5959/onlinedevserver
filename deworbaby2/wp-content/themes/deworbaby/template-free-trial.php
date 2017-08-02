<?php
/*
Template Name: Free Trial Template
*/

get_header(); 

?>

<!--free trial starts-->
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
<?php } endwhile; endif; ?>
<!-- slider ends -->

<!-- Free Samples section -->
<section class="freeSamples">
  <div class="container">
    <h2>YOUR FREE SAMPLES</h2>

    <div class="samplesContainer clearfix">

        <div class="col-3">
          <div class="samples">
            <?php the_field('free_sample_first_block'); ?>
          </div>
        </div>

        <div class="col-3">
          <div class="samples">
            <?php the_field('free_sample_second_block'); ?>
          </div>
        </div>

        <div class="col-3">
          <div class="samples">
            <?php the_field('free_sample_third_block'); ?>
          </div>
        </div>

    </div>
  </div>
</section>
<!-- end free samples -->

<!-- benefits  -->
<section class="benefits">
  <div class="container">
    <h2>EXCLUSIVE BENEFITS OF BAMBOO DIAPERS </h2>
  
    <div class="benfits_holder">
        <?php
          $icons1 = get_field('first_benefit_block_icon');
          $icons2 = get_field('second_benefit_block_icon');
          $icons3 = get_field('third_benefit_block_icon');
        ?>

        <div class="col-3">
            <div class="absDivs">
              <div class="absDivInner">
                <img src="<?php echo $icons1['url']; ?>" alt="">
              </div>
            </div>  
            <div class="samples"> 
              <div class="smples_content">
                  <?php the_field('first_benefit_block_content'); ?>
                </div>          
           </div>
        </div>

        <div class="col-3">
          <div class="absDivs">
            <div class="absDivInner">
              <img src="<?php echo $icons2['url']; ?>" alt="">
            </div>
          </div>  
          <div class="samples"> 
            <div class="smples_content">
            <?php the_field('second_benefit_block_content'); ?>              
              </div>          
         </div>
        </div>

        <div class="col-3">
              <div class="absDivs">
                <div class="absDivInner">
                  <img src="<?php echo $icons3['url']; ?>" alt="">
                </div>
              </div>  
              <div class="samples"> 
                <div class="smples_content">
                  <?php the_field('third_benefit_block_content'); ?> 
                  </div>          
             </div>
        </div>
    </div>
  </div>
</section>
<!-- benefits ends -->

<section class="styles">
  <div class="container clearfix"> 
    <div class="right_area">
    <?php global $post; 
      $product_id = 825;
      $post = get_post($product_id , OBJECT );
      setup_postdata( $post ); 
      $_product = wc_get_product( $product_id );
    ?>
      <!-- <img src="<?php //echo get_template_directory_uri(); ?>/images/right_img.jpg" alt=""> -->
      <?php echo $_product->get_image(array( 450, 450 ));?>
      <?php wp_reset_postdata(); ?> 
    </div> 
    <div class="left_area">
      <?php
        $post_free = get_post(827);
      ?>
      <!-- <h2>ULTIMATE BABY STYLE</h2>
      <p>Sometimes, simple is the real chic and the best style of modern day. Our pure white bamboo diapers are simple, yet beautifully soft and pleasant to touch. Get our premium diapers today.</p> -->
      <?php echo $post_free->post_content; ?>
      <?php //echo $check_val = get_post_meta( 825, '_free_trial_ship_info', true ); ?>
      <!-- <input type="hidden" class="quantity" name="quantity" value="1" >
      <input type='hidden' value="<?php echo $product_id; ?>" name="add-to-cart" class="add-to-cart"> -->
      <a href='<?php echo esc_url( home_url( '/' ) ); ?>?add-to-cart=825' class="btn show_now btn_learn_more btn_free_diaper hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">FREE DIAPER TRIAL</span></a>
    </div>
    
    
  </div>
</section>
<!--free trial ends-->

<?php get_footer(); ?>