<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section id="inner-page">
      <div class="container">

			<section class="error-404 not-found">
                <div class="error-404-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/error-404.png" />
                </div>
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'mykis-theme' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'mykis-theme' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

            </div> 
		</div>  

<?php get_footer(); ?>
