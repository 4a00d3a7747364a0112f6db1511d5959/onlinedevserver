<?php 
/*
* The template for displaying the front page
*/
get_header(); 

global $deworbaby_options;
?>

<!-- slider -->
<section class="sliderSec slider1 clearfix">
  <div class="slider-container">  
        <div class="slider" >    
          <div class="slide">    
            <img src="<?php echo $deworbaby_options['banner_image']['url']; ?>" alt=""> 
            <div class="overlay">
                  
            </div>
              <div class="caption">
                <div class="capContent">
                    <div class="maincaptionHolder">
                      <div class="mainCapInner">
                        <?php echo $deworbaby_options['banner_content']; ?>
                      </div>
                    </div>
                </div>
                <?php if(!empty($deworbaby_options['banner_btn_link'])){ ?>
                <a href="<?php echo $deworbaby_options['banner_btn_link']; ?>" class="view_btn"><?php echo $deworbaby_options['banner_btn_text']; ?></a>
                <?php } ?>
              </div> 
          </div>
        </div>
        
  </div>
</section>
<!-- slider ends -->

<!-- bamboo diapers -->
<section class="bamboo_diapers clearfix">
  <div class="container">
    <div class="leftPart">
      <?php while (have_posts()) : the_post();  ?>
        <?php the_content(); ?>
      <?php endwhile;?>
    </div>
    <div class="rightPart">
      <div class="videoPart">
        <video src="" poster="<?php echo get_template_directory_uri(); ?>/images/poster_img.jpg"></video>
        <?php //the_excerpt(); ?>                          
      </div>
    </div>
  </div>
</section>
<!-- bamboo diapers end -->

<!-- collections -->
  <section class="collection clearfix">
    <div class="container">
      <div class="leftPart">

        <div class="collectionSlider">
          <ul id="flexiselDemo3" class="clearfix">
            <?php
              global $product, $posts;
              $args = array(  
                'post_type' => 'product',  
                'posts_per_page' => -1,
                'post_status' => 'publish',
                );  
              
              $dewor_pro = new WP_Query( $args );  
              //print_r($dewor_pro); 
            ?>

            <?php
              if ($dewor_pro->have_posts()) :   
              while ($dewor_pro->have_posts()) : $dewor_pro->the_post();  

              $url = get_permalink( $product_id ); 
            ?>
            <li>
              <a  href="<?php echo $url; ?>">
              <div class="productWrap">
                <div class="proImg">
                  <?php 
                    if ( has_post_thumbnail( $post->ID ) ) 
                      echo get_the_post_thumbnail( $post->ID, 'shop_catalog' ); 
                    else 
                      echo '<img src="' . woocommerce_placeholder_img_src() . '"/>'; 
                  ?>
                </div>
                <div class="proCap">
                  <p><?php the_title(); ?></p>
                </div>
              </div>
              </a>
            </li>
            <?php 
              endwhile; endif;  
              wp_reset_query();
            ?>            
          </ul> 
        </div>
        
      </div>
      <div class="rightPart">
          <h2><?php echo $deworbaby_options['shop_msg_title']; ?></h2>
          <?php echo $deworbaby_options['shop_msg_content']; ?>
          <?php if(!empty($deworbaby_options['shop_msg_button_link'])) { ?>
          <a href="<?php echo $deworbaby_options['shop_msg_button_link']; ?>" class="btn show_now hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal"><?php echo $deworbaby_options['shop_msg_button_text']; ?></span></a>
          <?php } ?>
      </div>
    </div>
  </section>
<!-- collections ends-->

<!-- free trial -->
  <div class="container" style="display: none;">
    <section class="freeTrial clearfix">
      <h3><?php echo $deworbaby_options['diaper_title']; ?></h3>
      <?php if(!empty($deworbaby_options['diaper_button_link'])){ ?>
      <a href="<?php echo $deworbaby_options['diaper_button_link']; ?>" class="btn show_now seeOurPlan hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">
        <?php echo $deworbaby_options['diaper_button_text']; ?></span>
      </a>
      <?php } ?>
      <div class="rightImagePart">
        <img src="<?php echo $deworbaby_options['diaper_section_image']['url']; ?>" alt="">
      </div>
    </section>
  </div>
<!-- free trial ens-->

<!-- instagram -->
  <section class="instagram">
    <div class="container">
      <h2><?php echo $deworbaby_options['instagram_text']; ?> <span>@DeworBaby</span></h2>
      <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/instagram.jpg" alt=""> -->
      <?php echo do_shortcode('[jr_instagram id="2"]'); ?>
      <?php //echo do_shortcode('[enjoyinstagram_mb] '); ?>
    </div>
  </section>
<!-- instagram ends -->

<!-- about -->
  <section class="about clearfix">
    <div class="container clearfix">
      <?php $the_query = new WP_Query( 'page_id=9' ); ?>
      <?php while ($the_query -> have_posts()) : $the_query -> the_post();  ?>
        <?php //the_content(); ?>
        <?php echo sb_content(62); ?>
      <?php endwhile;?>

      <div class="clearfix cntr">
      <a href="<?php echo site_url('/'); ?>learn" class="btn show_now hvr-shutter-out-horizontal"><span class="hvr-shutter-out-horizontal">Learn More</span></a>
      </div>

      <div class="aboutLists clearfix">
        <ul>
          <?php if(!empty($deworbaby_options['get_in_touch_mail'])){ ?>
          <li>
            <div class="liWrap">
              <h2>get in touch</h2>
              <br>
              <a href="mailto:<?php echo $deworbaby_options['get_in_touch_mail']; ?>"><?php echo $deworbaby_options['get_in_touch_mail']; ?></a>
            </div>
          </li>
          <?php } ?>
          
          <?php if($deworbaby_options['display_social'] == 1){ ?>
          <li class="social">
            <div class="liWrap">
              <h2>GET SOCIAL</h2>
              <ul class="socialNAv">
                <?php if(!empty($deworbaby_options['pinterest'])){ ?>
                <li><a href="<?php echo $deworbaby_options['pinterest']; ?>"><i class="fa fa-pinterest"></i></a></li>
                <?php } ?>
                <?php if(!empty($deworbaby_options['facebook'])){ ?>
                <li><a href="<?php echo $deworbaby_options['facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if(!empty($deworbaby_options['twitter'])){ ?>
                <li><a href="<?php echo $deworbaby_options['twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if(!empty($deworbaby_options['instagram'])){ ?>
                <li><a href="<?php echo $deworbaby_options['instagram']; ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <?php } ?>

          <li class="wholesale">
            <div class="liWrap">
              <h2>iNTERESTED IN WHOLESALE?</h2>              
              <a href="<?php echo $deworbaby_options['whole_sale_link']; ?>">Learn More</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
<!-- about ends-->

<?php get_footer(); ?>