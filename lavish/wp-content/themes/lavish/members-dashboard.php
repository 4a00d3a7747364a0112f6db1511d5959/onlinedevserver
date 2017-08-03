<?php
/**
 * Template Name: membersdashboards Page
 */
 
get_header('model');
?>
<?php while ( have_posts() ) : the_post();?>

       
       <?php echo(the_content()); ?>
     </div>  
  </div>
</section>				

<?php	
				endwhile; // End of the loop.
			?>
<?php
get_footer();
?>
