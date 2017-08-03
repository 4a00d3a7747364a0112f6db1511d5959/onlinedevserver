   <?php
/**
 * Template Name: perfect Page
 */
get_header('small');
?>

<?php
while (have_posts()) : the_post();

the_content();

endwhile;
?>


<!--<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>-->
<?php
get_footer();
?>
