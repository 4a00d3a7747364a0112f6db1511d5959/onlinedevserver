<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/opalhotel/archive-room.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

get_header(); ?>

	<?php
		/**
		 * opalhotel_before_main_content hook.
		 *
		 * @hooked opalhotel_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked opalhotel_breadcrumb - 20
		 */
		do_action( 'opalhotel_before_main_content' );
	?>

	<div class="opalhotel-wrapper opalhotel-hotels">

		<?php
			/**
			 * opalhotel_archive_description hook.
			 *
			 */
			do_action( 'opalhotel_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * opalhotel_before_hotel_loop hook.
				 *
				 * @hooked opalhotel_result_count - 20
				 * @hooked opalhotel_catalog_ordering - 30
				 */
				do_action( 'opalhotel_before_hotel_loop' );
			?>

			<div class="opalhotel-main hotels">
				<div class="<?php echo apply_filters( 'opalhotel_loop_grid_column_class' ,'grid-row');?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php opalhotel_get_template_part( 'content', 'hotel' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>

			<?php
				/**
				 * opalhotel_after_hotel_loop hook.
				 *
				 * @hooked opalhotel_archive_pagination - 5
				 */
				do_action( 'opalhotel_after_hotel_loop' );
			?>

		<?php else : ?>

			<?php opalhotel_get_template( 'loop/no-hotel-found.php' ); ?>

		<?php endif; ?>

		<?php
			/**
			 * opalhotel_after_main_content hook.
			 *
			 * @hooked opalhotel_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'opalhotel_after_main_content' );
		?>

	</div>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>