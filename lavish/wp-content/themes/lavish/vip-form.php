<?php
/**
 * Template Name: vipform Page
 */
get_header();
?>

<?php
		while (have_posts()) : the_post();
		?>
		<div class="container">
		<div class="vip-form-box">
		<?php echo do_shortcode('[VIPREG]');?>
		</div>
		</div>
		
		<?php endwhile;?>

<?php get_footer();?>
