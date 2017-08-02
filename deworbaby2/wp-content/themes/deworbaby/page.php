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

<section id="general">
  <div id="sub-general">
    <div class="container">
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <?php the_content(); ?>	
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>