<?php
/**
 * Template Name: vip payment Page
 */
get_header();
?>



<?php
			while ( have_posts() ) : the_post();
			the_content();

endwhile; // End of the loop.
			?>

<div class="vip-footer">
 <?php get_footer();?>
</div> 





