<?php
/**
 * Sidebar template containing the primary and secondary widget areas
 */
?>

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'church-blog-sidebar' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'church-blog-sidebar' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>
