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
<section class="sliderSec learn_page clearfix">
  <div class="slider-container">  
        <div class="slider" >    
          <div class="slide">    
            <?php
            	the_post_thumbnail('full');
            ?>
            <div class="overlay">
            </div>
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

<section class="sub_sec_2 learn_content" id="sub_sec_2">
  <div class="container">
    <div class="contentArea clearfix">
      <div class="imgHolder">
      <?php 
      $image = get_field('learn_page_diaper_image');
      if( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>"/>
      <?php endif; ?>
      </div>          
      <div class="description">
        <div class="descrip_table_display">
          <div class="descrip_table_cell_dis">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
              <?php the_content(); ?>	
            <?php endwhile; endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>