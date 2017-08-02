<?php

/**

 * Template for displaying Archive pages

 *

 */



get_header(); ?>

		<section class="bamboo_diapers clearfix">

<?php

	/*

	 * Queue the first post, that way we know

	 * what date we're dealing with (if that is the case).

	 *

	 * We reset this later so we can run the loop

	 * properly with a call to rewind_posts().

	 */

	if ( have_posts() )
		the_post(); ?>

				<div class="container">
					<h2 class="page-title inner-page-heading"><span>
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'deworbaby' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'deworbaby' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'deworbaby' ) ) ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'deworbaby' ), get_the_date( _x( 'Y', 'yearly archives date format', 'deworbaby' ) ) ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'deworbaby' ); ?>
						<?php endif; ?>
					</span></h2>
					<div class="left-content">
						<?php
							/*
							 * Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
							/*
							 * Run the loop for the archives page to output the posts.
							 * If you want to overload this in a child theme then include a file
							 * called loop-archive.php and that will be used instead.
							 */
							get_template_part( 'loop', 'archive' );
						?>
					</div>
					<div class="right-content">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</section>

<?php get_footer(); ?>

