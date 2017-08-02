<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>

<section id="general">
	<div id="sub-general">
		<div class="container clearfix">
			<h2 class="page-title inner-page-heading"><span><?php _e( 'Not Found!!!', 'deworbaby' ); ?></span></h2>
			<h4 style="text-align: center;"><?php _e( 'This is somewhat embarrassing, isn’t it?', 'deworbaby' ); ?></h4>
			<p style="text-align: center;"><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'deworbaby' ); ?></p>
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>