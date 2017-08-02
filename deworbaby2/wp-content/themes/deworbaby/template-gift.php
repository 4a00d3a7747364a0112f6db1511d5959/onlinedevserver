<?php
/*
Template Name: Gift
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
<?php
 $product_id = wc_get_product_id_by_sku( 'diper_gift' );
 $_product = wc_get_product( $product_id );
 
 print_r($_product);
?>