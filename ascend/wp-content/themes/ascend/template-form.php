<?php
/**
 * Template Name: Design Consultation Form
 */
get_header();
?>
<?php
while (have_posts()) : the_post();

?>
<?php
endwhile;
?>

 

<section class="form-consultation">
	<div class="container">
	<?php the_content();?>
	</div>
</section>
<?php
get_footer();
?>
