<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>

	<section class="inner-div clearfix">
		<div class="container">
	 		<div class="row">
	 	 		<div class="col-md-9 col-sm-9">
					<h2 class="page-title inner-page-heading"><span><?php _e( 'Not Found!!!', 'church' ); ?></span></h2>
					<div class="left-content">
						<h4><?php _e( 'This is somewhat embarrassing, isn’t it?', 'church' ); ?></h4>
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'church' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="right-content">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
    	</div>
	</section>

<?php get_footer(); ?>