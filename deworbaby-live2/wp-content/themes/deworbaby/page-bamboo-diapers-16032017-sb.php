<?php
/*
* The template for inner pages
*/
get_header(); ?>

<!-- slider -->
<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
	if ( has_post_thumbnail() ) {
?>
<section class="sliderSec slider1 clearfix">
  <div class="slider-container">  
        <div class="slider" >    
          <div class="slide">    
            <?php
            	the_post_thumbnail('full');
            ?>
            <div class="caption">
                <div class="capContent">
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

<!-- bamboo diapers -->
<section class="bamboo_diapers inner">
  <div class="container">
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <?php the_content(); ?>  
      <?php endwhile; endif; ?>
  </div>
</section>
<!-- bamboo diapers end -->


<!-- product components -->
<section id="product_components">
       <div class="container">
          
      </div>
  <div class="pro_img">

  <div class="sectionHeading">
     <?php the_field('our_product_components'); ?>
  </div>
    <div class="pro_circls">
      <div class="popbox crl1">
        <div class="circle">
          <a href="javascript:void(0)" ></a>
        </div> 
        <div class="content showHide">          
          <?php the_field('first_dot_content'); ?>
        </div>         
      </div>
      <div class="popbox crl2">
        <div class="circle">
          <a href="javascript:void(0)" ></a>
        </div> 
         <div class="content">          
          <?php the_field('second_dot_content'); ?>
        </div>         
      </div>
      <div class="popbox crl3">
        <div class="circle">
          <a href="javascript:void(0)" ></a>
        </div> 
         <div class="content">          
          <?php the_field('third_dot_content'); ?>
        </div>         
      </div>
      <div class="popbox crl4">
        <div class="circle">
          <a href="javascript:void(0)" ></a>
        </div> 
         <div class="content">          
          <?php the_field('third_dot_content'); ?>
        </div>         
      </div>
      <div class="popbox crl5">
        <div class="circle">
          <a href="javascript:void(0)" ></a>
        </div> 
         <div class="content">          
          <?php the_field('third_dot_content'); ?>
        </div>         
      </div>
      <div class="popbox crl6">
        <div class="circle">
          <a href="javascript:void(0)" ></a>
        </div> 
         <div class="content">          
          <?php the_field('third_dot_content'); ?>
        </div>         
      </div>
    </div>
    <?php
    $diaper_img = get_field('diaper_image');
    if( !empty($diaper_img) ): ?>
      <img src="<?php echo $diaper_img['url']; ?>"/>
    <?php endif; ?>
  </div>
</section>



<!-- product feature -->
  <section id="feature">
     <div class="container">
         <?php the_field('our_product_feature_section'); ?>
      </div>
      <div class="row nature_bamboo">
          <div class="overlay clearfix">
            <div class="left_part">
               <ul class="feature_list">
                 <li>
                   <a href="javascript:void(0)" class="pro_left_box active">
                      <span class="icon">
                      <?php
                      $image1 = get_field('first_feature_icon');
                      if( !empty($image1) ): ?>
                        <img src="<?php echo $image1['url']; ?>"/>
                      <?php endif; ?>
                      </span>
                      <span class="text"> <?php the_field('first_feature_title'); ?> </span>
                      <span class="desc"><?php the_field('first_feature_content'); ?></span>
                   </a>
                 </li>
                 <li>
                   <a href="javascript:void(0)" class="pro_left_box">
                      <span class="icon">
                      <?php
                      $image2 = get_field('second_feature_icon');
                      if( !empty($image2) ): ?>
                        <img src="<?php echo $image2['url']; ?>"/>
                      <?php endif; ?>
                      </span>
                      <span class="text"> <?php the_field('second_feature_title'); ?> </span>
                      <span class="desc"><?php the_field('second_feature_content'); ?></span>
                   </a>
                 </li>
                  <li>
                   <a href="javascript:void(0)" class="pro_left_box">
                      <span class="icon">
                      <?php
                      $image3 = get_field('third_feature_icon');
                      if( !empty($image3) ): ?>
                        <img src="<?php echo $image3['url']; ?>"/>
                      <?php endif; ?>
                      </span>
                      <span class="text"> <?php the_field('third_feature_title'); ?> </span>
                      <span class="desc"><?php the_field('third_feature_content'); ?></span>
                   </a>
                 </li>
                 <li>
                   <a href="javascript:void(0)" class="pro_left_box">
                      <span class="icon">
                      <?php
                      $image4 = get_field('fourth_feature_icon');
                      if( !empty($image4) ): ?>
                        <img src="<?php echo $image4['url']; ?>"/>
                      <?php endif; ?>
                      </span>
                      <span class="text"> <?php the_field('fourth_feature_title'); ?> </span>
                      <span class="desc"><?php the_field('fourth_feature_content'); ?></span>
                   </a>
                 </li>
                 <li>
                   <a href="javascript:void(0)" class="pro_left_box">
                      <span class="icon">
                      <?php
                      $image5 = get_field('fifth_feature_icon');
                      if( !empty($image5) ): ?>
                        <img src="<?php echo $image5['url']; ?>"/>
                      <?php endif; ?>
                      </span>
                      <span class="text"> <?php the_field('fifth_feature_title'); ?> </span>
                      <span class="desc"><?php the_field('fifth_feature_content'); ?></span>
                   </a>
                 </li>
                 <li>
                   <a href="javascript:void(0)" class="pro_left_box">
                      <span class="icon">
                      <?php
                      $image6 = get_field('sixth_feature_icon');
                      if( !empty($image6) ): ?>
                        <img src="<?php echo $image6['url']; ?>"/>
                      <?php endif; ?>
                      </span>
                      <span class="text"> <?php the_field('sixth_feature_title'); ?> </span>
                      <span class="desc"><?php the_field('sixth_feature_content'); ?></span>
                   </a>
                 </li>
                
               </ul>
            </div>
            <div class="right_part">
                 <div class="tab_cell">
                    <div class="slider">
                       <div class="tab"> 
                          <h4><?php the_field('first_feature_title'); ?></h4>
                          <?php the_field('first_feature_content'); ?>
                      </div>
                        
                    </div>
                  
                </div> 
            </div>
            
          </div> 
      </div>
  </section>



<?php get_footer(); ?>