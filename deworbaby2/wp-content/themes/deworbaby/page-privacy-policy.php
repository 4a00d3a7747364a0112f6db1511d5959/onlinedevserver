<?php
/*
* The template for inner pages
*/
get_header(); ?>

<!-- slider -->
<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
?>
<section class="sliderSec inner clearfix">
  <div class="container">  
    <h1><?php the_title(); ?></h1>
  </div>
</section>
<?php
	endwhile; endif; 
?>
<!-- slider ends -->

<section id="general">
    <div id="privacy_section">
  	    <div class="container">
    		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    		    <?php the_content(); ?>	
    	    <?php endwhile; endif; ?>
  	    </div>
    </div>
</section>

<?php get_footer(); ?>