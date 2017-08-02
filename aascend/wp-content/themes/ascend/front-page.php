<?php
/**
 * Template Name: Main Template
 */

get_header(); ?>
<?php
while (have_posts()) : the_post();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );

?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/style.php?image=<?php echo $image[0];?>" />

<section class="slider-home"> 
  <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/slider1.jpg" alt=""> --> 
</section>
<?php

endwhile;

?>


<?php get_footer();
