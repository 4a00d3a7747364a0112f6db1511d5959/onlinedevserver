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

<section id="whole_sale_enquiry">
  <div class="container wholesale_form_area clearfix">
    <div class="wholesale_section">
      <div class="form_area">
        <div class="form_inner">
          <div class="actual_form_area">
            <?php echo do_shortcode('[contact-form-7 id="45" title="Wholesale Contact Form"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 

<?php get_footer(); ?>