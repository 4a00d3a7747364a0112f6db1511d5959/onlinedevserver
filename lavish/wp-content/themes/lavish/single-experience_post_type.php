<?php
/**
 * Template Name: experiences-inner Page
 */
get_header('small');
?>
<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				?>
<section id="experiences-top" class="experiences-top-div" style="background: url(<?php echo esc_url( get_template_directory_uri() )?>/images/experience-bg.jpg) no-repeat center center; background-attachment:fixed; background-size:cover;">
  <div class="container">
    <div class="inner-details-box">
     <h1> Experience </h1>
     <div class="inner-details-contant">
      <h4> <?php the_title();?> </h4>
      <?php the_content();?>
     </div>
       
    </div>  
  </div>
</section>

<?php	
				endwhile; // End of the loop.
			?>
<?php
get_footer();
?>
