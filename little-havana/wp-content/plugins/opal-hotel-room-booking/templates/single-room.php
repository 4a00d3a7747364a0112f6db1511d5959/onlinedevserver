<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/single-room.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

get_header(); ?>
<header class="ht-main-header">
	<div class="ht-container">
		<?php the_title( '<h1 class="ht-main-title">', '</h1>' ); ?>
		<?php do_action( 'total_breadcrumbs' ); ?>
	</div>
</header><!-- .entry-header -->

	<?php
		/**
		 * opalhotel_before_main_content hook.
		 *
		 * @hooked opalhotel_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked opalhotel_breadcrumb - 20
		 */
		do_action( 'opalhotel_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php opalhotel_get_template_part( 'content', 'single-room' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * opalhotel_after_main_content hook.
		 *
		 * @hooked opalhotel_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action( 'opalhotel_after_main_content' );
	?>

	<?php
		/**
		 * opalhotel_sidebar hook.
		 *
		 * @hooked opalhotel_get_sidebar - 10
		 */
		do_action( 'opalhotel_sidebar' );
	?>

<?php get_footer(); ?>