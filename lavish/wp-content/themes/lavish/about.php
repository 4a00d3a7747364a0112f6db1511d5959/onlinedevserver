<?php
/**
 * Template Name: about Page
 */
get_header('casting');
?>

<?php
while (have_posts()) : the_post();

the_content();

endwhile;
?>

<!--<section id="about-copy-right" class="about-copy-right-box">
  <div class="container">
    <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish mate-copyscape-2.png" alt="" />
       <div class="city-details about-bottom-content clearfix">
        <div class="city-details-left">
         <h3> A job at Target Escorts®? We look forward to receiving your application!  </h3>
         <p> As a VIP escort model in our elite escort agency you will have one of the most exciting and lucrative<a href="#"> part-time jobs</a> in the world. We look forward to hearing from you! </p>
        </div>
        <div class="city-details-right">
          <h3> Find out more about the lucrative job as an escort lady at Target Escorts®es </h3>
          <p> You certainly have many questions about working as a high-class escort model – Here you may find our F.A.Q. for <a href="#">future escort ladies.</a> </p>
        </div>
       </div>
  </div>
</section>
-->

<?php
get_footer();
?>
