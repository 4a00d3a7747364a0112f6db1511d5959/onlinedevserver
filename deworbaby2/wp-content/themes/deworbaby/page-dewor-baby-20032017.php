<?php
/*
* The template for inner pages
*/
get_header(); ?>

<!-- slider -->
<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
	//if ( has_post_thumbnail() ) {
?>
<!-- slider -->
<section class="sliderSec slider1 deworbaby clearfix">
  <div class="slider-container">  
    <div class="slider" >    
      <div class="slide">    
          <div class="container clearfix">
              <div class="content">
                 <?php the_excerpt(); ?>
              </div>
          </div>
      </div>
    </div>        
  </div>
</section>
<!-- slider ends -->
<?php
	//}
	endwhile; endif; 
?>
<!-- slider ends -->

<section class="bamboo_diapers inner deworbaby_mission">
  <div class="container clearfix">
      <div class="content">
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <?php the_content(); ?>	
      <?php endwhile; endif; ?>
    </div>   
  </div>
</section>

<section class="bamboo_diapers inner deworbaby_commitement">
  <div class="container clearfix">
      <div class="content">
        <?php the_field('our_commitment_section'); ?>
      </div>   
  </div>
</section>

<?php get_footer(); ?>